<?php


namespace core\helpers;


use NumberFormatter;

class PriceHelper
{
    public static function format($price): string
    {
        //$fmt = new NumberFormatter('ru_RU', NumberFormatter::CURRENCY);
         //return $fmt->formatCurrency($price, 'RUR') . "\n";
        return number_format($price, 0, '.', ' ');
    }
}