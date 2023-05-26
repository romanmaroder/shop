<?php


namespace core\entities\project\product;


use core\entities\project\Characteristic;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $characteristic_id
 * @property string $value
 * @property Characteristic $characteristic
 */
class Value extends ActiveRecord
{

    public static function create($characteristicId, $value): self
    {
        $object                    = new static();
        $object->characteristic_id = $characteristicId;
        $object->value             = $value;
        return $object;
    }

    /**
     * @param $characteristicId
     * @return static
     */
    public static function blank($characteristicId): self
    {
        $object                    = new static();
        $object->characteristic_id = $characteristicId;
        return $object;
    }

    /**
     * @param $value
     */
    public function change($value): void
    {
        $this->value = $value;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isForCharacteristic($id): bool
    {
        return $this->characteristic_id == $id;
    }

    /**
     * @return ActiveQuery
     */
    public function getCharacteristic(): ActiveQuery
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_values}}';
    }
}