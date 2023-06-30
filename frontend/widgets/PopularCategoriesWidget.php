<?php


namespace frontend\widgets;


use yii\base\Widget;

class PopularCategoriesWidget extends Widget
{
public function run()
{
    return $this->render('popular_categories');
}
}