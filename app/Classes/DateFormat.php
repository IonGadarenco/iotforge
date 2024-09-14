<?php

namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class DateFormat
{
    public static function niceDateTime($dateTime)
    {
        $dateTimeArr = explode(' ', $dateTime);
        $date = $dateTimeArr[0];
        $time = $dateTimeArr[1];

        return self::niceDate($date) . ' ' . substr($time, 0, '5');
    }

    public static function niceDate($date)
    {

        if (!strpos($date, '-')) {
            return $date;
        }
        $from_arr = explode('-', $date);

        $year = $from_arr[0];
        $month = self::monthToShortString($from_arr[1]);
        $day = (int) $from_arr[2];

        $date_invoice = $day . ' ' . $month . ' ' . $year . ' ';

        return $date_invoice;
    }

    public static function niceMonthAndYear($date)
    {

        $from_arr = explode('-', $date);

        $year = $from_arr[0];
        $month = self::monthToString($from_arr[1]);
        $date_invoice = $month . ' ' . $year;

        return $date_invoice;
    }

    public static function monthToString($month)
    {
        switch ($month) { //Cu o lună în urmă.
            case '01':
                $month = __('calendar.january');
                break;
            case '02':
                $month = __('calendar.february');
                break;
            case '03':
                $month = __('calendar.march');
                break;
            case '04':
                $month = __('calendar.april');
                break;
            case '05':
                $month = __('calendar.may');
                break;
            case '06':
                $month = __('calendar.june');
                break;
            case '07':
                $month = __('calendar.july');
                break;
            case '08':
                $month = __('calendar.august');
                break;
            case '09':
                $month = __('calendar.september');
                break;
            case '10':
                $month = __('calendar.october');
                break;
            case '11':
                $month = __('calendar.november');
                break;
            case '12':
                $month = __('calendar.december');
                break;
            default:
                $month = '---';
        }

        return $month;
    }
    public static function monthToShortString($month)
    {
        switch ($month) { //Cu o lună în urmă.
            case '01':
                $month = __('calendar.jan');
                break;
            case '02':
                $month = __('calendar.feb');
                break;
            case '03':
                $month = __('calendar.mar');
                break;
            case '04':
                $month = __('calendar.apr');
                break;
            case '05':
                $month = __('calendar.may_short');
                break;
            case '06':
                $month = __('calendar.jun');
                break;
            case '07':
                $month = __('calendar.jul');
                break;
            case '08':
                $month = __('calendar.aug');
                break;
            case '09':
                $month = __('calendar.sep');
                break;
            case '10':
                $month = __('calendar.oct');
                break;
            case '11':
                $month = __('calendar.nov');
                break;
            case '12':
                $month = __('calendar.dec');
                break;
            default:
                $month = '---';
        }

        return $month;
    }
    public static function periodFilter(&$class, $period, $field)
    {
        switch ($period) {
            case 'today':
                $class->whereDate($field, '=', Carbon::now()->format('Y-m-d'));
                break;
            case 'yesterday':
                $class->whereDate($field, '=', Carbon::now()->subDays(1));
            case 'this_week':
                $class->whereDate($field, '>=', Carbon::now()->startOfWeek())->whereDate($field, '<=', Carbon::now()->endOfWeek());
                break;
            case 'last_week':
                $class->whereDate($field, '>=', Carbon::now()->startOfWeek()->subDays(7))->whereDate($field, '<=', Carbon::now()->startOfWeek()->subDays(1));
                break;
            case 'this_month':
                $class->whereDate($field, '>=', Carbon::now()->startOfMonth())->whereDate($field, '<=', Carbon::now()->endOfMonth());
                break;
            case 'last_month': {
                $start_date = Date('Y-m-d', strtotime('first day of last month'));
                $end_date = Date('Y-m-d', strtotime('last day of last month'));
                $class->whereDate($field, '>=', $start_date)->whereDate($field, '<=', $end_date);
            }
                break;
            case 'this_year': {
                $start_date = Date('Y-m-d', strtotime('first day of january this year'));
                $end_date = Date('Y-m-d', strtotime('last day of december this year'));
                $class->whereDate($field, '>=', $start_date)->whereDate($field, '<=', $end_date);
            }
                break;
            case 'last_year': {
                $start_date = Date('Y-m-d', strtotime('first day of january last year'));
                $end_date = Date('Y-m-d', strtotime('last day of december last year'));
                $class->whereDate($field, '>=', $start_date)->whereDate($field, '<=', $end_date);
            }

        }
    }
    public static function splitDate($date)
    {
        if (!strpos($date, '-')) {
            return collect($date);
        }

        $from_arr = explode('-', $date);

        $year = $from_arr[0];
        $month = self::monthToShortString($from_arr[1]);
        $day = (int) $from_arr[2];

        return (object) [
            'day' => $day,
            'month' => $month,
            'year' => $year,
        ];
    }


}
