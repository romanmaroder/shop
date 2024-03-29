<?php


namespace core\forms\project;


use core\entities\project\product\Modification;
use core\entities\project\product\Product;
use core\helpers\PriceHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class AddToCartForm extends Model
{
    public $modification;
    public $quantity;

    private Product $_product;

    public function __construct(Product $product, $config = [])
    {
        $this->_product = $product;
        $this->quantity = 1;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return array_filter(
            [
                $this->_product->modifications ? ['modification', 'required'] : false,
                ['quantity', 'required'],
            ]
        );
    }

    public function modificationsList(): array
    {
        return ArrayHelper::map(
            $this->_product->modifications,
            'id',
            function (Modification $modification) {
                /*return $modification->code . ' - ' . $modification->name . ' (' . PriceHelper::format(
                        $modification->price ?: $this->_product->price_new
                    ) . ')';*/
                return  $modification->name . ' (' . PriceHelper::format(
                        $modification->price ?: $this->_product->price_new
                    ) . ')';
            }
        );
    }
}