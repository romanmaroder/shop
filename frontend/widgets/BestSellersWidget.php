<?php


namespace frontend\widgets;


use yii\base\Widget;

class BestSellersWidget extends Widget
{
public function run()
{
    return $this->render('best_sellers');
}
}