<?php

use Dblencowe\TimeStringFormatter\SecondsToString;
use PHPUnit\Framework\TestCase;

class SecondsToStringTest extends TestCase
{
    public function testCanInitObject()
    {
        $this->assertInstanceOf(SecondsToString::class, new SecondsToString(0));
    }

    public function testExpectedResult()
    {
        $dates = [
            604800 => '7D',
            352800 => '4D 2H',
        ];

        foreach ($dates as $seconds => $expectedResult) {
            $this->assertEquals($expectedResult, (string)(new SecondsToString($seconds)));
        }
    }
}
