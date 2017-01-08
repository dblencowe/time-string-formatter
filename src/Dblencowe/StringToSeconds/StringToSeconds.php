<?php

namespace Dblencowe\StringToSeconds;

use Dblencowe\StringToSeconds\Exception\DateStringException;
use Dblencowe\TimeStringFormatter\TimeStringFormatter;

/**
 * Convert date strings like 1W 2D and 6H to seconds
 *
 * @author Dave Blencowe <dblencowe@gmail.com>
 * @package Dblencowe\StringToSeconds
 */
class StringToSeconds extends TimeStringFormatter
{

    /**
     * Amount of days to be used when calculating seconds in a week
     *
     * @var integer
     */
    private $workingDays = 7;

    /**
     * Initialize the object with your string and an optional number of days per week.
     *
     * @param string $dateString String to convert to seconds (Ex: 1w 2d)
     * @param int|null $numberOfWorkingDays Number of days per week (used when calculating W string)
     * @throws DateStringException
     */
    public function __construct(string $dateString = null, int $numberOfWorkingDays = null)
    {
        // Set the number of working days if one provided
        if ($numberOfWorkingDays !== null) {
            $this->workingDays = $numberOfWorkingDays;
        }

        $this->calculateString($dateString);
    }

    /**
     * Turn a string like 4W 2D in to seconds
     *
     * @param  string $string String to convert
     *
     * @return void
     * @throws \Dblencowe\StringToSeconds\Exception\DateStringException
     */
    private function calculateString($string): void
    {
        if (empty($string)) {
            $this->seconds = null;

            return;
        }

        // Sanitize the string
        $string = str_replace(' ', '', strtoupper($string));

        $currentUnitCount = 0;
        foreach (str_split($string) as $character) {
            if (!is_numeric($character)) {
                // End of unit
                switch ($character) {
                    case 'W':
                        $this->seconds += $currentUnitCount * (self::SECONDS_IN_DAY * $this->workingDays);
                        $currentUnitCount = 0;
                        break;
                    case 'D':
                        $this->seconds += $currentUnitCount * self::SECONDS_IN_DAY;
                        $currentUnitCount = 0;
                        break;
                    case 'H':
                        $this->seconds += $currentUnitCount * self::SECONDS_IN_HOUR;
                        $currentUnitCount = 0;
                        break;
                    case 'M':
                        $this->seconds += $currentUnitCount * self::SECONDS_IN_MINUTE;
                        $currentUnitCount = 0;
                        break;
                    case 'S':
                        $this->seconds += $currentUnitCount;
                        $currentUnitCount = 0;
                        break;
                    default:
                        throw new DateStringException('Invalid unit specified: ' . $character);
                }
            }

            if (is_numeric($character)) {
                $currentUnitCount += (int)$character;
            }
        }
    }

    /**
     * Get the seconds
     *
     * @return int Number of seconds in the date string provided
     */
    public function getSeconds(): ?int
    {
        return $this->seconds;
    }

    /**
     * Set the seconds for the object
     *
     * @param int $seconds number of seconds
     */
    public function setSeconds(int $seconds)
    {
        $this->seconds = $seconds;
    }
}
