<?php


namespace core\entities\project;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use core\entities\project\queries\CategoryQuery;
use paulzi\nestedsets\NestedSetsBehavior;
use yii\db\ActiveRecord;


/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $title
 * @property string $description
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property Meta $meta
 *
 * @property Category $parent
 * @mixin NestedSetsBehavior
 */
class Category extends ActiveRecord
{
    public Meta $meta;

    /**
     * @param $name
     * @param $slug
     * @param $title
     * @param $description
     * @param Meta $meta
     * @return static
     */
    public static function create($name, $slug, $title, $description, Meta $meta): self
    {
        $category              = new static();
        $category->name        = $name;
        $category->slug        = $slug;
        $category->title       = $title;
        $category->description = $description;
        $category->meta        = $meta;
        return $category;
    }

    /**
     * @param $name
     * @param $slug
     * @param $title
     * @param $description
     * @param Meta $meta
     */
    public function edit($name, $slug, $title, $description, Meta $meta): void
    {
        $this->name        = $name;
        $this->slug        = $slug;
        $this->title       = $title;
        $this->description = $description;
        $this->meta        = $meta;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_categories}}';
    }


    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            NestedSetsBehavior::class,
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): CategoryQuery
    {
        return new CategoryQuery(static::class);
    }
}