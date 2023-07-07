<?php


namespace core\entities\project\product;


use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use romanmaroder\upload\ImageUploadBehavior;


/**
 * @property integer id
 * @property string file
 * @property integer sort
 *
 * @mixin ImageUploadBehavior
 */
class Photo extends ActiveRecord
{

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
        return $this->id == $id;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_photos}}';
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            [
                'class'                 => ImageUploadBehavior::class,
                'attribute'             => 'file',
                'createThumbsOnRequest' => true,
                'filePath'              => '@staticRoot/origin/products/[[attribute_product_id]]/[[id]].[[extension]]',
                'fileUrl'               => '@static/origin/products/[[attribute_product_id]]/[[id]].[[extension]]',
                'thumbPath'             => '@staticRoot/cache/products/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbUrl'              => '@static/cache/products/[[attribute_product_id]]/[[profile]]_[[id]].[[extension]]',
                'thumbs'                => [
                    'thumb' => ['width' => 640, 'height' => 480],
                    'admin' => ['width' => 100, 'height' => 70],
                    'catalog_list' => ['width' => 310, 'height' => 310],
                    'catalog_product_main' => ['width' => 750, 'height' => 1000],
                    'catalog_product_additional' => ['width' => 133, 'height' => 133],
                ],
            ],
        ];
    }
}