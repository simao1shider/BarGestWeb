<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $product common\models\Product */
/* @var $ivas common\models\Iva */

$this->title = 'Criar Produto';
?>
<div class="product-create container-fluid ml-5">

    <h1><?= Html::img('@web/img/Icons/Color/drink.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Produtos</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <div class="product-form row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($product, 'price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($product, 'profit_margin')->textInput() ?>

            <?= $form->field($product, 'iva_id')->dropDownList(ArrayHelper::map($ivas, 'id', 'rate'), ['prompt' => 'Selecione o iva']) ?>

            <?php
            if (isset($categories)) {
                echo $form->field($product, 'category_id')->dropDownList(ArrayHelper::map($categories, 'id', 'name'), ['prompt' => 'Selecione o categoria']);
            }

            ?>
            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success float-right']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>