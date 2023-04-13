<?php

use core\entities\user\User;
use core\forms\manage\user\UserEditForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var $model UserEditForm */
/** @var $user User */

$this->title                   = 'Update User: ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class='invoice p-3 mb-3'>
    <div class="user-update">


        <?php
        $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['maxLength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxLength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php
        ActiveForm::end(); ?>

    </div>
</div>
