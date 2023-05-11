<?php

/* @var $this yii\web\View */
/* @var $brand core\entities\project\Brand */
/* @var $model core\forms\manage\project\BrandForm */

$this->title = 'Update Brand: ' . $brand->name;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brand-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>