<?php


namespace frontend\widgets;


use yii\base\Widget;

class TopBannerWidget extends Widget
{
public function run()
{
    return $this->render('top_banner');
}
}