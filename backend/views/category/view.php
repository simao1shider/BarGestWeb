<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $products common\models\Product */

$this->title = $category->name;
?>
<div class="category-index container-fluid ml-5">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::img('@web/img/Icons/Color/grid.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
        </div>
        <div class="col-md-6 float-right">
            <p class="float-right mt-4">
                <?= Html::a('Criar <i class="fa fa-plus"></i>', ['product/create', 'categoryId' => $category->id], ['class' => 'btn btn-outline-success float-right']) ?>
            </p>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>


    <div class="mt-5 container">
        <div class="row">
            <?php
            if (empty($products)) {
            ?>
                <h2 class="text-center w-100">Esta categoria não tem produtos</h2>
            <?php
            }
            foreach ($products as $product) {
            ?>
                <div class="col-4 mt-3">
                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a class="text-center" href="<?=Url::to(["product/view",'id'=>$product->id])?>">
                                        <h5 class="card-title mt-5"><?= $product->name ?></h5>
                                        <span class="mb-4 text-secondary"><?= $product->price ?> €</span>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <div class="btn-group float-right mt-1">
                                        <?php
                                        if($product->status==\common\models\Product::STATUS_ACTIVE){
                                            ?>
                                            <a href="<?= Url::to(["product/update", "id" => $product->id]) ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                                            <?= Html::a(' <i class="fa fa-trash"></i>', ['product/delete', 'id' => $product->id,], [
                                                'class' => 'btn btn-sm btn-outline-danger',
                                                'data-method' => 'POST',
                                                'data-params' => [
                                                    'id' => $product->id,
                                                ],
                                            ]) ?>
                                        <?php
                                        }else{
                                            ?>
                                            <a href="<?= Url::to(["product/update", "id" => $product->id]) ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                                            <?= Html::a(' <i class="fa fa-check"></i>', ['category/active_product', 'id' => $product->id,], [
                                                'class' => 'btn btn-sm btn-outline-success',
                                                'data-method' => 'POST',
                                                'data-params' => [
                                                    'id' => $product->id,
                                                ],
                                            ]) ?>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>