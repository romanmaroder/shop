<?php

/** @var $products core\entities\project\product\Product[] */

use core\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;


?>
<!-- Deals of the week -->
<div class='deals_featured'>
    <div class='container'>
        <div class='row'>
            <div class='col d-flex flex-lg-row flex-column align-items-center justify-content-start'>

                <!-- Deals -->
                <div class='deals'>
                    <div class='deals_title'>Deals of the Week</div>
                    <div class='deals_slider_container'>

                        <!-- Deals Slider -->
                        <div class='owl-carousel owl-theme deals_slider'>
                            <?php foreach( $products as $product) :?>
                                <?php $url = Url::to(['/shop/catalog/product','id'=>$product->id]); ?>
                                <!-- Deals Item -->
                                <div class='owl-item deals_item'>
                                    <?php if($product->mainPhoto) :?>
                                        <div class='deals_image'>
                                            <img alt='' src=<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?>>
                                        </div>
                                    <?php endif; ?>
                                    <div class='deals_content'>
                                        <div class='deals_info_line d-flex flex-row justify-content-start'>
                                            <div class='deals_item_category'>
                                                <a href='<?= Html::encode($url) ?>'><?=Html::encode($product->name)?></a></div>
                                            <?php if($product->price_old):?>
                                            <div class='deals_item_price_a ml-auto'>$<?= PriceHelper::format($product->price_old) ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class='deals_info_line d-flex flex-row justify-content-start'>
                                            <div class='deals_item_name'><?=Html::encode($product->name)?></div>
                                            <div class='deals_item_price ml-auto'>$<?= PriceHelper::format($product->price_new) ?></div>
                                        </div>
                                        <div class='available'>
                                            <div class='available_line d-flex flex-row justify-content-start'>
                                                <div class='available_title'>Available: <span>6</span></div>
                                                <div class='sold_title ml-auto'>Already sold: <span>28</span></div>
                                            </div>
                                            <div class='available_bar'><span style='width:17%'></span></div>
                                        </div>
                                        <div class='deals_timer d-flex flex-row align-items-center justify-content-start'>
                                            <div class='deals_timer_title_container'>
                                                <div class='deals_timer_title'>Hurry Up</div>
                                                <div class='deals_timer_subtitle'>Offer ends in:</div>
                                            </div>
                                            <div class='deals_timer_content ml-auto'>
                                                <div class='deals_timer_box clearfix' data-target-time=''>
                                                    <div class='deals_timer_unit'>
                                                        <div id='deals_timer1_hr' class='deals_timer_hr'></div>
                                                        <span>hours</span>
                                                    </div>
                                                    <div class='deals_timer_unit'>
                                                        <div id='deals_timer1_min' class='deals_timer_min'></div>
                                                        <span>mins</span>
                                                    </div>
                                                    <div class='deals_timer_unit'>
                                                        <div id='deals_timer1_sec' class='deals_timer_sec'></div>
                                                        <span>secs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>


                        </div>

                    </div>

                    <div class='deals_slider_nav_container'>
                        <div class='deals_slider_prev deals_slider_nav'><i
                                class='fas fa-chevron-left ml-auto'></i>
                        </div>
                        <div class='deals_slider_next deals_slider_nav'><i
                                class='fas fa-chevron-right ml-auto'></i>
                        </div>
                    </div>
                </div>

                <!-- Featured -->
                <div class='featured'>
                    <div class='tabbed_container'>
                        <div class='tabs'>
                            <ul class='clearfix'>
                                <li class='active'>Featured</li>
                                <li>On Sale</li>
                                <li>Best Rated</li>
                            </ul>
                            <div class='tabs_line'><span></span></div>
                        </div>

                        <!-- Product Panel -->
                        <div class='product_panel panel active'>
                            <div class='featured_slider slider'>
                                <?php foreach($products as $product) :?>
                                    <?php $url = Url::to(['/shop/catalog/product','id'=>$product->id]); ?>
                                <?php
                                    $discountClass = PriceHelper::format($product->price_old) > 0 ? 'discount' : '';
                                    $isNewClass = PriceHelper::format($product->price_old) == 0 ? 'is_new' : '';?>

                                <!-- Slider Item -->
                                <div class='featured_slider_item '>
                                    <div class='border_active'></div>
                                    <div class='product_item discount d-flex flex-column align-items-center justify-content-center text-center <?= $discountClass . $isNewClass?>'>
                                        <?php if($product->mainPhoto) :?>
                                            <div class='product_image d-flex flex-column align-items-center justify-content-center'>
                                                <img src=<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?> alt=''>
                                            </div>
                                        <?php endif;?>
                                        <div class='product_content'>

                                            <?php if($product->price_old):?>
                                            <div class='product_price discount'>
                                                    $<?= PriceHelper::format($product->price_new); ?>
                                                <span>
                                                    $<?= PriceHelper::format($product->price_old); ?>
                                                </span>
                                            </div>
                                            <?php else:?>
                                                <div class='product_price'>$<?= PriceHelper::format($product->price_new) ?></div>
                                            <?php endif;?>

                                            <div class='product_name'>
                                                <div><a href='<?= Html::encode($url) ?>'><?=Html::encode($product->name)?></a></div>
                                            </div>
                                            <div class='product_extras'>
                                                <div class='product_color'>
                                                    <input type='radio' checked name='product_color'
                                                           style='background:#b19c83'>
                                                    <input type='radio' name='product_color'
                                                           style='background:#000000'>
                                                    <input type='radio' name='product_color'
                                                           style='background:#999999'>
                                                </div>
                                                <button class='product_cart_button'>Add to Cart</button>
                                            </div>
                                        </div>
                                        <div class='product_fav'><i class='fas fa-heart'></i></div>
                                        <ul class='product_marks'>
                                                <?php if($product->price_old):?>
                                            <li class='product_mark product_discount'>
                                                    <?= '-'.round(($product->price_old - $product->price_new ) / $product->price_old * 100) .'%'  //TODO 'вынести расчет скидки'?>
                                            </li>
                                                <?php endif;?>
                                            <li class='product_mark product_new'>new</li>
                                        </ul>
                                    </div>
                                </div>
                                <?php endforeach;?>
                            </div>
                            <div class='featured_slider_dots_cover'></div>
                        </div>

                        <!-- Product Panel -->

                        <div class='product_panel panel'>
                            <div class='featured_slider slider'>
                                <?php foreach($products as $product) :?>
                                    <?php $url = Url::to(['/shop/catalog/product','id'=>$product->id]); ?>
                                    <?php
                                    $discountClass = PriceHelper::format($product->price_old) > 0 ? 'discount' : '';
                                    $isNewClass = PriceHelper::format($product->price_old) == 0 ? 'is_new' : '';?>

                                    <!-- Slider Item -->
                                    <div class='featured_slider_item '>
                                        <div class='border_active'></div>
                                        <div class='product_item discount d-flex flex-column align-items-center justify-content-center text-center <?= $discountClass . $isNewClass?>'>
                                            <?php if($product->mainPhoto) :?>
                                                <div class='product_image d-flex flex-column align-items-center justify-content-center'>
                                                    <img src=<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?> alt=''>
                                                </div>
                                            <?php endif;?>
                                            <div class='product_content'>

                                                <?php if($product->price_old):?>
                                                    <div class='product_price discount'>
                                                        $<?= PriceHelper::format($product->price_new); ?>
                                                        <span>
                                                    $<?= PriceHelper::format($product->price_old); ?>
                                                </span>
                                                    </div>
                                                <?php else:?>
                                                    <div class='product_price'>$<?= PriceHelper::format($product->price_new) ?></div>
                                                <?php endif;?>

                                                <div class='product_name'>
                                                    <div><a href='<?= Html::encode($url) ?>'><?=Html::encode($product->name)?></a></div>
                                                </div>
                                                <div class='product_extras'>
                                                    <div class='product_color'>
                                                        <input type='radio' checked name='product_color'
                                                               style='background:#b19c83'>
                                                        <input type='radio' name='product_color'
                                                               style='background:#000000'>
                                                        <input type='radio' name='product_color'
                                                               style='background:#999999'>
                                                    </div>
                                                    <button class='product_cart_button'>Add to Cart</button>
                                                </div>
                                            </div>
                                            <div class='product_fav'><i class='fas fa-heart'></i></div>
                                            <ul class='product_marks'>
                                                <?php if($product->price_old):?>
                                                    <li class='product_mark product_discount'>
                                                        <?= '-'.round(($product->price_old - $product->price_new ) / $product->price_old * 100) .'%'  //TODO 'вынести расчет скидки'?>
                                                    </li>
                                                <?php endif;?>
                                                <li class='product_mark product_new'>new</li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <div class='featured_slider_dots_cover'></div>
                        </div>

                        <!-- Product Panel -->

                        <div class='product_panel panel'>
                            <div class='featured_slider slider'>
                                <?php foreach($products as $product) :?>
                                    <?php $url = Url::to(['/shop/catalog/product','id'=>$product->id]); ?>
                                    <?php
                                    $discountClass = PriceHelper::format($product->price_old) > 0 ? 'discount' : '';
                                    $isNewClass = PriceHelper::format($product->price_old) == 0 ? 'is_new' : '';?>

                                    <!-- Slider Item -->
                                    <div class='featured_slider_item '>
                                        <div class='border_active'></div>
                                        <div class='product_item discount d-flex flex-column align-items-center justify-content-center text-center <?= $discountClass . $isNewClass?>'>
                                            <?php if($product->mainPhoto) :?>
                                                <div class='product_image d-flex flex-column align-items-center justify-content-center'>
                                                    <img src=<?= Html::encode($product->mainPhoto->getThumbFileUrl('file', 'catalog_list')) ?> alt=''>
                                                </div>
                                            <?php endif;?>
                                            <div class='product_content'>

                                                <?php if($product->price_old):?>
                                                    <div class='product_price discount'>
                                                        $<?= PriceHelper::format($product->price_new); ?>
                                                        <span>
                                                    $<?= PriceHelper::format($product->price_old); ?>
                                                </span>
                                                    </div>
                                                <?php else:?>
                                                    <div class='product_price'>$<?= PriceHelper::format($product->price_new) ?></div>
                                                <?php endif;?>

                                                <div class='product_name'>
                                                    <div><a href='<?= Html::encode($url) ?>'><?=Html::encode($product->name)?></a></div>
                                                </div>
                                                <div class='product_extras'>
                                                    <div class='product_color'>
                                                        <input type='radio' checked name='product_color'
                                                               style='background:#b19c83'>
                                                        <input type='radio' name='product_color'
                                                               style='background:#000000'>
                                                        <input type='radio' name='product_color'
                                                               style='background:#999999'>
                                                    </div>
                                                    <button class='product_cart_button'>Add to Cart</button>
                                                </div>
                                            </div>
                                            <div class='product_fav'><i class='fas fa-heart'></i></div>
                                            <ul class='product_marks'>
                                                <?php if($product->price_old):?>
                                                    <li class='product_mark product_discount'>
                                                        <?= '-'.round(($product->price_old - $product->price_new ) / $product->price_old * 100) .'%'  //TODO 'вынести расчет скидки'?>
                                                    </li>
                                                <?php endif;?>
                                                <li class='product_mark product_new'>new</li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                            <div class='featured_slider_dots_cover'></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
