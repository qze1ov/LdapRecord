<?php

namespace LdapRecord\Tests\Models\Attributes;

use LdapRecord\Models\Attributes\Sid;
use LdapRecord\Tests\TestCase;

class SidTest extends TestCase
{
    public function test_can_be_converted_from_binary()
    {
        $hex = '010500000000000515000000dcf4dc3b833d2b46828ba62800020000';

        $expected = (new Sid(hex2bin($hex)));

        $this->assertEquals(
            'S-1-5-21-1004336348-1177238915-682003330-512',
            $expected->getValue()
        );
    }

    public function test_can_be_converted_from_string()
    {
        $hex = '010500000000000515000000dcf4dc3b833d2b46828ba62800020000';
        $sid = 'S-1-5-21-1004336348-1177238915-682003330-512';

        $expected = (new Sid($sid));

        $this->assertEquals(hex2bin($hex), $expected->getBinary());
    }

    public function test_can_convert_built_in_account_sid_from_binary()
    {
        $hex = '01020000000000052000000020020000';
        $sid = 'S-1-5-32-544';

        $expected = new Sid(hex2bin($hex));

        $this->assertEquals($sid, $expected->getValue());
    }

    public function test_can_convert_builtin_account_sid_from_string()
    {
        $hex = '01020000000000052000000020020000';
        $sid = 'S-1-5-32-544';

        $expected = new Sid($sid);

        $this->assertEquals(hex2bin($hex), $expected->getBinary());
    }

    public function test_can_convert_well_known_nobody_sid_from_binary()
    {
        $hex = '010100000000000000000000';
        $sid = 'S-1-0-0';

        $expected = new Sid(hex2bin($hex));

        $this->assertEquals($sid, $expected->getValue());
    }

    public function test_can_convert_well_known_nobody_sid_from_string()
    {
        $hex = '010100000000000000000000';
        $sid = 'S-1-0-0';

        $expected = new Sid($sid);

        $this->assertEquals(hex2bin($hex), $expected->getBinary());
    }

    public function test_can_convert_well_known_self_sid_from_binary()
    {
        $hex = '01010000000000050a000000';
        $sid = 'S-1-5-10';

        $expected = new Sid(hex2bin($hex));

        $this->assertEquals($sid, $expected->getValue());
    }

    public function test_can_convert_well_known_self_sid_from_string()
    {
        $hex = '01010000000000050a000000';
        $sid = 'S-1-5-10';

        $expected = new Sid($sid);

        $this->assertEquals(hex2bin($hex), $expected->getBinary());
    }

    public function test_is_valid()
    {
        $this->assertTrue(Sid::isValid('S-1-5-21-3623811015-3361044348-30300820-1013'));
        $this->assertTrue(Sid::isValid('S-1-5-21-362381101-336104434-3030082-101'));
        $this->assertTrue(Sid::isValid('S-1-5-21-362381101-336104434'));
        $this->assertTrue(Sid::isValid('S-1-5-21-362381101'));
        $this->assertTrue(Sid::isValid('S-1-5-21'));
        $this->assertTrue(Sid::isValid('S-1-5'));

        $this->assertFalse(Sid::isValid('Invalid SID'));
        $this->assertFalse(Sid::isValid('S-1'));
        $this->assertFalse(Sid::isValid(''));
    }
}
