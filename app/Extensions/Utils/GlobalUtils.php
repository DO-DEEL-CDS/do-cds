<?php

namespace App\Extensions\Utils;


use Faker\Generator as Faker;

class GlobalUtils
{
    public static function getFakeImagePlaceholder()
    {
        return self::getFakerInstance()->imageUrl();
    }

    /**
     * @return Faker
     */
    public static function getFakerInstance()
    {
        return app(Faker::class);
    }

    public static function getCurrentWeek(): array
    {
        $date = today();

        $ts = strtotime($date);
        $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
        return [
                date('Y-m-d H:i:s', $start),
                date('Y-m-d H:i:s', strtotime('next saturday', $start))
        ];
    }

    /**
     * gets the first and last day of the (current) month
     *
     * @param  null  $month
     * @param  null  $year
     * @return array
     */
    public static function getCurrentMonthDates($month = null, $year = null)
    {
        if ($month == null) {
            $month = date('m');
        }
        if ($year == null) {
            $month = date('Y');
        }

        $month_first_day = mktime(0, 0, 0, $month, 1, $year);
        $next_month_first_day = strtotime('+1 month', $month_first_day);

        return [
                date('Y-m-d', $month_first_day),
                date('Y-m-d', strtotime('-1 day', $next_month_first_day)),
        ];
    }

}
