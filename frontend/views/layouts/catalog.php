<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\ShopAsset;
use frontend\widgets\CategoriesWidget;



ShopAsset::register($this);
?>
<?php
$this->beginContent('@frontend/views/layouts/main.php') ?>
    <!-- Home -->

    <div class='home'>
        <div class='home_background parallax-window' data-parallax='scroll'
             data-image-src='images/shop_background.jpg'></div>
        <div class='home_overlay'></div>
        <div class='home_content d-flex flex-column align-items-center justify-content-center'>
            <h2 class='home_title'><?=$this->title;?></h2>
            <?php if (trim(Yii::$app->params['category_description'] ?: '')): ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?= Yii::$app->formatter->asHtml(Yii::$app->params['category_description'], [
                            'Attr.AllowedRel' => array('nofollow'),
                            'HTML.SafeObject' => true,
                            'Output.FlashCompat' => true,
                            'HTML.SafeIframe' => true,
                            'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                        ]) ?>
                    </div>
                </div>
            <?php endif; ?>
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

                            <?= CategoriesWidget::widget([
                                    'active'=>$this->params['active_category'] ?? null
                            ]) ?>
                        </div>
                        <div class='sidebar_section filter_by_section'>
                            <div class='sidebar_title'>Filter By</div>
                            <div class='sidebar_subtitle'>Price</div>
                            <div class='filter_price'>
                                <div id='slider-range' class='slider_range'></div>
                                <p>Range: </p>
                                <p><label><input type='text' id='amount' class='amount' readonly
                                          style='border:0; font-weight:bold;'></label></p>
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
                                <li class='color'><a href='#'
                                                     style='background: #ffffff; border: solid 1px #e1e1e1;'></a></li>
                            </ul>
                        </div>
                        <div class='sidebar_section'>
                            <div class='sidebar_subtitle brands_subtitle'>Brands</div>
                            <ul class='brands_list'>
                                <li class='brand'><a href='#'>Apple</a></li>
                                <li class='brand'><a href='#'>Beoplay</a></li>
                                <li class='brand'><a href='#'>Google</a></li>
                                <li class='brand'><a href='#'>Meizu</a></li>
                                <li class='brand'><a href='#'>OnePlus</a></li>
                                <li class='brand'><a href='#'>Samsung</a></li>
                                <li class='brand'><a href='#'>Sony</a></li>
                                <li class='brand'><a href='#'>Xiaomi</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <?= $content ?>
            </div>
        </div>
    </div>
<?php
$this->endContent() ?>