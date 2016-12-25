<?php

use PHPUnit\Framework\TestCase;
use Dblencowe\StringToSeconds\StringToSeconds;
use Dblencowe\StringToSeconds\Exception\DateStringException;

class StringToSecondsTest extends TestCase
{
    public function testExpectedResult()
    {
        $dates = [
            '1W' => 604800,
            '4D 2H' => 352800,
        ];

        foreach ($dates as $time => $expectedResult) {
            $testItem = new StringToSeconds($time);
            $this->assertEquals($expectedResult, $testItem->getSeconds());
        }
    }

    public function testProperExceptionThrown()
    {
        $this->expectException(DateStringException::class);
        $testItem = new StringToSeconds('1Y 12D 1600H');
    }
}
