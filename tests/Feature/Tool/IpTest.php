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


class IpTest extends TestCase
{

    /**
     * @dataProvider getIpv4Data
     */
    public function testIsIpv4MatchSubnetsWithMask($matches, $remoteAddr, $cidr)
    {
        if ($matches != $result = Ip::isIpInSubnets($remoteAddr, $cidr)) {
            print_r([$remoteAddr, $cidr]);
        }
        $this->assertSame($matches, $result);

    }

    public function getIpv4Data()
    {
        return [
            [true, '192.168.1.1', '192.168.1.1'],
            [true, '192.168.1.1', '192.168.1.1/1'],
            [true, '192.168.1.1', '192.168.1.0/24'],
            [false, '192.168.1.1', '1.2.3.4/1'],
            [false, '192.168.1.1', '192.168.1.1/33'], // invalid subnet
            [true, '192.168.1.1', ['1.2.3.4/1', '192.168.1.0/24']],
            [true, '192.168.1.1', ['192.168.1.0/24', '1.2.3.4/1']],
            [false, '192.168.1.1', ['1.2.3.4/1', '4.3.2.1/1']],
            [true, '1.2.3.4', '0.0.0.0/0'],
            [true, '1.2.3.4', '192.168.1.0/0'],
            [false, '1.2.3.4', '256.256.256/0'], // invalid CIDR notation
            [false, 'an_invalid_ip', '192.168.1.0/24'],
        ];
    }

    /**
     * @dataProvider getIpv6Data
     */
    public function testIsIpv6MatchSubnetsWithMask($matches, $remoteAddr, $cidr)
    {
        if ($matches != $result = Ip::isIpInSubnets($remoteAddr, $cidr)) {
            print_r([$remoteAddr, $cidr]);
        }
        $this->assertSame($matches, $result);
    }

    public function getIpv6Data()
    {
        return [
            [true, '2a01:198:603:0:396e:4789:8e99:890f', '2a01:198:603:0::/65'],
            [false, '2a00:198:603:0:396e:4789:8e99:890f', '2a01:198:603:0::/65'],
            [false, '2a01:198:603:0:396e:4789:8e99:890f', '::1'],
            [true, '0:0:0:0:0:0:0:1', '::1'],
            [false, '0:0:603:0:396e:4789:8e99:0001', '::1'],
            [true, '0:0:603:0:396e:4789:8e99:0001', '::/0'],
            [true, '0:0:603:0:396e:4789:8e99:0001', '2a01:198:603:0::/0'],
            [true, '2a01:198:603:0:396e:4789:8e99:890f', ['::1', '2a01:198:603:0::/65']],
            [true, '2a01:198:603:0:396e:4789:8e99:890f', ['2a01:198:603:0::/65', '::1']],
            [false, '2a01:198:603:0:396e:4789:8e99:890f', ['::1', '1a01:198:603:0::/65']],
            [false, '}__test|O:21:&quot;JDatabaseDriverMysqli&quot;:3:{s:2', '::1'],
            [false, '2a01:198:603:0:396e:4789:8e99:890f', 'unknown'],
        ];
    }
}