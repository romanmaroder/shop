<?php

use core\entities\project\product\Product;
use core\helpers\PriceHelper;
use core\helpers\ProductHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\forms\Shop\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="invoice p-3 mb-3">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
            [
            'value' => function (Product $model) {
            return $model->mainPhoto ? Html::img($model->mainPhoto->getThumbFileUrl('file', 'admin')) : null;
            },
            'format' => 'raw',
            'contentOptions' => ['style' => 'width: 100px'],
            ],
            'id',
            [
            'attribute' => 'name',
            'value' => function (Product $model) {
            return Html::a(Html::encode($model->name), ['view', 'id' => $model->id]);
            },
            'format' => 'raw',
            ],
            [
            'attribute' => 'category_id',
            'filter' => $searchModel->categoriesList(),
            'value' => 'category.name',
            ],
            [
            'attribute' => 'price_new',
            'value' => function (Product $model) {
            return PriceHelper::format($model->price_new);
            },
            ],
            ['attribute'=>'status',
            'filter'=>$searchModel->statusList(),
            'value'=>function(Product $model){ return ProductHelper::statusLabel($model->status);},
            'format'=>'raw',
            'contentOptions' => ['style' => 'text-align:center'],]
            ],
            ]); ?>
        </div>
    </div>
</div>