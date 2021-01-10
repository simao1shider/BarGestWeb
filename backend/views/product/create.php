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

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($product, 'base_price')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($product, 'price')->textInput(['readonly' => true]) ?>
                </div>
            </div>

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

<script>
    const source = document.getElementById('product-base_price');
    const source1 = document.getElementById('product-profit_margin');
    const source2 = document.getElementById('product-iva_id');
    const result = document.getElementById("product-price");
    var total = 0;
    var base_price = 0;
    var profit_margin = 0;
    var iva = 0;

    const inputHandler = function(e) {
        base_price = Number(e.target.value);
        total = calcularTotal();
        result.value = total;
    }

    const inputHandler1 = function(e) {
        profit_margin = e.target.value;
        profit_margin = Number(profit_margin * 0.01);
        total = calcularTotal();
        result.value = total;
    }

    const inputHandler2 = function(e) {
        iva = e.target.value;
        iva = Number(source2.options[source2.selectedIndex].innerHTML * 0.01);
        total = calcularTotal();
        result.value = total;
    }

    function calcularTotal(){
        console.log(iva);
        total = base_price + (base_price * iva);
        console.log(iva);
        total = total + (total * profit_margin);
        console.log(iva);
        return Math.round(total * 100) / 100;
    }

    source.addEventListener('input', inputHandler);
    source.addEventListener('propertychange', inputHandler);
    source1.addEventListener('input', inputHandler1);
    source1.addEventListener('propertychange', inputHandler1);
    source2.addEventListener('input', inputHandler2);
    source2.addEventListener('propertychange', inputHandler2);
</script>