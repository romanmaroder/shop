<?php

use core\entities\project\Brand;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\shop\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create Brand', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class='invoice p-3 mb-3'>
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
            'id',
            [
            'attribute' => 'name',
            'value' => function (Brand $model) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
            },
            'format' => 'raw',
            ],
            'slug',
            ['class' => ActionColumn::class],
            ],
            ]); ?>
        </div>
    </div>
</div>