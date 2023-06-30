<?php
/* @var $this yii\web\View */

/* @var $product core\entities\project\product\Product */

use core\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['product', 'id' => $product->id]);
$discountClass = PriceHelper::format($product->price_old) > 0 ? 'discount' : '';
$isNewClass = PriceHelper::format($product->price_old) == 0 ? 'is_new' : '';

//TODO 'Посчитать дисконт и вывод лейбла нового товара'
?>

<div class='product_grid_border'></div>

<!-- Product Item -->
<div class='product_item <?= $discountClass . $isNewClass?>'>
    <div class='product_border'></div>
    <div class='product_image d-flex flex-column align-items-center justify-content-center'>
        <?php
        if ($product->mainPhoto): ?>
            <img src="<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>"
                 alt=''/>
        <?php
        endif; ?>
    </div>
    <div class='product_content'>
        <?php if($product->price_old):?>
            <div class='product_price discount'>
                $<?= PriceHelper::format($product->price_new); ?>
                <span>
                   $<?= PriceHelper::format($product->price_old); ?>
                </span>
            </div>
            <?php else :?>
        <div class='product_price'>$<?= PriceHelper::format($product->price_new) ?></div>
        <?php endif;?>
        <div class='product_name'>
            <div><a href='<?= Html::encode($url) ?>' tabindex='0'><?= Html::encode($product->getFullName()) ?></a></div>
        </div>
    </div>
    <div class='product_fav'><i class='fas fa-heart'></i></div>
    <ul class='product_marks'>
        <li class='product_mark product_discount'>
            <?php if($product->price_old):?>
                <?= '-'.round(($product->price_old - $product->price_new ) / $product->price_old * 100) .'%'  //TODO 'вынести расчет скидки'?>
            <?php endif;?>
        </li>
        <li class='product_mark product_new'>new</li>
    </ul>
</div>
