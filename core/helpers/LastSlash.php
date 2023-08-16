<?php


namespace core\helpers;

use ErrorException;
use yii\db\Exception;
use function PHPUnit\Framework\throwException;

/**
 * Outputs a slash, except the last one
 */
class LastSlash
{
    /**
     * @param $iterator
     * @param array $array
     * @return string
     */
    public static function slash($iterator, array $array): string
    {
        $array_keys = array_keys($array);
        if ($iterator == end($array_keys)) {
            return '';
        }
        return '&#47;';
    }
}