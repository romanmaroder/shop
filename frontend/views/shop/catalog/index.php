<?php

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\DataProviderInterface */

/* @var $category core\entities\project\Category */
/* @var $brands core\entities\project\Brand */

use frontend\assets\ShopAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\LinkPager;

$this->title = 'Catalog';
//$this->params['breadcrumbs'][] = $this->title;

ShopAsset::register($this);
?>

<!-- Home -->

<div class='home'>
    <div class='home_background parallax-window' data-parallax='scroll'
         data-image-src='images/shop_background.jpg'></div>
    <div class='home_overlay'></div>
    <div class='home_content d-flex flex-column align-items-center justify-content-center'>
        <h2 class='home_title'>Smartphones & Tablets</h2>
    </div>
</div>
<!-- Shop -->

<div class='shop'>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-3'>

                <!-- Shop Sidebar -->
                <div class='shop_sidebar'>
                    <div class='sidebar_section'>
                        <div class='sidebar_title'>Categories</div>

                        <ul class='sidebar_categories'>
                            <?php
                            foreach ($category->children as $child): ?>
                                <li><a href="<?= Html::encode(Url::to(['category', 'id' => $child->id])) ?>">
                                        <?= Html::encode($child->name) ?>
                                    </a>
                                </li>
                            <?php
                            endforeach; ?>
                        </ul>
                    </div>
                    <div class='sidebar_section filter_by_section'>
                        <div class='sidebar_title'>Filter By</div>
                        <div class='sidebar_subtitle'>Price</div>
                        <div class='filter_price'>
                            <div id='slider-range' class='slider_range'></div>
                            <p>Range: </p>
                            <p><input type='text' id='amount' class='amount' readonly
                                      style='border:0; font-weight:bold;'></p>
                        </div>
                    </div>
                    <div class='sidebar_section'>
                        <div class='sidebar_subtitle color_subtitle'>Color</div>
                        <ul class='colors_list'>
                            <li class='color'><a href='#' style='background: #b19c83;'></a></li>
                            <li class='color'><a href='#' style='background: #000000;'></a></li>
                            <li class='color'><a href='#' style='background: #999999;'></a></li>
                            <li class='color'><a href='#' style='background: #0e8ce4;'></a></li>
                            <li class='color'><a href='#' style='background: #df3b3b;'></a></li>
                            <li class='color'><a href='#' style='background: #ffffff; border: solid 1px #e1e1e1;'></a>
                            </li>
                        </ul>
                    </div>
                    <div class='sidebar_section'>
                        <div class='sidebar_subtitle brands_subtitle'>Brands</div>
                        <ul class='brands_list'>
                            <?php foreach($brands as $brand):?>
                                <?= "<li class='brand'><a href='#'>$brand->name </a></li>" ?>
                            <?php endforeach;?>
                            </ul>
                    </div>
                </div>

            </div>

            <div class='col-lg-9'>

                <!-- Shop Content -->
                <div class='shop_content'>
                    <div class='shop_bar clearfix'>
                        <div class='shop_product_count'><span>186</span> products found</div>
                        <div class='shop_sorting'>
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class='sorting_text'>highest rated<i class='fas fa-chevron-down'></i></span>
                                    <ul>
                                        <li class='shop_sorting_button'
                                            data-isotope-option='{ "sortBy": "original-order" }'>highest rated
                                        </li>
                                        <li class='shop_sorting_button' data-isotope-option='{ "sortBy": "name" }'>
                                            name
                                        </li>
                                        <li class='shop_sorting_button' data-isotope-option='{ "sortBy": "price" }'>
                                            price
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class='product_grid'>

                        <?php
                        foreach ($dataProvider->getModels() as $product): ?>
                        <?= $this->render(
                        '_product',
                        [
                        'product' => $product
                        ]
                        ) ?>
                        <?php
                        endforeach; ?>
                    </div>

                    <!-- Shop Page Navigation -->

                    <div class='shop_page_nav d-flex flex-row justify-content-center'>
                        <?= LinkPager::widget(
                            [
                                'pagination'           => $dataProvider->getPagination(),

                                'hideOnSinglePage'     => false,
                            ]
                        ) ?>
                    </div>
                        <div class='col text-center'>Showing <?= $dataProvider->getCount() ?> of <?= $dataProvider->getTotalCount(
                            ) ?></div>

                        <!--<div class='page_prev d-flex flex-column align-items-center justify-content-center'>
                            <i class='fas fa-chevron-left'></i>
                        </div>
                        <ul class='page_nav d-flex flex-row'>
                            <li><a href='#'>1</a></li>
                            <li><a href='#'>2</a></li>
                            <li><a href='#'>3</a></li>
                            <li><a href='#'>...</a></li>
                            <li><a href='#'>21</a></li>
                        </ul>
                        <div class='page_next d-flex flex-column align-items-center justify-content-center'>
                            <i class='fas fa-chevron-right'></i>
                        </div>-->
                    </div>

                </div>
            </div>
        </div>
    </div>

