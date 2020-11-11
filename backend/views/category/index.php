<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
?>
<div class="category-index">

    <h1><?= Html::img('@web/img/Icons/Color/grid.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <p>
        <?= Html::a('Criar <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success float-right']) ?>
    </p>

    <div class="mt-5 container">
        <div class="row">
            <div class="col-4 mt-3">
                <a href="/index.php?r=category%2Fview&id=1">
                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <h5 class="card-title mt-5 mb-5">Gins</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 mt-3">
                <a href="#">
                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <h5 class="card-title mt-5 mb-5">Vinhos</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 mt-3">
                <a href="#">
                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <h5 class="card-title mt-5 mb-5">Whiskys</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 mt-3">
                <a href="#">
                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <h5 class="card-title mt-5 mb-5">Águas</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 mt-3">
                <a href="#">
                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <h5 class="card-title mt-5 mb-5">Refrigerantes</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4 mt-3">
                <a href="#">
                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <h5 class="card-title mt-5 mb-5">Cafetaria</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>


</div>