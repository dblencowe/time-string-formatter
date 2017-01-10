<?php

use PHPUnit\Framework\TestCase;
use Dblencowe\TimeStringFormatter\StringToSeconds;

class StringToSecondsTest extends TestCase
{
    public function testCanInitObject()
    {
        $this->assertInstanceOf(StringToSeconds::class, new StringToSeconds());
    }

    public function testExpectedResult()
    {
        $dates = [
            '1W' => 604800,
            '4D 2H' => 352800,
        ];

        foreach ($dates as $time => $expectedResult) {
            $this->assertEquals($expectedResult, (new StringToSeconds())($time));
        }
    }

    public function testNoStringMeansZeroSeconds()
    {
        $initSeconds = (new StringToSeconds())();
        $this->assertEquals(0, $initSeconds);
    }
}
