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
    static public function isIpInSubnet($ip, $subnet)
    {

        if (! self::isIp($ip)) {
            return false;
        }

        if (substr_count($subnet, '/') < 1) {
            return $ip == $subnet;
        } else if (substr_count($subnet, '/') > 1) {
            return false;
        }

        $subnetArray = explode('/', $subnet);

        return self::isIpMatchSubnetWithMask($ip, $subnetArray[0], $subnetArray[1]);
    }

    static public function isIp($ip)
    {
        return self::isIpv4($ip) || self::isIpv6($ip);
    }

    static public function isIpv4($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    static public function isIpv6($ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    static public function isIpMatchSubnetWithMask($ip, $subnet, $mask)
    {
        if ($mask < 0 || $mask == null) {
            return false;
        }

        if ($mask == 0) {
            return true;
        }

        if (self::isIpv4($ip) && self::isIpv4($subnet) && $mask <= 32) {
            return self::isIpv4MatchSubnetWithMask($ip, $subnet, $mask);
        }

        if (self::isIpv6($ip) && self::isIpv6($subnet) && $mask <= 128  ) {
            return self::isIpv6MatchSubnetWithMask($ip, $subnet, $mask);
        }

        return false;
    }

    static public function isIpv4MatchSubnetWithMask($ip, $subnet, $mask)
    {
        return substr_compare(sprintf('%032b', ip2long($ip)), sprintf('%032b', ip2long($subnet)), 0, $mask) == 0;
    }

    static public function isIpv6MatchSubnetWithMask($ip, $subnet, $netmask)
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
