<?php
/* @var $category core\entities\project\Category*/

/* @var $brands core\entities\project\Brand */
?>

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