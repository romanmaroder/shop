<?php


namespace frontend\widgets;


use yii\base\Widget;

class TrendsWidget extends Widget
{
public function run()
{
    return $this->render('trends');
}
}