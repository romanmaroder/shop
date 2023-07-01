<?php
/* @var $content string */

use frontend\assets\HomeAsset;
use frontend\widgets\AdvertsWidget;
use frontend\widgets\BannerWidget;
use frontend\widgets\BestSellersWidget;
use frontend\widgets\CharacteristicShopWidget;
use frontend\widgets\FeaturedProductsWidget;
use frontend\widgets\LatestReviewsWidget;
use frontend\widgets\NewArrivalsWidget;
use frontend\widgets\PopularCategoriesWidget;
use frontend\widgets\TopBannerWidget;
use frontend\widgets\TrendsWidget;


HomeAsset::register($this);
?>


<?php
$this->beginContent('@frontend/views/layouts/main.php') ?>


<?= TopBannerWidget::widget() ?>

<?= CharacteristicShopWidget::widget() ?>

<?= FeaturedProductsWidget::widget(
    [
        'limit' => 7,
    ]
) ?>

<?= PopularCategoriesWidget::widget() ?>

<?= BannerWidget::widget() ?>

<?= NewArrivalsWidget::widget() ?>

<?= BestSellersWidget::widget() ?>

<?= AdvertsWidget::widget() ?>

<?= TrendsWidget::widget() ?>

<?= LatestReviewsWidget::widget() ?>


<?php
$this->endContent() ?>