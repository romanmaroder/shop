<?php


namespace frontend\widgets;


use yii\base\Widget;

class AdvertsWidget extends Widget
{
public function run()
{
    return $this->render('adverts');
}
}