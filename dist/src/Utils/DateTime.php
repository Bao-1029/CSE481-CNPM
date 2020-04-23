<?php
namespace App\Utils;

use DateTime as DT;
use DateTimeZone;

class DateTime {
    public static function getNow(String $format = 'U') {
        $now = new DT('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
        $now = $now->format($format);
        return $now;
    }

    public static function modify_and_format(DT $dt, String $modify, String $format = 'U') {
        $dt->modify($modify);
        $dt->format($format);
        return $dt;
    }
}
