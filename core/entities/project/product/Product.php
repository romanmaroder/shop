<?php


namespace core\entities\project\product;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use core\entities\project\Brand;
use core\entities\project\Category;
use DomainException;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property integer $created_at
 * @property string $code
 * @property string $name
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $price_old
 * @property integer $price_new
 * @property integer $rating
 *
 * @property Meta $meta
 * @property Brand $brand
 * @property Category $category
 * @property CategoryAssignment[] $categoryAssignments
 */
class Product extends ActiveRecord
{
    public $meta;


    /**
     * @param $brandId
     * @param $categoryId
     * @param $code
     * @param $name
     * @param Meta $meta
     * @return static
     */
    public static function create($brandId, $categoryId, $code, $name, Meta $meta): self
    {
        $product              = new static();
        $product->brand_id    = $brandId;
        $product->category_id = $categoryId;
        $product->code        = $code;
        $product->name        = $name;
        $product->meta        = $meta;
        $product->created_at  = time();
        return $product;
    }

    /**
     * @param $new
     * @param $old
     */
    public function setPrice($new, $old): void
    {
        $this->price_new = $new;
        $this->price_old = $old;
    }

    /**
     * @param $categoryId
     */
    public function changeMainCategory($categoryId): void
    {
        $this->category_id = $categoryId;
    }

    /**
     * @param $id
     */
    public function assignCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForCategory($id)) {
                return;
            }
        }
        $assignments[]             = CategoryAssignment::create($id);
        $this->categoryAssignments = $assignments;
    }

    /**
     * @param $id
     */
    public function revokeCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForCategory($id)) {
                unset($assignment[$i]);
                $this->categoryAssignments = $assignments;
                return;
            }
        }
        throw new DomainException('Assignment is not found.');
    }


    public function revokeCategories(): void
    {
        $this->categoryAssignments = [];
    }

    /**
     * @return ActiveQuery
     */
    public function getBrand(): ActiveQuery
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasMany(CategoryAssignment::class, ['product_id' => 'id']);
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return '{{%core_products}}';
    }


    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            [
                'class'     => SaveRelationsBehavior::class,
                'relations' => ['categoryAssignments'],
            ]
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}