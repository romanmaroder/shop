<?php

use core\helpers\CharacteristicHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $characteristic core\entities\project\Characteristic */

$this->title = $characteristic->name;
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $characteristic->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $characteristic->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="invoice p-3 mb-3">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $characteristic,
            'attributes' => [
            'id',
            'name',
            [
            'attribute' => 'type',
            'value' => CharacteristicHelper::typeName($characteristic->type),
            ],
            'sort',
            'required:boolean',
            'default',
            [
            'attribute' => 'variants',
            'value' => implode(PHP_EOL, $characteristic->variants),
            'format' => 'ntext',
            ],
            ],
            ]) ?>
        </div>
    </div>
</div>
