<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\AppAsset;
use frontend\assets\ShopAsset;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);
ShopAsset::register($this);


?>
<?php
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name='viewport' content='width=device-width, initial-scale=1'/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
        <link href="<?= Yii::getAlias('@web/images/cart.png') ?>" rel="icon"/>
        <?php
        $this->head() ?>
    </head>
    <body>
    <?php
    $this->beginBody() ?>
    <div class='super_container'>

        <!-- Header -->
        <?= $this->render(
            '_header'
        ) ?>


        <?= $content ?>

        <!-- Footer -->
        <?= $this->render(
            '_footer'
        ) ?>


        <!-- Copyright -->
        <?= $this->render(
            '_copyright'
        ) ?>

    </div>

    <?php
    $this->endBody() ?>
    </body>
    </html>
<?php
$this->endPage() ?>