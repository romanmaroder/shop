<?php
/* @var $content string */

use frontend\assets\HomeAsset;


HomeAsset::register($this);
?>


<?php
$this->beginContent('@frontend/views/layouts/main.php') ?>

<?= $content; ?>

<?php
$this->endContent() ?>