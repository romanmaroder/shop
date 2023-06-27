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


?>

<!-- Home -->

<div class='home'>
    <div class='home_background parallax-window' data-parallax='scroll'
         data-image-src='images/shop_background.jpg'></div>
    <div class='home_overlay'></div>
    <div class='home_content d-flex flex-column align-items-center justify-content-center'>
        <h2 class='home_title'><?= $this->title; ?></h2>
    </div>
</div>
<!-- Shop -->

<div class='shop'>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-3'>

                <!-- Shop Sidebar -->
                <div class='shop_sidebar'>
                    <?= $this->render('_subcategories', [
                        'category' => $category
                    ]) ?>

                    <?= $this->render('_filter_price', [

                    ]) ?>

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

                    <?= $this->render('_brands', [
                        'brands' => $brands
                    ]) ?>

                </div>

            </div>

            <div class='col-lg-9'>

                <!-- Shop Content -->
                <div class='shop_content'>
                    <div class='shop_bar clearfix'>
                        <div class='shop_product_count'><span><?= $dataProvider->getTotalCount(
                                ) ?></span> products found</div>
                        <div class='shop_sorting'>
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class='sorting_text'>highest rated<i class='fas fa-chevron-down'></i></span>
                                    <?php
                                    $values  = [
                                        'original-order' => 'highest rated',
                                        'name'           => 'name',
                                        'price'          => 'price',
                                    ];
                                    $current = Yii::$app->request->get('sortBy');
                                    ?>
                                    <?php
                                    /*foreach ($values as $value => $label): */ ?><!--
                                        <option value="<?
                                    /*= Html::encode(Url::current(['sort' => $value ?: null])) */ ?>"
                                        <?php
                                    /*if ($current == $value): */ ?>selected="selected"<?php
                                    /*endif; */ ?>><?
                                    /*= $label */ ?></option>
                                    --><?php
                                    /*endforeach; */ ?>
                                    <ul>
                                        <?php
                                        foreach ($values as $value => $label) : ?>

                                            <li class='shop_sorting_button'
                                                data-isotope-option='{ "sortBy": "<?= $value ?>" }'><?= $label ?>
                                            </li>

                                        <?php
                                        endforeach; ?>
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
                                'listOptions'=>[
                                        'class'=>'page_nav d-flex flex-row',
                                ],
                                'linkOptions'=>[],
                                'linkContainerOptions'=>[],
                                'prevPageCssClass'=>'page_prev mr-3 d-flex flex-column align-items-center justify-content-center',
                                'nextPageCssClass'=>'page_next ml-3 d-flex flex-column align-items-center justify-content-center',
                                'prevPageLabel'=>'<i class=\'fas fa-chevron-left\'></i>',
                                'nextPageLabel'=>'<i class=\'fas fa-chevron-right\'></i>',
                                'hideOnSinglePage'     => false,

                        ]
                        ) ?>
                    </div>
                    <div class='col text-center'>Showing <?= $dataProvider->getCount() ?> of <?= $dataProvider->getTotalCount(
                        ) ?></div>

                </div>

            </div>
        </div>
    </div>
</div>


