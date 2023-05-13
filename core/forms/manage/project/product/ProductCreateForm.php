<?php


namespace core\forms\manage\project\product;


use core\entities\project\Characteristic;
use core\entities\project\product\Product;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;


/**
 * @property PriceForm $price
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class ProductCreateForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $description;

    public function __construct($config = [])
    {
        $this->price      = new PriceForm();
        $this->meta       = new MetaForm();
        $this->categories = new CategoriesForm();
        $this->photos     = new PhotosForm();
        $this->tags       = new TagsForm();
        $this->values     = array_map(
            function (Characteristic $characteristic) {
                return new ValueForm($characteristic);
            },
            Characteristic::find()->orderBy('sort')->all()
        );
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['brand', 'code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
            [['brandId'], 'integer'],
            [['code'], 'unique', 'targetClass' => Product::class],
            ['description','string'],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function internalForms(): array
    {
        return ['price', 'meta', 'photos', 'categories', 'tags', 'values'];
    }
}