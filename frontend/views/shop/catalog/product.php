<?php

/* @var $this yii\web\View */

/* @var $product core\entities\project\product\Product */

use frontend\assets\MagnificPopupAsset;
use yii\helpers\Html;

$this->title                   = 'HP LP3065';
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

MagnificPopupAsset::register($this);
?>

    <!-- Single Product -->

    <div class='single_product'>
        <div class='container'>
            <div class='row'>

                <!-- Images -->
                <div class='col-lg-2 order-lg-1 order-2'>
                    <ul class='image_list'>
                        <?php
                        foreach ($product->photos as $i => $photo): ?>

                            <li data-image='<?= $photo->getUploadedFileUrl('file') ?>'>
                                <a href='<?= $photo->getUploadedFileUrl('file') ?>'>
                                    <img src='<?= $photo->getThumbFileUrl('file', 'catalog_product_main') ?>'
                                         alt=''>
                                </a>
                            </li>
                        <?php
                        endforeach; ?>
                        <!--<li data-image='<?
                        /*=Yii::getAlias('@web/images/single_2.jpg')*/ ?>'>
                        <a href='<?
                        /*=Yii::getAlias('@web/images/single_2.jpg')*/ ?>'>
                        <img src='<?
                        /*=Yii::getAlias('@web/images/single_2.jpg')*/ ?>' alt=''>
                        </a>
                    </li>
                    <li data-image='<?
                        /*=Yii::getAlias('@web/images/single_3.jpg')*/ ?>'>
                        <a href='<?
                        /*=Yii::getAlias('@web/images/single_3.jpg')*/ ?>'>
                        <img src='<?
                        /*=Yii::getAlias('@web/images/single_3.jpg')*/ ?>' alt=''>
                        </a>
                    </li>-->
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class='col-lg-5 order-lg-2 order-1'>
                    <div class='image_selected'>
                        <img src='<?= $product->mainPhoto->getThumbFileUrl('file', 'catalog_product_main') ?>'
                             alt='<?= Html::encode($product->name) ?>'>
                    </div>
                </div>

                <!-- Description -->
                <div class='col-lg-5 order-3'>
                    <div class='product_description'>
                        <div class='product_category'><?= Html::encode($product->category->title) ?></div>
                        <div class='product_name'><?= Html::encode($product->name) ?></div>
                        <div class='rating_r rating_r_4 product_rating'><i></i><i></i><i></i><i></i><i></i></div>
                        <div class='product_text'><p><?= Html::encode($product->description) ?></p></div>
                        <div class='order_info d-flex flex-row'>
                            <form action='#'>
                                <div class='clearfix' style='z-index: 1000;'>

                                    <!-- Product Quantity -->
                                    <div class='product_quantity clearfix'>
                                        <span>Quantity: </span>
                                        <input id='quantity_input' type='text' pattern='[0-9]*' value='1'>
                                        <div class='quantity_buttons'>
                                            <div id='quantity_inc_button' class='quantity_inc quantity_control'><i
                                                        class='fas fa-chevron-up'></i></div>
                                            <div id='quantity_dec_button' class='quantity_dec quantity_control'><i
                                                        class='fas fa-chevron-down'></i></div>
                                        </div>
                                    </div>

                                    <!-- Product Color -->
                                    <ul class='product_color'>
                                        <li>
                                            <span>Color: </span>
                                            <div class='color_mark_container'>
                                                <div id='selected_color' class='color_mark'></div>
                                            </div>
                                            <div class='color_dropdown_button'><i class='fas fa-chevron-down'></i></div>

                                            <ul class='color_list'>
                                                <li>
                                                    <div class='color_mark' style='background: #999999;'></div>
                                                </li>
                                                <li>
                                                    <div class='color_mark' style='background: #b19c83;'></div>
                                                </li>
                                                <li>
                                                    <div class='color_mark' style='background: #000000;'></div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>

                                </div>

                                <div class='product_price'>$2000</div>
                                <div class='button_container'>
                                    <button type='button' class='button cart_button'>Add to Cart</button>
                                    <div class='product_fav'><i class='fas fa-heart'></i></div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php
$js = <<<EOD
$('.image_list').magnificPopup({
    type: 'image',
    delegate:'a',
    gallery: {
        enabled:true
    },
    
});
EOD;
$this->registerJs($js); ?>