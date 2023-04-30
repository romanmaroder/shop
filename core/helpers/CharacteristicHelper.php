<?php


namespace core\helpers;


use core\entities\project\Characteristic;
use Exception;
use yii\helpers\ArrayHelper;

class CharacteristicHelper
{
    public static function typeList(): array
    {
        return [
            Characteristic::TYPE_STRING  => 'String',
            Characteristic::TYPE_INTEGER => 'Integer number',
            Characteristic::TYPE_FLOAT   => 'Float number',
        ];
    }

    /**
     * @param $type
     * @return string
     * @throws Exception
     */
    public static function typeName($type): string
    {
        return ArrayHelper::getValue(self::typeList(), $type);
    }
}