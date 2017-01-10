<?php

namespace Dblencowe\TimeStringFormatter;

use Dblencowe\TimeStringFormatter\Exception\DateStringException;

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
     * Convert string to seconds and return number of seconds
     *
     * @param string|null $dateString
     * @param int|null $numberOfWorkingDays
     * @return int
     * @throws DateStringException
     */
    public function __invoke(string $dateString = null, int $numberOfWorkingDays = null): int
    {
        // Set the number of working days if one provided
        if ($numberOfWorkingDays !== null) {
            $this->workingDays = $numberOfWorkingDays;
        }

        if ($dateString === null) {
            return $this->seconds = 0;
        }

        // Sanitize the string
        $string = str_replace(' ', '', strtoupper($dateString));
        preg_match_all('/(\d+(\.\d+)?)([DMHW])/', $string, $output);
        $result = $output[0];

        foreach ($result as $parts) {
            $unit = substr($parts, -1);
            $multiplier = substr($parts, 0, -1);

            switch ($unit) {
                case 'W':
                    $this->seconds += $multiplier * (self::SECONDS_IN_DAY * $this->workingDays);
                    break;
                case 'D':
                    $this->seconds += $multiplier * self::SECONDS_IN_DAY;
                    break;
                case 'H':
                    $this->seconds += $multiplier * self::SECONDS_IN_HOUR;
                    break;
                case 'M':
                    $this->seconds += $multiplier * self::SECONDS_IN_MINUTE;
                    break;
                case 'S':
                    $this->seconds += $multiplier;
                    break;
            }
        }

        return $this->seconds;
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
