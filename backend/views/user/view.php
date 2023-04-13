<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var core\entities\user\User $model */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
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
    <div class='box'>
        <div class='box-body'>
            <?= DetailView::widget([
        'model' => $model,
            'attributes' => [
            'id',
            'username',
            'email:email',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            ],
            ]) ?>
        </div>
    </div>
</div>
