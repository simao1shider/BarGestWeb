<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $employee common\models\Employee */
/* @var $employee common\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($employee, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($employee, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($employee, 'phone')->textInput() ?>

    <?= $form->field($employee, 'birthDate')->textInput() ?>

    <?= $form->field($signup, 'username')->textInput() ?>

    <?= $form->field($signup, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
