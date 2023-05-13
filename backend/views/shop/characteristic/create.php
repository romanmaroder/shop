<?php

/* @var $this yii\web\View */
/* @var $model core\forms\manage\project\CharacteristicForm */

$this->title = 'Create Characteristic';
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
