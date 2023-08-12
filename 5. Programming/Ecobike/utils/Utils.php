<?php

class Utils {

    public static function getLogger($className) {
        return Logger::getLogger($className);
    }

    public static function getCurrencyFormat($num) {
        $locale = 'vi_VN';
        $vietnameseLocale = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        return $vietnameseLocale->formatCurrency($num, 'VND');
    }

    public static function getToday() {
        return date('Y-m-d H:i:s');
    }

    public static function md5($message) {
        $digest = null;
        try {
            $hash = md5($message, true);
            $digest = bin2hex($hash);
        } catch (Exception $ex) {
            self::getLogger(Utils::class);
            $digest = '';
        }
        return $digest;
    }

    public static function sha256($message) {
        $digest = null;
        try {
            $hash = hash('sha256', $message, true);
            $digest = bin2hex($hash);
        } catch (Exception $ex) {
            self::getLogger(Utils::class);
            $digest = '';
        }
        return $digest;
    }

    public static $DATE_FORMATER = 'Y-m-d H:i:s';
    public static $DATE_FORMATER_FOR_DISPLAY = 'Y-m-d H:i';

    public static function minusLocalDateTime($before, $after) {
        $duration = $after->getTimestamp() - $before->getTimestamp();
        return $duration;
    }

}
