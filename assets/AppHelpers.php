<?php

namespace c006\widget\banner\assets;

use Yii;

class AppHelpers
{

    static public function checkLogin()
    {
        return FALSE;
    }

    static public function isGuest()
    {
        return FALSE;
    }

    /**
     * @param $min
     * @param $max
     * @param bool|FALSE $leading_zero
     *
     * @return array
     */
    public static function minMaxRange($min, $max, $leading_zero = FALSE)
    {
        $array = array();
        for ($i = $min; $i <= $max; $i++) {
            $array[ $i ] = ($leading_zero && $i < 10) ? "0" . $i : $i;
        }

        return $array;
    }

    /**
     * @param $hours
     *
     * @return mixed
     */
    static public function hoursToSeconds($hours)
    {
        return $hours * 60 * 60;
    }

    /**
     * @param $date
     * @param string $format
     *
     * @return int
     */
    static public function dateToTime($date, $format = 'YYYY-MM-DD')
    {
        $month = $day = $year = 0;
        if ($format == 'YYYY-MM-DD') list($year, $month, $day) = explode('-', $date);
        if ($format == 'YYYY/MM/DD') list($year, $month, $day) = explode('/', $date);
        if ($format == 'YYYY.MM.DD') list($year, $month, $day) = explode('.', $date);

        if ($format == 'DD-MM-YYYY') list($day, $month, $year) = explode('-', $date);
        if ($format == 'DD/MM/YYYY') list($day, $month, $year) = explode('/', $date);
        if ($format == 'DD.MM.YYYY') list($day, $month, $year) = explode('.', $date);

        if ($format == 'MM-DD-YYYY') list($month, $day, $year) = explode('-', $date);
        if ($format == 'MM/DD/YYYY') list($month, $day, $year) = explode('/', $date);
        if ($format == 'MM.DD.YYYY') list($month, $day, $year) = explode('.', $date);

        return mktime(0, 0, 0, $month, $day, $year);

    }

}