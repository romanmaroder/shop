<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\forms\manage\project\CharacteristicForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characteristic-form">

    <?php
    $form = ActiveForm::begin(); ?>

    <div class='card card-outline card-secondary'>
        <div class='card-header'>
            <h3 class='card-title'>Characteristic</h3>
            <div class='card-tools'>
                <button type='button' class='btn btn-tool' data-card-widget='maximize'><i class='fas fa-expand'></i>
                </button>
                <button type='button' class='btn btn-tool' data-card-widget='collapse'><i class='fas fa-minus'></i>
                </button>
            </div>
        </div>
        <div class='card-body'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'type')->dropDownList($model->typesList()) ?>
            <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'required')->checkbox() ?>
            <?= $form->field($model, 'default')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'textVariants')->textarea(['rows' => 6]) ?>
        </div>
        <div class='card-footer bg-secondary'>
            <div class='form-group'>
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php
    ActiveForm::end(); ?>

</div>
