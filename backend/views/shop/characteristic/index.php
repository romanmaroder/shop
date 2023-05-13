<?php

use core\entities\project\Characteristic;
use core\helpers\CharacteristicHelper;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Shop\CharacteristicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Characteristics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create Characteristic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="invoice p-3 mb-3">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
            [
            'attribute' => 'name',
            'value' => function (Characteristic $model) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
            },
            'format' => 'raw',
            ],
            [
            'attribute' => 'type',
            'filter' => $searchModel->typesList(),
            'value' => function (Characteristic $model) {
            return CharacteristicHelper::typeName($model->type);
            },
            ],
            [
            'attribute' => 'required',
            'filter' => $searchModel->requiredList(),
            'format' => 'boolean',
            ],
            ['class' => ActionColumn::class],
            ],
            ]); ?>
        </div>
    </div>
</div>
