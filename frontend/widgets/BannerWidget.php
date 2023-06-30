<?php


namespace frontend\widgets;


use yii\base\Widget;
/**
* Class CharacteristicShopWidget
 */
class BannerWidget extends Widget
{
public function run(): string
{
   return $this->render('banner');
}
}