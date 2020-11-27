<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
?>
<div class="category-index">

    <h1><?= Html::img('@web/img/Icons/Color/grid.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <p style="text-align: end">
        <?= Html::a('Editar <i class="fa fa-plus"></i>', ['update','id'=>$category->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Eliminar <i class="fa fa-plus"></i>', ['delete'], ['class' => 'btn btn-success']) ?>
    </p>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <p>
        <?= Html::a('Criar <i class="fa fa-plus"></i>', ['product/create','categoryId'=>$category->id], ['class' => 'btn btn-success float-right']) ?>
    </p>

    <div class="mt-5 container">
        <div class="row">
            <?php
            if(empty($products)){
                ?>
                <h2>Esta categoria não tem produtos</h2>
                    <?php
            }
            foreach ($products as $product){
                ?>
                <div class="col-4 mt-3">
                    <a href="<?=Url::to(["product/view","id"=>$product->id])?>">
                        <div class="card shadow-sm text-center pt-2 pb-2">
                            <div class="card-body">
                                <h5 class="card-title mt-5 mb-5"><?=$product->name?></h5>
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