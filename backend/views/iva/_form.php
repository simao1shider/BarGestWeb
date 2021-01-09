<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Iva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="iva-form">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'rate')->textInput(['class' => 'form-control']) ?>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success float-right']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>