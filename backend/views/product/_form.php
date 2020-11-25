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

    <?php
    if(isset($categories)){
        echo $form->field($product, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'name'),['prompt'=>'Selecione o categoria']);
    }

    ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>