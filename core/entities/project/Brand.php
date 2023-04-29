<?php


namespace core\entities\project;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use yii\db\ActiveRecord;

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

    /**
     * @return string[]
     */
    public function behaviors(): array
    {
        return [
            MetaBehavior::class
        ];
    }

}