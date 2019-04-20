<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-03-09 16:41
 */


namespace Tests\Unit;

use App\Units\Tools\Ip;
use Tests\TestCase;


class ipTest extends TestCase
{
    public function testIsIpv4() {
        $ips = array(
            "ip" => false,
            "1" => false,
            "0.0.0.0" => true,
            "1:1::1:1" => false,
        );

        foreach ($ips as $ip => $status) {
            if (Ip::isIpv4($ip) != $status) {
                $this->assertFalse("$ip not a ipv4 type");
            }
        }
        $this->assertTrue(true);
    }

    public function testIsIpv6() {
        $ips = array(
            "ip" => false,
            "1" => false,
            "0.0.0.0" => false,
            "1:1::1:1" => true,
            "::" => true,
            "::1" => true,
            "1::" => true,
            "ffff:ffff:ffff:ffff:ffff:ffff:ffff:ffff" => true,
        );

        foreach ($ips as $ip => $status) {
            if (Ip::isIpv6($ip) != $status) {
                $this->assertFalse("$ip not a ipv6 type");
            }
        }
        $this->assertTrue(true);
    }

    public function testIsIpv4MatchSubnetWithMask() {
        $ip = '255.255.255.255';
        $array = array(
            ['0.0.0.0', 0],
            ['255.0.0.0', 8],
            ['255.255.0.0', 16],
            ['255.255.255.0', 24],
            ['255.255.255.255', 32],
        );

        foreach ($array as $testCase) {
            for ($i = 0; $i <= 32; $i++) {
                $res = Ip::isIpv4MatchSubnetWithMask($ip, $testCase[0], $i);
                if ($i > $testCase[1]) {
                    $res == false ? : $this->assertFalse(json_encode($testCase) . " should false but get true in $i") ;
                } else {
                   $res == true ? : $this->assertFalse(json_encode($testCase) . " should true but get false in $i");
                }
            }
        }

        $this->assertTrue(true);
    }

    public function testIsIpv6MatchSubnetWithMask() {

        $ip = 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF';

        $array = array(
            ['::', 0],
            ['FFFF::', 16],
            ['FFFF:FFFF::', 32],
            ['FFFF:FFFF:FFFF::', 48],
            ['FFFF:FFFF:FFFF:FFFF::', 64],
            ['FFFF:FFFF:FFFF:FFFF:FFFF::', 80],
            ['FFFF:FFFF:FFFF:FFFF:FFFF:FFFF::', 96],
            ['FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF::', 112],
            ['FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF', 128],
        );

        foreach ($array as $testCase) {
            for ($i = 0; $i <= 128; $i++) {
                $res = Ip::isIpv6MatchSubnetWithMask($ip, $testCase[0], $i);
                if ($i > $testCase[1]) {
                    $res == false ? : $this->assertFalse(json_encode($testCase) . " should false but get true in $i") ;
                } else if ($i <= $testCase[1]) {
                    $res == true ? : $this->assertFalse(json_encode($testCase) . " should true but get false in $i");
                }
            }
        }

        $this->assertTrue(true);

    }
}