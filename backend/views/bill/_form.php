<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Bill */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dateTime')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Tables_id')->textInput() ?>

    <?= $form->field($model, 'Employees_id')->textInput() ?>

    <?= $form->field($model, 'Cashiers_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
