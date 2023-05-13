<?php

use core\entities\project\Category;

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\shop\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="invoice p-3 mb-3">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
            'id',
            [
            'attribute' => 'name',
            'value' => function (Category $model) {
            $indent = ($model->depth > 1 ? str_repeat('&nbsp;&nbsp;', $model->depth - 1) . ' ' : '');
            return $indent . Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
            },
            'format' => 'raw',
            ],
            [
                    'value'=>function(Category $model){
                    return
                    Html::a('<i class="fas fa-arrow-up"></i>',['move-up','id'=>$model->id])
            .
                    Html::a('<i class="fas fa-arrow-down"></i>',['move-down','id'=>$model->id]);
            },
            'format'=>'raw',
            'contentOptions'=>['style'=>'text-align:center'],
            ],
            'slug',
            ['class' => ActionColumn::class],
            ],
            ]); ?>
        </div>
    </div>
</div>
