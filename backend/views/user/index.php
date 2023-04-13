<?php

use core\entities\user\User;
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
<div class="user-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class='box'>
        <div class='box-body'>
            <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'created_at:datetime',
            'username',
            'email:email',
            'status',
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

</div>
