<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CashierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Caixas';
?>
<div class="cashier-index container-fluid ml-5">
    <div class="row">
        <div class="col-4">
            <h1><?= Html::img('@web/img/Icons/Color/receipt.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
        </div>
        <div class="col-8 text-right">
            <?= Html::a('Abrir Caixa <i class="fa fa-plus"></i>', ['abrircaixa'], ['class' => 'btn btn-outline-success mt-3']) ?>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>



    <div class="mt-5 container">
        <div class="row mb-3 ml-1">
            <div class="col-8"><?= Html::img('@web/img/Icons/Color/clock.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-2"><?= Html::img('@web/img/Icons/Color/pricing.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-2"></div>
        </div>
        <div class="list-group">
            <?php
            if (empty($cashiers)) {
            ?>
                <h2>Não existem caixas</h2>
            <?php
            }
            foreach ($cashiers as $cashier) {
            ?>
                <span class="list-group-item list-group-item-action list-group-item-secondary">
                    <div class="row">
                        <div class="col-8 h3">
                            <span class="h3 mt-2" id="idMesa"><?= $cashier->date ?></span>
                        </div>
                        <div class="col-2 h3">
                            <span class="mt-2"><?= $cashier->total ?>€</span>
                        </div>
                        <div class="col-2 h3">
                            <?= Html::a(
                                Html::img('@web/img/Icons/Color/eye.png', ['class' => 'align-top mt-2', 'style' => 'width: 45px']),
                                ['/sale/index'],
                                [
                                    'data-method' => 'POST',
                                    'data-params' => [
                                        'date' => $cashier->date,
                                    ],
                                ]
                            ) ?>
                            <?php
                            if ($cashier->status == 1) {
                            ?>
                                <a href="#" class="btn" data-toggle="modal" data-target="#staticBackdrop"><?= Html::img('@web/img/Icons/Color/unlocked.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></a>
                            <?php
                            } else {
                            ?>
                                <a href="#" class="btn" class=""><?= Html::img('@web/img/Icons/Color/locked.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </span>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Fechar Caixa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Tem a certeza que pretende fechar a caixa?</p>
            </div>
            <div class="modal-footer">
                <a href="fecharcaixa" type="button" class="btn btn-danger">Fechar Caixa</a>
            </div>
        </div>
    </div>
</div>