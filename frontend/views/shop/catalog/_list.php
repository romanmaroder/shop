<?php
/* @var $dataProvider yii\data\DataProviderInterface */

/* @var $category core\entities\project\Category */

/* @var $brands core\entities\project\Brand */


use yii\helpers\Html;

?>
<!-- Home -->

<div class='home'>
    <div class='home_background parallax-window' data-parallax='scroll'
         data-image-src='images/shop_background.jpg'></div>
    <div class='home_overlay'></div>
    <div class='home_content d-flex flex-column align-items-center justify-content-center'>
        <h2 class='home_title'><?= Html::encode($this->title) ?: Html::encode($category->getHeadingTitle()); ?></h2>
        <?php
        if (trim($category->description ?? '')): ?>
            <span class="">
                <?= Yii::$app->formatter->asNtext($category->description) ?>
            </span>
            <?php
            endif; ?>
    </div>
</div>


<!-- Shop -->

<div class='shop'>
    <div class='container'>
        <div class='row'>

            <?= $this->render('_sidebar', [
            'category'=>$category,
            'brands' => $brands
            ]) ?>

            <?= $this->render('_content', [
            'dataProvider' => $dataProvider,
            ]) ?>
        </div>
    </div>
</div>