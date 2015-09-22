<?php

namespace app\helpers;

use Yii;
use yii\helpers\StringHelper as YiiStringHelper;

class StringHelper extends YiiStringHelper
{
    const CHECK_NO = 0;
    const CHECK_ALL = 1;
    const CHECK_LETTER = 2;

    /**
     * Находится ли строка в нижнем регистре.
     *
     * @param  string  $s
     * @return boolean
     */
    public static function isLowercase($s)
    {
        return mb_strtolower($s) === $s;
    }

    /**
     * Находится ли строка в верхнем регистре.
     *
     * @param  string  $s
     * @return boolean
     */
    public static function isUppercase($s)
    {
        return mb_strtoupper($s) === $s;
    }

    protected static function checkCase($s, $check, $checkMethod)
    {
        switch ($check) {
            case static::CHECK_NO:
                return true;

            case static::CHECK_ALL:
                return static::$checkMethod($s);

            case static::CHECK_LETTER:
                return static::$checkMethod(mb_substr($s, 1, 1));
        }
    }

    /**
     * Привести первый символ строки к верхнему регистру.
     * Параметр $check используется для определения способа интеллектуальной
     * проверки регистра. Всего таких режимов три:
     * - CHECK_NO - проверка не выполняется,
     * - CHECK_ALL - изменить регистр, если не все символы строки находятся в противоположном регистре,
     * - CHECK_LETTER - изменить регистр, если второй символ строки не находится в противоположном регистре.
     *
     * @param  string  $s
     * @param  integer $check
     * @return string
     */
    public static function ucfirst($s, $check = self::CHECK_NO)
    {
        if (!static::checkCase($s, $check, 'isUppercase')) {
            return $s;
        }

        return mb_strtoupper(mb_substr($s, 0, 1)).mb_substr($s, 1);
    }

    /**
     * Привести первый символ строки к нижнему регистру.
     *
     * @param  string  $s
     * @param  integer $check
     * @return string
     */
    public static function lcfirst($s, $check = self::CHECK_NO)
    {
        if (!static::checkCase($s, $check, 'isLowercase')) {
            return $s;
        }

        return mb_strtolower(mb_substr($s, 0, 1)).mb_substr($s, 1);
    }

    /**
     * Привести к верхнему регистру первый символ каждого слова в строке.
     *
     * @param  string  $s
     * @param  integer $limit
     * @param  integer $check
     * @return string
     */
    public static function ucwords($s, $limit = -1, $check = self::CHECK_NO)
    {
        return preg_replace_callback('/\w+/u', function ($matches) use ($check) {
            return static::ucfirst($matches[0], $check);
        }, $s, $limit);
    }

    /**
     * Привести к нижнему регистру первый символ каждого слова в строке.
     *
     * @param  string  $s
     * @param  integer $limit
     * @param  integer $check
     * @return string
     */
    public static function lcwords($s, $limit = -1, $check = self::CHECK_NO)
    {
        return preg_replace_callback('/\w+/u', function ($matches) use ($check) {
            return static::lcfirst($matches[0], $check);
        }, $s, $limit);
    }

    public static function plural($number, array $forms)
    {
        $number = abs($number % 100);
        if ($number > 10 && $number < 20) {
            return $forms[2];
        }

        $number = $number % 10;

        return $forms[(int) ($number !== 1) + (int) ($number >= 5 || !$number)];
    }

    public static function implode($strings, $separator = ', ', $lastSeparator = ' и ')
    {
        $lastString = array_pop($strings);

        $strings = array_filter([implode($separator, $strings), $lastString]);

        return implode($lastSeparator, $strings);
    }

    public static function makeTitle($title = null, $id = null)
    {
        if (!$id) {
            $id = Yii::$app->id;
        }

        if ($title) {
            return $title.' — '.$id;
        } else {
            return $id;
        }
    }

    public static function purifyText($text)
    {
        return strip_tags($text, '<p><ul><ol><li><a><br><br/><b><i><strong>');
    }
}
