<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Criar Pedido';
?>
<div class="request-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php?r=table%2Findex">Pedidos</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <div class="text-right">
        <?php if(isset($_GET["tableId"]))
            {
                ?>
        <button class="btn btn-success" onclick="window.location.href='<?=Url::to(["request/postcreate","Table"=>$_GET["tableId"]])?>'">Finalizar pedido</button>
        <?php
            }
            if(isset($_GET["bill"])){
                ?>
                <button class="btn btn-success" onclick="window.location.href='<?=Url::to(["request/postcreate","bill"=>$_GET["bill"]])?>'">Finalizar pedido</button>
                <?php
            }
            ?>
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

