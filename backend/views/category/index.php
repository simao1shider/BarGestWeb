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
        <ul class="nav nav-pills mb-3 text-right justify-content-end" id="pills-category-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-categories-active-tab" data-toggle="pill" href="#pills-categories-active" role="tab" aria-controls="pills-categories-active-active" aria-selected="true">Atuais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-categories-deleted-tab" data-toggle="pill" href="#pills-categories-deleted" role="tab" aria-controls="pills-categories-deleted" aria-selected="false">Eliminados</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContentCategory">
            <div class="tab-pane fade show active " id="pills-categories-active" role="tabpanel" aria-labelledby="pills-categories-active-tab">
                <div class="row">
                    <?php
                    if (empty($activeCategories)) {
                        ?>
                        <h2>Não existem categorias</h2>
                        <?php
                    }
                    foreach ($activeCategories as $category) {
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
            <div class="tab-pane fade show" id="pills-categories-deleted" role="tabpanel" aria-labelledby="pills-categories-active-tab">
                <div class="row">
                    <?php
                    if (empty($deletedCategories)) {
                        ?>
                        <h2>Não existem categorias</h2>
                        <?php
                    }
                    foreach ($deletedCategories as $category) {
                        ?>
                        <div class="col-4 mt-3">

                            <div class="card shadow-sm text-center pt-2 pb-2">
                                <div class="card-body">
                                    <a href="<?= Url::to(["view", "id" => $category->id]) ?>">
                                        <h5 class="card-title mt-5 mb-5"><?= $category->name ?></h5>
                                    </a>
                                    <div class="btn-group float-right mt-1">
                                        <a href="<?= Url::to(["category/update", "id" => $category->id]) ?>" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></a>
                                        <?= Html::a('<i class="fa fa-check"></i>', ['activeCategory'], [
                                            'class' => 'btn btn-sm btn-outline-success',
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


    </div>


</div>