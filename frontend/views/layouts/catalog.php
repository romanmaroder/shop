<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\ShopAsset;

ShopAsset::register($this);
?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<?= $content ?>

<?php $this->endContent() ?>