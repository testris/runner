<?php

namespace Application\Helper;

class RelativeTime
{
    /**
     * @param int $timestamp
     * @return string
     */
    public static function convert($timestamp)
    {
        $d[0] = array(1, 'second');
        $d[1] = array(60, 'minute');
        $d[2] = array(3600, 'hour');
        $d[3] = array(86400, 'day');
        $d[4] = array(604800, 'week');
        $d[5] = array(2592000, 'month');
        $d[6] = array(31104000, 'year');

        $w = array();

        $return = '';
        $now = time();
        $diff = ($now - $timestamp);
        $secondsLeft = $diff;

        if ($secondsLeft == 0) {
            return 'just now';
        }

        for ($i = 6; $i > -1; $i--) {
            $w[$i] = (int)($secondsLeft / $d[$i][0]);
            $secondsLeft -= ($w[$i] * $d[$i][0]);
            if ($w[$i] !== 0) {
                $return .= abs($w[$i]) . ' ' . $d[$i][1] . (($w[$i] > 1) ? 's' : '') . ' ';
            }

        }

        $return .= ($diff > 0) ? 'ago' : 'left';
        return $return;
    }
}