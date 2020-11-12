<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $category->id;
?>
<div class="category-view">

    <h1><?= Html::img('@web/img/gridColor.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="/index.php?r=category%2Findex">Categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes de Categoria</li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

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
            

            <?= Html::a('<i class="fa fa-2x fa-pencil"></i>', ['update', 'id' => $category->id], ['class' => 'btn btn-lg btn-primary']) ?>
            <?= Html::a('<i class="fa fa-2x fa-trash"></i>', ['delete', 'id' => $category->id], [
                'class' => 'btn btn-lg btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que pretende apagar?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <hr>
    <div class="mt-5 container">
        <div class="row">
            <?php
                foreach ($category->products as $product){
            ?>
            <div class="col-4 mt-3">
                <a href="/index.php?r=category%2Fview&id=1">
                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <h5 class="card-title mt-5 mb-5"><?= $product->name ?></h5>
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