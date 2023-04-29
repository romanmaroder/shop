<?php

use core\helpers\UserHelper;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var core\entities\user\User $model */

$this->title                   = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="invoice p-3 mb-3">
    <div class="user-view">

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(
                'Delete',
                ['delete', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'data'  => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method'  => 'post',
                    ],
                ]
            ) ?>
        </p>

        <?= DetailView::widget(
            [
                'model'      => $model,
                'attributes' => [
                    'id',
                    'username',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'value'     => UserHelper::statusLabel($model->status),
                        'format'    => 'raw',
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]
        ) ?>
    </div>
</div>
