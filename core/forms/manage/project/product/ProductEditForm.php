<?php


namespace core\forms\manage\project\product;


use core\entities\project\Characteristic;
use core\entities\project\product\Product;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class ProductEditForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $description;

    private $_product;

    public function __construct(Product $product, $config = [])
    {
        $this->brandId     = $product->brand_id;
        $this->code        = $product->code;
        $this->name        = $product->name;
        $this->description = $product->description;
        $this->meta        = new MetaForm($product->meta);
        $this->tags        = new TagsForm($product);
        $this->values      = array_map(
            function (Characteristic $characteristic) use ($product) {
                return new ValueForm($characteristic, $product->getValue($characteristic->id));
            },
            Characteristic::find()->orderBy('sort')->all()
        );
        $this->_product    = $product;
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['brandId', 'code', 'name', 'description'], 'required'],
            [['brandId'], 'integer'],
            [['code', 'name'], 'string', 'ma[' => 255],
            [
                ['code'],
                'unique',
                'targetClass' => Product::class,
                'filter'      => $this->_product ? ['<>', 'id', $this->_product->id] : null
            ],
            ['description','string'],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function internalForms(): array
    {
        return ['meta', 'tags', 'values'];
    }
}