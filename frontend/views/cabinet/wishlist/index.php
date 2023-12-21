<?php

/* @var $this yii\web\View */

use core\entities\project\product\Product;
use core\helpers\PriceHelper;
use yii\bootstrap4\Breadcrumbs;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Wish List';
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wishlist-index mt-2">
    <div class="container">
        <div class='row'>
            <div class='col-12'><?= Breadcrumbs::widget(
                    [
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options' => ['class' => 'bg-white px-0'],
                    ]
                ) ?></div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col"><?= GridView::widget(
                    [
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'value' => function (Product $model) {
                                    return $model->mainPhoto ? Html::img(
                                        $model->mainPhoto->getThumbFileUrl('file', 'admin')
                                    ) : null;
                                },
                                'format' => 'raw',
                                'contentOptions' => ['style' => 'width: 100px'],
                            ],
                            'id',
                            [
                                'attribute' => 'name',
                                'value' => function (Product $model) {
                                    return Html::a(
                                        Html::encode($model->name),
                                        ['/shop/catalog/product', 'id' => $model->id]
                                    );
                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'price_new',
                                'value' => function (Product $model) {
                                    return PriceHelper::format($model->price_new);
                                },
                            ],
                            [
                                'class' => ActionColumn::class,
                                'template' => '{delete}',
                            ],
                        ],
                    ]
                ); ?></div>
        </div>

        </div>
    </div>
</div>
