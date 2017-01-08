<?php

namespace Dblencowe\TimeStringFormatter;

class TimeStringFormatter
{
    /**
     * Define basics values
     */
    protected const     SECONDS_IN_DAY = 86400,
                        SECONDS_IN_HOUR = 3600,
                        SECONDS_IN_MINUTE = 60;

    /**
     * Count of the amount of seconds in the string
     *
     * @var integer
     */
    protected $seconds = 0;
}
