<?php


namespace core\entities\project\product;

use yii\db\ActiveRecord;

/**
 * @property integer $product_id;
 * @property integer $tag_id;
 */
class TagAssignment extends ActiveRecord
{
    /**
     * @param $tagId
     * @return static
     */
    public static function create($tagId): self
    {
        $assignment         = new static();
        $assignment->tag_id = $tagId;
        return $assignment;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isForTag($id): bool
    {
        return $this->tag_id == $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_tag_assignments}}';
    }
}