
<?php

/* @var $this yii\web\View */
/* @var $product core\entities\project\product\Product */
/* @var $modification core\entities\project\product\Modification */
/* @var $model core\forms\manage\project\product\ModificationForm */

$this->title = 'Update Modification: ' . $modification->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['shop/product/index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['shop/product/view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $modification->name;
?>
<div class="modification-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>