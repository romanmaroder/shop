<?php


namespace frontend\widgets;


use yii\base\Widget;

class LatestReviewsWidget extends Widget
{
public function run()
{
    return $this->render('reviews');
}
}