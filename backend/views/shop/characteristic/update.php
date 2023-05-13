<?php

/* @var $this yii\web\View */
/* @var $characteristic core\entities\project\Characteristic */
/* @var $model core\forms\manage\project\CharacteristicForm */

$this->title = 'Update Characteristic: ' . $characteristic->name;
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $characteristic->name, 'url' => ['view', 'id' => $characteristic->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="characteristic-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
