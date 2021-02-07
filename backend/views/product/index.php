<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $products common\models\Product */

$this->title = 'Produtos';
?>
<div class="product-index container-fluid ml-5">

    <div class="row">
        <div class="col-4">
            <h1><?= Html::img('@web/img/Icons/Color/drink.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
        </div>
        <div class="col-8 text-right">
            <?= Html::a('Criar <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-outline-success mt-3']) ?>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>


    <div class="mt-5 container">
        <ul class="nav nav-pills mb-3 text-right justify-content-end" id="pills-category-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-products-active-tab" data-toggle="pill" href="#pills-products-active" role="tab" aria-controls="pills-products-active-active" aria-selected="true">Atuais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-products-deleted-tab" data-toggle="pill" href="#pills-products-deleted" role="tab" aria-controls="pills-products-deleted-deleted" aria-selected="false">Eliminados</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContentCategory">
            <div class="tab-pane fade show active " id="pills-products-active" role="tabpanel" aria-labelledby="pills-products-active-tab">
                <div class="row">
                    <?php
                    if (empty($activeProducts)) {
                    ?>
                        <h2>Não existem produtos</h2>
                    <?php
                    }
                    foreach ($activeProducts as $product) {
                    ?>
                        <div class="col-4 mt-3">
                            <div class="card shadow-sm text-center pt-2 pb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="text-center" href="<?= Url::to(["product/view", 'id' => $product->id]) ?>">
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
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
            <div class="tab-pane fade show " id="pills-products-deleted" role="tabpanel" aria-labelledby="pills-products-deleted-tab">
                <div class="row">
                    <?php
                    if (empty($deletedProducts)) {
                    ?>
                        <h2>Não existem produtos</h2>
                    <?php
                    }
                    foreach ($deletedProducts as $product) {
                    ?>
                        <div class="col-4 mt-3">
                            <div class="card shadow-sm text-center pt-2 pb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="text-center" href="<?= Url::to(["product/view", 'id' => $product->id]) ?>">
                                                <h5 class="card-title mt-5"><?= $product->name ?></h5>
                                                <span class="mb-4 text-secondary"><?= $product->price ?> €</span>
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <div class="btn-group float-right mt-1">
                                                <a href="<?= Url::to(["product/update", "id" => $product->id]) ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                                                <?= Html::a(' <i class="fa fa-check"></i>', ['product/active_product', 'id' => $product->id,], [
                                                    'class' => 'btn btn-sm btn-outline-success',
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
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>


</div>