<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $products common\models\Product */

$this->title = $products[0]->category->name;
?>
<div class="category-view">

    <h1><?= Html::img('@web/img/Icons/Color/grid.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="/category/index">Categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes de Categoria</li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <div class="input-group mb-3 text-left">
                <input type="text" class="form-control" placeholder="Pesquisar produto..." aria-label="Pesquisar produto..." aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="mt-5 container">
        <div class="row">
            <?php
            foreach ($products as $product) {
            ?>
                <div class="col-4 mt-3">
                    <a href="#">
                        <div class="card shadow-sm text-center pt-2 pb-2">
                            <div class="card-body">
                                <h5 class="card-title mt-5"><?= $product->name ?></h5>
                                <span class="mb-4 text-secondary"><?= $product->price ?> €</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>