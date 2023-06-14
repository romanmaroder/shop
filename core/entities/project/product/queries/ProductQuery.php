<?php


namespace core\entities\project\product\queries;


use core\entities\project\product\Product;
use yii\db\ActiveQuery;

class ProductQuery extends ActiveQuery
{
    /**
     * @param null $alias
     * @return ProductQuery
     */
    public function active($alias = null): ProductQuery
    {
        return $this->andWhere(
            [
                ($alias ? $alias . '.' : '') . 'status' => Product::STATUS_ACTIVE,
            ]
        );
    }
}