<!-- Recently Viewed -->

<div class='viewed'>
    <div class='container'>
        <div class='row'>
            <div class='col'>
                <div class='viewed_title_container'>
                    <h3 class='viewed_title'>Recently Viewed</h3>
                    <div class='viewed_nav_container'>
                        <div class='viewed_nav viewed_prev'><i class='fas fa-chevron-left'></i></div>
                        <div class='viewed_nav viewed_next'><i class='fas fa-chevron-right'></i></div>
                    </div>
                </div>

                <div class='viewed_slider_container'>

                    <!-- Recently Viewed Slider -->

                    <div class='owl-carousel owl-theme viewed_slider'>

                        <!-- Recently Viewed Item -->
                        <div class='owl-item'>
                            <div class='viewed_item discount d-flex flex-column align-items-center justify-content-center text-center'>
                                <div class='viewed_image'><img src='images/view_1.jpg' alt=''></div>
                                <div class='viewed_content text-center'>
                                    <div class='viewed_price'>$225<span>$300</span></div>
                                    <div class='viewed_name'><a href='#'>Beoplay H7</a></div>
                                </div>
                                <ul class='item_marks'>
                                    <li class='item_mark item_discount'>-25%</li>
                                    <li class='item_mark item_new'>new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class='owl-item'>
                            <div class='viewed_item d-flex flex-column align-items-center justify-content-center text-center'>
                                <div class='viewed_image'><img src='images/view_2.jpg' alt=''></div>
                                <div class='viewed_content text-center'>
                                    <div class='viewed_price'>$379</div>
                                    <div class='viewed_name'><a href='#'>LUNA Smartphone</a></div>
                                </div>
                                <ul class='item_marks'>
                                    <li class='item_mark item_discount'>-25%</li>
                                    <li class='item_mark item_new'>new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class='owl-item'>
                            <div class='viewed_item d-flex flex-column align-items-center justify-content-center text-center'>
                                <div class='viewed_image'><img src='images/view_3.jpg' alt=''></div>
                                <div class='viewed_content text-center'>
                                    <div class='viewed_price'>$225</div>
                                    <div class='viewed_name'><a href='#'>Samsung J730F...</a></div>
                                </div>
                                <ul class='item_marks'>
                                    <li class='item_mark item_discount'>-25%</li>
                                    <li class='item_mark item_new'>new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class='owl-item'>
                            <div class='viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center'>
                                <div class='viewed_image'><img src='images/view_4.jpg' alt=''></div>
                                <div class='viewed_content text-center'>
                                    <div class='viewed_price'>$379</div>
                                    <div class='viewed_name'><a href='#'>Huawei MediaPad...</a></div>
                                </div>
                                <ul class='item_marks'>
                                    <li class='item_mark item_discount'>-25%</li>
                                    <li class='item_mark item_new'>new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class='owl-item'>
                            <div class='viewed_item discount d-flex flex-column align-items-center justify-content-center text-center'>
                                <div class='viewed_image'><img src='images/view_5.jpg' alt=''></div>
                                <div class='viewed_content text-center'>
                                    <div class='viewed_price'>$225<span>$300</span></div>
                                    <div class='viewed_name'><a href='#'>Sony PS4 Slim</a></div>
                                </div>
                                <ul class='item_marks'>
                                    <li class='item_mark item_discount'>-25%</li>
                                    <li class='item_mark item_new'>new</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Recently Viewed Item -->
                        <div class='owl-item'>
                            <div class='viewed_item d-flex flex-column align-items-center justify-content-center text-center'>
                                <div class='viewed_image'><img src='images/view_6.jpg' alt=''></div>
                                <div class='viewed_content text-center'>
                                    <div class='viewed_price'>$375</div>
                                    <div class='viewed_name'><a href='#'>Speedlink...</a></div>
                                </div>
                                <ul class='item_marks'>
                                    <li class='item_mark item_discount'>-25%</li>
                                    <li class='item_mark item_new'>new</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

