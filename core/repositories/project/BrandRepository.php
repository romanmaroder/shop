<?php


namespace core\repositories\project;


use core\entities\project\Brand;
use core\repositories\NotFoundException;
use http\Exception\RuntimeException;

class BrandRepository
{
    /**
     * @param $id
     * @return Brand
     */
    public function get($id): Brand
    {
        if (!$brand = Brand::findOne($id)) {
            throw new NotFoundException('Brand is not found.');
        }
        return $brand;
    }

    /**
     * @param Brand $brand
     */
    public function save(Brand $brand): void
    {
        if (!$brand->save()) {
            throw new RuntimeException('Saving error.');
        }
    }

    /**
     * @param Brand $brand
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Brand $brand): void
    {
        if (!$brand->delete()) {
            throw new RuntimeException('Removing error.');
        }
    }
}