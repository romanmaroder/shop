<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var $model core\forms\manage\user\UserCreateForm */

$this->title                   = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='invoice p-3 mb-3'>
    <div class="user-create">

        <?php
        $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'username')->textInput(['maxlenght' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlenght' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput(['maxlenght' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save',['class'=>'btn btn-primary']) ?>
        </div>


        <?php
        ActiveForm::end(); ?>

    </div>
</div>
