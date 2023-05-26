<?php

/* @var $this yii\web\View */
/* @var $product core\entities\project\product\Product */
/* @var $model core\forms\manage\project\product\ModificationForm */

$this->title = 'Create Modification';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modification-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
