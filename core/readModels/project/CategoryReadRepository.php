<?php


namespace core\readModels\project;


use core\entities\project\Category;

class CategoryReadRepository
{
    public function getRoot(): Category
    {
        return Category::find()->roots()->one();
}

    public function find($id): ?Category
    {
        return Category::find()->andWhere(['id'=>$id])->andWhere(['>','depth',0])->one();
}
}