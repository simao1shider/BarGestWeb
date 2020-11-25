<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $product common\models\Product */
/* @var $ivas common\models\Iva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'profit_margin')->textInput() ?>

    <?= $form->field($product, 'iva_id')->dropDownList(ArrayHelper::map($ivas, 'id', 'rate'),['prompt'=>'Selecione o iva']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
