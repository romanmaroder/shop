<?php


namespace core\entities\project\product;


use yii\db\ActiveRecord;

/**
 * @property integer $product_id;
 * @property integer $related_id;
 */
class RelatedAssignment extends ActiveRecord
{
    /**
     * @param $productId
     * @return static
     */
    public static function create($productId): self
    {
        $assignment             = new static();
        $assignment->related_id = $productId;
        return $assignment;
    }

    public function isForProduct($id):bool
    {
        return $this->related_id == $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_related_assignments}}';
    }
}