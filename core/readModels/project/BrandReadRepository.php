<?php


namespace core\readModels\project;


use core\entities\project\Brand;

class BrandReadRepository
{
    public function find($id): ?Brand
    {
        return Brand::findOne($id);
    }
}