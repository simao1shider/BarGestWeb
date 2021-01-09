<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
?>
<div class="category-index container-fluid ml-5">
    <div class="row">
        <div class="col-4">
            <h1><?= Html::img('@web/img/Icons/Color/grid.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
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
        <div class="row">
            <?php
            if (empty($categories)) {
            ?>
                <h2>Não existem categorias</h2>
            <?php
            }
            foreach ($categories as $category) {
            ?>
                <div class="col-4 mt-3">

                    <div class="card shadow-sm text-center pt-2 pb-2">
                        <div class="card-body">
                            <a href="<?= Url::to(["view", "id" => $category->id]) ?>">
                                <h5 class="card-title mt-5 mb-5"><?= $category->name ?></h5>
                            </a>
                            <div class="btn-group float-right mt-1">
                                <a href="<?= Url::to(["category/update", "id" => $category->id]) ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                                <?= Html::a('<i class="fa fa-trash"></i>', ['delete'], [
                                    'class' => 'btn btn-sm btn-outline-danger',
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'id' => $category->id,
                                    ],
                                ]) ?>
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