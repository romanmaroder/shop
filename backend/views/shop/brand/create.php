<?php

/* @var $this yii\web\View */
/* @var $model core\forms\manage\project\BrandForm */

$this->title = 'Create Brand';
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>