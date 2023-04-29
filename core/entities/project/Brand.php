<?php


namespace core\entities\project;


use core\entities\Meta;
use yii\db\ActiveRecord;
use yii\helpers\Json;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property Meta $meta
 */
class Brand extends ActiveRecord
{
    public Meta $meta;

    /**
     * @param $name
     * @param $slug
     * @param Meta $meta
     * @return static
     */
    public static function create($name, $slug, Meta $meta): self
    {
        $brand       = new static();
        $brand->name = $name;
        $brand->slug = $slug;
        $brand->meta = $meta;
        return $brand;
    }

    public function edit($name, $slug, Meta $meta): void
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->meta = $meta;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_brands}}';
    }


    public function afterFind(): void
    {
        $meta       = Json::decode($this->getAttribute('meta_json'));
        $this->meta = new Meta($meta['title'], $meta['description'], $meta['keywords']);
        parent::afterFind();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert): bool
    {
        $this->setAttribute(
            'meta_json',
            Json::encode(
                [
                    'title'       => $this->meta->title,
                    'description' => $this->meta->description,
                    'keywords'    => $this->meta->keywords
                ]
            )
        );
        return parent::beforeSave($insert);
    }
}