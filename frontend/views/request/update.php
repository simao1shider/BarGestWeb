<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = 'Pedido';
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
            <button class="btn btn-warning" onclick="window.location.href='<?=Url::to(["request/execupdate",'request'=>$_GET["id"]])?>'">Editar pedido</button>
            <button class="btn btn-danger" onclick="window.location.href='<?=Url::to(["request/delete","id"=>$_GET["id"]])?>'">Eliminar pedido</button>
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
                    <?php
                    foreach ($request->products as $product){
?>
                        <span class="list-group-item list-group-item-action list-group-item-secondary">
                        <div class="row">
                            <div class="col-6 h3">
                                <span class="h3 mt-2" id="idMesa"><?=$product->name?></span>
                            </div>
                            <div class="col-2 h3">
                                <span class="mt-2"><?=\common\models\ProductsToBePaid::find()
                                        ->where(["Requests_id"=>$request->id])
                                        ->andWhere(["Products_id"=>$product->id])->one()->quantity?></span>
                            </div>
                            <div class="col-2 h3">
                                <span class="mt-2"><?=$product->price?></span>
                            </div>
                            <div class="col-2 h3 mt-1">
                                <a href="#" class=""><?= Html::img('@web/img/Icons/Color/plus.png', ['class' => 'align-top', 'style' => 'width: 40px']) ?></a>
                                <a href="#" class=""><?= Html::img('@web/img/Icons/Color/minus.png', ['class' => 'align-top', 'style' => 'width: 40px']) ?></a>
                            </div>
                        </div>
                    </span>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

