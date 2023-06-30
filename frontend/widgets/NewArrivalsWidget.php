<?php


namespace frontend\widgets;


use yii\base\Widget;

class NewArrivalsWidget extends Widget
{
public function run()
{
    return $this->render('new_arrivals');
}
}