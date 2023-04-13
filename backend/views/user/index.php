<?php

use core\entities\user\User;
use core\helpers\UserHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\forms\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title                   = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice p-3 mb-3">
        <div class="user-index">

            <p>
                <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
            </p>


            <?= GridView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $searchModel,
                    'tableOptions' => [
                        'class' => 'table table-striped table-bordered text-center'
                    ],
                    'columns'      =>
                        [
                            'id',
                            'created_at:datetime',
                            [
                                'attribute' => 'username',
                                'value'     => function (User $model) {
                                    return Html::a(Html::encode($model->username), ['view', 'id' => $model->id]);
                                },
                                'format'    => 'raw',
                            ],
                            'email:email',
                            [
                                'attribute' => 'status',
                                'filter'    => UserHelper::statusList(),
                                'value'     => function (User $model) {
                                    return UserHelper::statusLabel($model->status);
                                },
                                'format'    => 'raw',

                            ],
                            [
                                'class'      => ActionColumn::class,
                                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                ]
            ); ?>


        </div>
</div>
