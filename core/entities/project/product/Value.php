<?php


namespace core\entities\project\product;


use yii\db\ActiveRecord;

/**
 * @property integer $characteristic_id
 * @property string $value
 */
class Value extends ActiveRecord
{
    /**
     * @param $characteristicId
     * @param $value
     * @return static
     */
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
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_values}}';
    }
}