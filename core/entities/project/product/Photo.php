<?php


namespace core\entities\project\product;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property integer id
 * @property string file
 * @property integer sort
 */
class Photo extends ActiveRecord
{

    /**
     * @param UploadedFile $file
     * @return static
     */
    public static function create(UploadedFile $file): self
    {
        $photo       = new static();
        $photo->file = $file;
        return $photo;
    }

    /**
     * @param $sort
     */
    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @param $id
     * @return bool
     */
    public function isIdEqualTo($id): bool
    {
        return $this->id = $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_photos}}';
    }
}