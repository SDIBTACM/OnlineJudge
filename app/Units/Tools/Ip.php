<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-03-09 16:13
 */

namespace App\Units\Tools;


class Ip
{

    /**
     * Checks if an IPv4 or IPv6 address is contained in the list of given IPs or subnets.
     * @param $ip
     * @param $subnets
     * @return bool
     */
    static public function isIpInSubnets($ip, $subnets) {
        if (! is_array($subnets)) {
            return self::isIpInSubnet($ip, $subnets);
        }

        foreach ($subnets as $subnet) {
            if (self::isIpInSubnet($ip, $subnet)) {
                return true;
            }
        }
        return false;
    }

    /**
     * CChecks if an IPv4 or IPv6 address is contained in the list of given IP or subnet.
     * @param $ip
     * @param $subnet
     * @return bool
     */
    static public function isIpInSubnet($ip, $subnet)
    {

        if (false != strpos($subnet, '/')) {
            list($address, $netmask) = explode('/', $subnet, 2);
        } else {
            $address = $subnet;
            $netmask = strpos($ip, ':') ? 128 : 32;
        }

        return self::isIpMatchSubnetWithMask($ip, $address, $netmask);
    }

    /**
     * Check if the $ip is of IP
     * @param string $ip
     * @return bool
     */
    static public function isIp($ip)
    {
        return self::isIpv4($ip) || self::isIpv6($ip);
    }

    /**
     * Check if the $ip is of IPv4 type
     * @param string $ip
     * @return bool
     */
    static public function isIpv4($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Check if the $ip is of IPv6 type
     * @param string $ip
     * @return bool
     */
    static public function isIpv6($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    static private function isIpMatchSubnetWithMask($ip, $subnet, $mask)
    {
        if ($mask < 0 || $mask == null) {
            return false;
        }

        if (self::isIpv4($ip) && self::isIpv4($subnet)) {
            return $mask <= 32 && self::isIpv4MatchSubnetWithMask($ip, $subnet, $mask);
        }

        if (self::isIpv6($ip) && self::isIpv6($subnet)) {
            return $mask <= 128 && self::isIpv6MatchSubnetWithMask($ip, $subnet, $mask);
        }

        return false;
    }

    static private function isIpv4MatchSubnetWithMask($ip, $subnet, $mask)
    {
        return substr_compare(sprintf('%032b', ip2long($ip)), sprintf('%032b', ip2long($subnet)), 0, $mask) == 0;
    }

    static private function isIpv6MatchSubnetWithMask($ip, $subnet, $netmask)
    {
        $bytesAddr = unpack('n*', @inet_pton($ip));
        $bytesTest = unpack('n*', @inet_pton($subnet));

        if (!$bytesAddr || !$bytesTest) {
            return false;
        }

        for ($i = 1, $ceil = ceil($netmask / 16); $i <= $ceil; ++$i) {
            $left = $netmask - 16 * ($i - 1);
            $left = ($left <= 16) ? $left : 16;
            $mask = ~(0xffff >> $left) & 0xffff;
            if (($bytesAddr[$i] & $mask) != ($bytesTest[$i] & $mask)) {
                return false;
            }
        }

        return true;
    }

}
