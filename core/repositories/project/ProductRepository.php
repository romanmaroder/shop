<?php


namespace core\repositories\project;


use core\entities\project\product\Product;
use core\repositories\NotFoundException;
use RuntimeException;

class ProductRepository
{
    /**
     * @param $id
     * @return Product
     */
    public function get($id): Product
    {
        if (!$product = Product::findOne($id)) {
            throw new NotFoundException('Product not found.');
        }
        return $product;
    }

    /**
     * @param $id
     * @return bool
     */
    public function existsByBrand($id): bool
    {
        return Product::find()->andWhere(['brand_id' => $id])->exists();
    }

    /**
     * @param Product $product
     */
    public function save(Product $product): void
    {
        if (!$product->save()) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param Product $product
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Product $product): void
    {
        if (!$product->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }
}