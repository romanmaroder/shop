<?php

/* @var $this yii\web\View */
/* @var $tag core\entities\project\Tag */
/* @var $model core\forms\manage\project\BrandForm */

$this->title = 'Update Tag: ' . $tag->name;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $tag->name, 'url' => ['view', 'id' => $tag->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tag-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>