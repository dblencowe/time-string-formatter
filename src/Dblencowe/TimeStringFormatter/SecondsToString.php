<?php

namespace Dblencowe\TimeStringFormatter;

/**
 * Convert a number of seconds to a time string
 *
 * @package Dblencowe\TimeStringFormatter
 */
class SecondsToString extends TimeStringFormatter
{
    public function __construct(int $seconds)
    {
        $this->seconds = $seconds;
    }

    /**
     * Output a formatted string
     *
     * @return string
     */
    public function __toString(): string
    {
        if ($this->seconds <= 0) {
            return '';
        }

        $string = '';
        $seconds = $this->seconds;

        // Calculate days
        $days = (int)($seconds / self::SECONDS_IN_DAY);
        $seconds %= self::SECONDS_IN_DAY;
        if ($days > 0) {
            $string .= $days . 'D ';
        }

        // Calculate hours
        $hours = (int)($seconds / self::SECONDS_IN_HOUR);
        $seconds %= self::SECONDS_IN_HOUR;
        if ($hours > 0) {
            $string .= $hours . 'H ';
        }

        $minutes = (int)($seconds / self::SECONDS_IN_MINUTE);
        if ($minutes > 0) {
            $string .= $minutes . 'M ';
        }

        return trim($string);
    }
}
