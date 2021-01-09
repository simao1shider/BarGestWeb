<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ivas';
?>
<div class="iva-index container-fluid ml-5">
    <div class="row">
        <div class="col-4">
            <h1><?= Html::img('@web/img/Icons/Color/ratio.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
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
            <div class="col-5 mt-3">
                <h3 class="text-center">Ivas Ativos</h3>
                <ul class="list-group">
                    <?php
                    if (empty($ivas_act)) {
                    ?>
                        <h2>Não existem ivas ativos</h2>
                        <?php
                    }
                    foreach ($ivas_act as $iva) {
                        if ($iva->status == 1) {
                        ?>
                            <li class="list-group-item list-group-item-secondary">
                                <span class="h3 font-weight-bold"><?= $iva->rate ?>%</span>
                                <a href="<?= Url::to(["iva/delete", "id" => $iva->id]) ?>" class="btn btn-sm btn-danger float-right mt-1"><i class="fa fa-trash"></i></a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-5 mt-3">
                <h3 class="text-center">Ivas Inátivos</h3>
                <ul class="list-group">
                    <?php
                    if (empty($ivas_inact)) {
                    ?>
                        <h2>Não existem ivas inativos</h2>
                        <?php
                    }
                    foreach ($ivas_inact as $iva) {
                        if ($iva->status == 0) {
                        ?>
                            <li class="list-group-item list-group-item-secondary">
                                <span class="h3 font-weight-bold"><?= $iva->rate ?>%</span>
                                <a href="<?= Url::to(["iva/reactivate", "id" => $iva->id]) ?>" class="btn btn-sm btn-primary float-right mt-1"><i class="fa fa-arrow-left"></i></a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>