<div class='brands'>
    <div class='container'>
        <div class='row'>
            <div class='col'>
                <div class='brands_slider_container'>

                    <!-- Brands Slider -->

                    <div class='owl-carousel owl-theme brands_slider'>

                        <div class='owl-item'>
                            <div class='brands_item d-flex flex-column justify-content-center'><img
                                        src='images/brands_1.jpg' alt=''></div>
                        </div>
                        <div class='owl-item'>
                            <div class='brands_item d-flex flex-column justify-content-center'><img
                                        src='images/brands_2.jpg' alt=''></div>
                        </div>
                        <div class='owl-item'>
                            <div class='brands_item d-flex flex-column justify-content-center'><img
                                        src='images/brands_3.jpg' alt=''></div>
                        </div>
                        <div class='owl-item'>
                            <div class='brands_item d-flex flex-column justify-content-center'><img
                                        src='images/brands_4.jpg' alt=''></div>
                        </div>
                        <div class='owl-item'>
                            <div class='brands_item d-flex flex-column justify-content-center'><img
                                        src='images/brands_5.jpg' alt=''></div>
                        </div>
                        <div class='owl-item'>
                            <div class='brands_item d-flex flex-column justify-content-center'><img
                                        src='images/brands_6.jpg' alt=''></div>
                        </div>
                        <div class='owl-item'>
                            <div class='brands_item d-flex flex-column justify-content-center'><img
                                        src='images/brands_7.jpg' alt=''></div>
                        </div>
                        <div class='owl-item'>
                            <div class='brands_item d-flex flex-column justify-content-center'><img
                                        src='images/brands_8.jpg' alt=''></div>
                        </div>

                    </div>

                    <!-- Brands Slider Navigation -->
                    <div class='brands_nav brands_prev'><i class='fas fa-chevron-left'></i></div>
                    <div class='brands_nav brands_next'><i class='fas fa-chevron-right'></i></div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->

<div class='newsletter'>
    <div class='container'>
        <div class='row'>
            <div class='col'>
                <div class='newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center'>
                    <div class='newsletter_title_container'>
                        <div class='newsletter_icon'><img src='images/send.png' alt=''></div>
                        <div class='newsletter_title'>Sign up for Newsletter</div>
                        <div class='newsletter_text'><p>...and receive %20 coupon for first shopping.</p></div>
                    </div>
                    <div class='newsletter_content clearfix'>
                        <form action='#' class='newsletter_form'>
                            <input type='email' class='newsletter_input' required='required'
                                   placeholder='Enter your email address'>
                            <button class='newsletter_button'>Subscribe</button>
                        </form>
                        <div class='newsletter_unsubscribe_link'><a href='#'>unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
