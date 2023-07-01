<?php


namespace frontend\widgets;


use core\entities\project\product\Product;
use yii\base\Widget;


class ProductPhotoListWidget extends Widget
{
    public ?int $limit = null;
    public Product $product;

    const DEFAULT_LIMIT = 3;


    /**
     * @return int
     */
    private function getLimit(): int
    {
        if (!$this->limit) {
            return self::DEFAULT_LIMIT;
        }
        return $this->limit;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->render(
            'product_photo_list',
            [
                'product' => $this->product,
                'limit'   => $this->getLimit(),
            ]
        );
    }
}