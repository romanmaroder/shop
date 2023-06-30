<?php


namespace frontend\widgets;


use yii\base\Widget;
/**
* Class CharacteristicShopWidget
 */
class CharacteristicShopWidget extends Widget
{
public function run(): string
{
   return $this->render('characteristics');
}
}