<?php


namespace core\helpers;


class LastSlash
{
    public static function slash($iteraror,$array)
    {

        $array_keys = array_keys($array);
        if($iteraror == end($array_keys)){
            return '';
        }
        return '&#47;';
    }
}