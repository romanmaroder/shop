<?php


namespace core\entities\project\product;


use yii\db\ActiveRecord;

/**
 * @property integer $product_id;
 * @property integer $category_id;
 */
class CategoryAssignment extends ActiveRecord
{
    /**
     * @param $categoryId
     * @return static
     */
    public static function create($categoryId): self
    {
        $assignment              = new static();
        $assignment->category_id = $categoryId;
        return $assignment;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isForCategory($id): bool
    {
        return $this->category_id == $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_category_assignments}}';
    }
}