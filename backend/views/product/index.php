<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $products common\models\Product */

$this->title = 'Produtos';
?>
<div class="product-index container-fluid ml-5">

    <h1><?= Html::img('@web/img/Icons/Color/drink.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <hr>
    <div class="row">
        <div class="col-4">
        <div class="input-group mb-3 text-left">
                <input type="text" class="form-control" placeholder="Pesquisar produto..." aria-label="Pesquisar produto..." aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-8 text-right">
            <?= Html::a('Criar <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-outline-success float-right']) ?>
        </div>
    </div>

    <div class="mt-5 container">
        <div class="row">
            <?php foreach ($products as $product){
                ?>
                <div class="col-4 mt-3">
                    <a href="<?=Url::to(["product/view",'id'=>$product->id])?>">
                        <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a class="text-center">
                                        <h5 class="card-title mt-5"><?= $product->name ?></h5>
                                        <span class="mb-4 text-secondary"><?= $product->price ?> €</span>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <div class="btn-group float-right mt-1">
                                        <a href="<?= Url::to(["product/update", "id" => $product->id]) ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                                        <?= Html::a(' <i class="fa fa-trash"></i>', ['product/delete', 'id' => $product->id,], [
                                            'class' => 'btn btn-sm btn-outline-danger',
                                            'data-method' => 'POST',
                                            'data-params' => [
                                                'id' => $product->id,
                                            ],
                                        ]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </a>
                </div>
            <?php
            }?>
        </div>
    </div>


</div>
