<?php

/* @var $this yii\web\View */

/* @var $product core\entities\project\product\Product */

/* @var $cartForm core\forms\project\AddToCartForm */

/* @var $reviewForm core\forms\project\ReviewForm */

use core\helpers\LastSlash;
use core\helpers\PriceHelper;
use frontend\assets\MagnificPopupAsset;
use frontend\widgets\ProductPhotoListWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $product->name;

$this->registerMetaTag(['name' => 'description', 'content' => $product->meta->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $product->meta->keywords]);


$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($product->category->parents as $parent) {
    if (!$parent->isRoot()){
        $this->params['breadcrumbs'][]=['label'=>$parent->name,'url'=>['category','id'=>$parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label'=>$product->category->name,'url'=>['category','id'=>$product->category->id]];
$this->params['breadcrumbs'][] = $product->name;
$this->params['active_category'] = $product->category;


MagnificPopupAsset::register($this);
?>

<!-- Single Product -->

<div class='single_product'>
    <div class='container'>
        <div class='row'>
            <div class='col-12'><?= Breadcrumbs::widget(
                    [
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => ['class' => 'bg-white px-0'],
                    ]
                ) ?></div>
        </div>
        <div class='row' xmlns:fb='http://www.w3.org/1999/xhtml'>

            <?= ProductPhotoListWidget::widget(
                [
                    'product' => $product,
                ]
            ); ?>

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
                    <div class='product_text'><p><?= Yii::$app->formatter->asNtext($product->description) ?></p>
                        <div class="product_characteristic">
                            <p>Product characteristics</p>
                            <table class="table table-striped">
                                <?php foreach ($product->values as $value): ?>
                                    <?php if (!empty($value->value)): ?>
                                        <tr>
                                            <th><?= Html::encode($value->characteristic->name) ?></th>
                                            <th><?= Html::encode($value->value) ?></th>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </table>
                        </div>
                    </div>
                    <div class='product_text'>
                        Brand: <a
                                href="<?= Html::encode(Url::to(['brand', 'id' => $product->brand->id])) ?>">
                            <?= Html::encode($product->brand->name) ?></a><br>
                        Tags:
                        <?php

                        foreach ($product->tags as $i =>$tag): ?>

                                <a href="<?= Html::encode(Url::to(['tag', 'id' => $tag->id])) ?>">
                                    <?= Html::encode($tag->name) ?>
                                </a> <?=LastSlash::slash($i,$product->tags) ;?>

                        <?php
                        endforeach; ?>
                        <p>Product Code: <?= Html::encode($product->code) ?></p>
                    </div>
                    <div class='order_info d-flex flex-row'>
                        <?php
                        $form = ActiveForm::begin() ?>

                        <div class='clearfix' style='z-index: 1000;'>

                            <!-- Product Quantity -->
                            <div class='product_quantity clearfix'>
                                <span>Quantity: </span>
                                <?= $form->field($cartForm, 'quantity')->textInput(
                                    ['id' => 'quantity_input', 'pattern' => "[0-9]*"]
                                )->label(false) ?>
                                <div class='quantity_buttons'>
                                    <div id='quantity_inc_button' class='quantity_inc quantity_control'><i
                                                class='fas fa-chevron-up'></i></div>
                                    <div id='quantity_dec_button' class='quantity_dec quantity_control'><i
                                                class='fas fa-chevron-down'></i></div>
                                </div>
                            </div>

                            <!-- Product Modification -->

                            <?= $form->field(
                                $cartForm,
                                'modification',
                                ['options' => ['class' => 'product_modification'],
                                ]
                            )->dropdownList(
                                $cartForm->modificationsList(),
                                [
                                    'prompt' => 'Select modifications',
                                    'class' => 'product_modification-list',
                                ]
                            )->label(false) ?>

                        </div>

                        <div class='product_price'>$<?= PriceHelper::format($product->price_new) ?></div>

                        <div class='button_container'>
                            <button type='button' class='button cart_button'>Add to Cart</button>
                            <div class='product_fav'><i class='fas fa-heart'></i></div>
                        </div>


                        <?php
                        ActiveForm::end() ?>
                    </div>
                </div>
            </div>


        </div>

        <!-- Review Form -->
        <!--<div class="row">
                <div class="col-12">
                    <?php /*if (Yii::$app->user->isGuest): */ ?>

                    <div class="panel-panel-info">
                        <div class="panel-body">
                            Please <? /*= Html::a('Log In', ['/auth/auth/login']) */ ?> for writing a review.
                        </div>

                        <?php /*else: */ ?>

                        <?php /*$form = ActiveForm::begin(['id' => 'form-review']) */ ?>

                        <? /*= $form->field($reviewForm, 'vote')->dropDownList($reviewForm->votesList(), ['prompt' => '--- Select ---']) */ ?>
                        <? /*= $form->field($reviewForm, 'text')->textarea(['rows' => 5]) */ ?>

                        <div class="form-group">
                            <? /*= Html::submitButton('Send', ['class' => 'btn btn-primary btn-lg btn-block']) */ ?>
                        </div>
                            <?php /*ActiveForm::end() */ ?>

                        <?php /*endif; */ ?>
                    </div>
                </div>
            </div>-->

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


