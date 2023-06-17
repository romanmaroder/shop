<?php


namespace core\helpers;


use NumberFormatter;

class PriceHelper
{
    /**
     * @param $price
     * @return string
     */
    public static function format($price): string
    {
        $fmt = new NumberFormatter('ru_RU', NumberFormatter::DECIMAL);
        return $fmt->formatCurrency($price, 'RUR') . "\n";
        //return number_format($price, 0, '.', ' ');
    }
}