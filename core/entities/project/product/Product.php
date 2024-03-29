<?php


namespace core\entities\project\product;


use core\entities\behaviors\MetaBehavior;
use core\entities\Meta;
use core\entities\project\Brand;
use core\entities\project\Category;
use core\entities\project\product\queries\ProductQuery;
use core\entities\project\Tag;
use core\entities\user\WishlistItem;
use DomainException;
use JetBrains\PhpStorm\Pure;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property integer $id
 * @property integer $created_at
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $price_old
 * @property integer $price_new
 * @property integer $rating
 * @property integer $main_photo_id
 * @property integer $status
 *
 * @property Meta $meta
 * @property Brand $brand
 * @property Category $category
 * @property CategoryAssignment[] $categoryAssignments
 * @property Category[] $categories
 * @property TagAssignment[] $tagAssignments
 * @property Tag[] $tags
 * @property Modification[] $modifications
 * @property Value[] $values
 * @property Photo[] $photos
 * @property Photo $mainPhoto
 * @property Review[] $reviews
 * @property RelatedAssignment[] relatedAssignments
 * @property string $meta_json
 */
class Product extends ActiveRecord
{
    const STATUS_DRAFT  = 0;
    const STATUS_ACTIVE = 1;

    public $meta;


    /**
     * @param $brandId
     * @param $categoryId
     * @param $code
     * @param $name
     * @param $description
     * @param Meta $meta
     * @return static
     */
    public static function create($brandId, $categoryId, $code, $name, $description, Meta $meta): self
    {
        $product              = new static();
        $product->brand_id    = $brandId;
        $product->category_id = $categoryId;
        $product->code        = $code;
        $product->name        = $name;
        $product->description = $description;
        $product->meta        = $meta;
        $product->status      = self::STATUS_DRAFT;
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

    public function edit($brandId, $code, $name, $description, Meta $meta): void
    {
        $this->brand_id    = $brandId;
        $this->code        = $code;
        $this->name        = $name;
        $this->description = $description;
        $this->meta        = $meta;
    }

    /**
     * @param $categoryId
     */
    public function changeMainCategory($categoryId): void
    {
        $this->category_id = $categoryId;
    }


    public function activate(): void
    {
        if ($this->isActive()) {
            throw new DomainException('Product is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft():void
    {
        if ($this->isDraft()){
            throw new DomainException('Product is already draft.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    /**
     * @return bool
     */
    public function isActive():bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    /**
     * @return bool
     */
    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }

    /**
     * @return string
     */
    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    /**
     * @param $id
     * @param $value
     */
    public function setValue($id, $value): void
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                $val->change($value);
                $this->values = $values;
                return;
            }
        }
        $values[]     = Value::create($id, $value);
        $this->values = $values;
    }

    public function getValue($id): Value
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                return $val;
            }
        }
        return Value::blank($id);
    }

    /**
     * @param $id
     * @return Modification
     */
    public function getModification($id): Modification
    {
        foreach ($this->modifications as $modification) {
            if ($modification->isIdEqualTo($id)) {
                return $modification;
            }
        }
        throw new DomainException('Modification is not found.');
    }

    /**
     * @param $code
     * @param $name
     * @param $price
     */
    public function addModification($code, $name, $price): void
    {
        $modifications = $this->modifications;
        foreach ($modifications as $modification) {
            if ($modification->isCodeEqualTo($code)) {
                throw new DomainException('Modification already exist.');
            }
        }
        $modifications[]     = Modification::create($code, $name, $price);
        $this->modifications = $modifications;
    }

    /**
     * @param $id
     * @param $code
     * @param $name
     * @param $price
     */
    public function editModification($id, $code, $name, $price): void
    {
        $modifications = $this->modifications;
        foreach ($modifications as $i => $modification) {
            if ($modification->isIdEqualTo($id)) {
                $modification->edit($code, $name, $price);
                $this->modifications = $modifications;
                return;
            }
        }
        throw new DomainException('Modification is not found.');
    }

