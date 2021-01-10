<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $product->name;
?>
<div class="product-view container-fluid ml-5">

    <div class="row">
        <div class="col-4">
            <h1><?= Html::img('@web/img/Icons/Color/drink.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
        </div>
        <div class="col-8 text-right">
            <?= Html::a('Editar', ['update'], ['class' => 'btn btn-outline-info mt-3']) ?>
            <?= Html::a('Apagar', ['delete', 'id' => $product->id], [
                'class' => 'btn btn-outline-danger mt-3',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Produtos</a></li>
            <li class="breadcrumb-item">Detalhes</li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col" style="width: 36.66%">Campo</th>
                        <th scope="col">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nome</td>
                        <td><?= $product->name ?></td>
                    </tr>
                    <tr>
                        <td>Preço Base</td>
                        <td><?= $product->base_price ?>€</td>
                    </tr>
                    <tr>
                        <td>Preço de Venda</td>
                        <td><?= $product->price ?>€</td>
                    </tr>
                    <tr>
                        <td>Margem de Lucro</td>
                        <td><?= $product->profit_margin ?>%</td>
                    </tr>
                    <tr>
                        <td>Iva</td>
                        <td><?= $product->iva->rate ?>%</td>
                    </tr>
                    <tr>
                        <td>Categoria</td>
                        <td><?= $product->category->name ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>