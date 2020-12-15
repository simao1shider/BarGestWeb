<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Criar Pedido';
?>
<div class="request-create container-fluid ml-5">
    <h1><?= Html::encode($this->title) ?>
        <?php
        if(isset($_GET["account"])){
            echo "<br>Conta:".$model->name."(".$model->id.")";
        }
        ?>
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="../request/index">Pedidos</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <div>
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => ['request/postcreate'],
            'options' => [
                    'class' => 'form-row',
		            'enctype' => 'multipart/form-data']
            ]);
        ?>
        <div class="col-9">
            <?php
            if(isset($_GET["tableId"])) {
                echo $form->field($model, 'name')->textInput(['placeholder' => $model->getAttributeLabel('name')])->label(false);
                echo $form->field($model, 'table_id')->hiddenInput()->label(false);
            }
            if(isset($_GET["account"])){
                echo $form->field($model, 'id')->hiddenInput()->label(false);
            }
            ?>
        </div>
        <div class="form-group text-right col-3">
            <?= Html::submitButton('Finalizar pedido', ['class' => 'btn btn-success',]) ?>
        </div>

        <?php
        ActiveForm::end(); ?>

    </div>
    
    <div class="row mt-5">
        <div class="col-md-6 text-center border-right border-dark">
            <h2>Procurar Produto</h2>
            <div class="row" id="contentSelectProduct">

            </div>
        </div>
        <div class="col-md-6">
            <div class="container">
                <div class="text-center mb-3"><h2>Lista de Produtos do Pedido</h2></div>
                <div class="row mb-3 ml-1">
                    <div class="col-6"><?= Html::img('@web/img/Icons/Color/drink.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-2"><?= Html::img('@web/img/Icons/Color/sorting.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-2"><?= Html::img('@web/img/Icons/Color/pricing.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-2"></div>
                </div>
                <div class="list-group" id="listProducts" style="overflow-y: scroll; height: 600px;">


                </div>
            </div>
        </div>
    </div>
</div>