    /**
     * @param $id
     */
    public function removeModification($id): void
    {
        $modifications = $this->modifications;
        foreach ($modifications as $i => $modification) {
            if ($modification->isIdEqualTo($id)) {
                unset($modifications[$i]);
                $this->modifications = $modifications;
                return;
            }
        }
        throw new DomainException('Modification is not found.');
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
     * @param $id
     */
    public function assignTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForTag($id)) {
                return;
            }
        }
        $assignments[]        = TagAssignment::create($id);
        $this->tagAssignments = $assignments;
    }

    /**
     * @param $id
     */
    public function revokeTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForTag($id)) {
                unset($assignments[$i]);
                $this->tagAssignments = $assignments;
                return;
            }
        }
        throw new DomainException('Assignment is not found.');
    }

    public function revokeTags(): void
    {
        $this->tagAssignments = [];
    }

    /**
     * @param UploadedFile $file
     */
    public function addPhoto(UploadedFile $file): void
    {
        $photos   = $this->photos;
        $photos[] = Photo::create($file);
        $this->updatePhotos($photos);
    }

    /**
     * @param $id
     */
    public function removePhoto($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->updatePhotos($photos);
                return;
            }
        }
        throw new DomainException('Photo is not found.');
    }

    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }

    /**
     * @param $id
     */
    public function movePhotoUp($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($prev = $photos[$i - 1] ?? null) {
                    $photos[$i - 1] = $photo;
                    $photos[$i]     = $prev;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new DomainException('Photo is not found.');
    }

    /**
     * @param $id
     */
    public function movePhotoDown($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($next = $photos[$i + 1] ?? null) {
                    $photos[$i]     = $next;
                    $photos[$i + 1] = $photo;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new DomainException('Photo is not found.');
    }

    /**
     * @param array $photos
     */
    private function updatePhotos(array $photos): void
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
        $this->populateRelation('mainPhoto', reset($photos));
    }

    /**
     * @param $id
     */
    public function assignRelatedProduct($id): void
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForProduct($id)) {
                return;
            }
        }
        $assignments[]            = RelatedAssignment::create($id);
        $this->relatedAssignments = $assignments;
    }

    public function revokeRelatedProduct($id): void
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForProduct($id)) {
                unset($assignments[$i]);
                $this->relatedAssignments = $assignments;
                return;
            }
        }
        throw new DomainException('Assignment is not found.');
    }

    /**
     * @param $userId
     * @param $vote
     * @param $text
     */
    public function addReview($userId, $vote, $text): void
    {
        $reviews   = $this->reviews;
        $reviews[] = Review::create($userId, $vote, $text);
        $this->updateReviews($reviews);
    }

    /**
     * @param $id
     * @param $vote
     * @param $text
     */
    public function editReview($id, $vote, $text): void
    {
        $this->doWithReview(
            $id,
            function (Review $review) use ($vote, $text) {
                $review->edit($vote, $text);
            }
        );
    }

    /**
     * @param $id
     */
    public function activateReview($id): void
    {
        $this->doWithReview(
            $id,
            function (Review $review) {
                $review->activate();
            }
        );
    }

    /**
     * @param $id
     */
    public function draftReview($id): void
    {
        $this->doWithReview(
            $id,
            function (Review $review) {
                $review->draft();
            }
        );
    }

    /**
     * @param $id
     * @param callable $callback
     */
    private function doWithReview($id, callable $callback): void
    {
        $reviews = $this->reviews;
        foreach ($reviews as $review) {
            if ($review->isIdEqualTo($id)) {
                $callback($review);
                $this->updateReviews($reviews);
                return;
            }
        }
    }

    /**
     * @param $id
     */
    public function removeReview($id): void
    {
        $reviews = $this->reviews;
        foreach ($reviews as $i => $review) {
            if ($review->isIdEqualTo($id)) {
                unset($reviews[$i]);
                $this->updateReviews($reviews);
                return;
            }
        }
        throw new DomainException('Review is not found.');
    }

    /**
     * @param array $reviews
     */
    private function updateReviews(array $reviews): void
    {
        $amount = 0;
        $total  = 0;
        foreach ($reviews as $review) {
            if ($review->isActive()) {
                $amount++;
                $total += $review->getRating();
            }
        }

        $this->reviews = $reviews;
        $this->rating  = $amount ? $total / $amount : null;
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
     * @return ActiveQuery
     */
    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('categoryAssignments');
    }

    /**
     * @return ActiveQuery
     */
    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasMany(TagAssignment::class, ['product_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->via('tagAssignments');
    }

    /**
     * @return ActiveQuery
     */
    public function getModifications(): ActiveQuery
    {
        return $this->hasMany(Modification::class, ['product_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getValues(): ActiveQuery
    {
        return $this->hasMany(Value::class, ['product_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(Photo::class, ['product_id' => 'id'])->orderBy('sort');
    }

    /**
     * @return ActiveQuery
     */
    public function getMainPhoto(): ActiveQuery
    {
        return $this->hasOne(Photo::class, ['id' => 'main_photo_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRelatedAssignments(): ActiveQuery
    {
        return $this->hasMany(RelatedAssignment::class, ['product_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRelateds(): ActiveQuery
    {
        return $this->hasMany(Product::class, ['id' => 'related_id'])->via('relatedAssignments');
    }

    /**
     * @return ActiveQuery
     */
    public function getReviews(): ActiveQuery
    {
        return $this->hasMany(Review::class, ['product_id' => 'id']);
    }

    public function getWishlistItems(): ActiveQuery
    {
return  $this->hasMany(WishlistItem::class,['product_id'=>'id']);
    }
    public function getFullName() //TODO 'Куда деть этот метод'
    {
        return $this->brand->name . ' ' . $this->name;
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
                'relations' => [
                    'categoryAssignments',
                    'tagAssignments',
                    'relatedAssignments',
                    'modifications',
                    'values',
                    'photos',
                    'reviews'
                ],
            ]
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            foreach ($this->photos as $photo) {
                $photo->delete();
            }
            return true;
        }
        return false;
    }


    public function afterSave($insert, $changedAttributes): void
    {
        $related = $this->getRelatedRecords();
        parent::afterSave($insert, $changedAttributes);
        if (array_key_exists('mainPhoto', $related)) {
            $this->updateAttributes(['main_photo_id' => $related['mainPhoto'] ? $related['mainPhoto']->id : null]);
        }
    }

    public static function find():ProductQuery
    {
        return new ProductQuery(static::class);
    }

}