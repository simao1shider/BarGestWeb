<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
?>
<div class="category-index">

    <h1><?= Html::img('@web/img/gridColor.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success float-right']) ?>
    </p>

    <div class="mt-5 container">
        <div class="row">
            <?php
            foreach ($categories as $category) {
            ?>
                <div class="col-4 mt-3">
                    <a href="/index.php?r=category%2Fview&id=1">
                        <div class="card shadow-sm text-center pt-2 pb-2">
                            <div class="card-body">
                                <h5 class="card-title mt-5 mb-5"><?= $category->name ?></h5>
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