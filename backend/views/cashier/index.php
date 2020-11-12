<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CashierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Caixas';
?>
<div class="cashier-index">

    <h1><?= Html::img('@web/img/Icons/Color/receipt.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <p class="text-right">
        <?= Html::a('Abrir Caixa <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="mt-5 container">
        <div class="row mb-3 ml-1">
            <div class="col-8"><?= Html::img('@web/img/Icons/Color/clock.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-2"><?= Html::img('@web/img/Icons/Color/pricing.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-1"></div>
        </div>
        <div class="list-group">
            <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-8 h3">
                        <span class="h3 mt-2" id="idMesa">28-11-2020</span>
                    </div>
                    <div class="col-2 h3">
                        <span class="mt-2">5.99€</span>
                    </div>
                    <div class="col-2 h3">
                        <a href="#" class=""><?= Html::img('@web/img/Icons/Color/unlocked.png', ['class' => 'align-top', 'style' => 'width: 50px']) ?></a>
                    </div>
                </div>
            </span>
            <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-8 h3">
                        <span class="h3 mt-2" id="idMesa">27-11-2020</span>
                    </div>
                    <div class="col-2 h3">
                        <span class="mt-2">5.99€</span>
                    </div>
                    <div class="col-2 h3">
                        <a href="#" class=""><?= Html::img('@web/img/Icons/Color/unlocked.png', ['class' => 'align-top', 'style' => 'width: 50px']) ?></a>
                    </div>
                </div>
            </span>
            <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-8 h3">
                        <span class="h3 mt-2" id="idMesa">26-11-2020</span>
                    </div>
                    <div class="col-2 h3">
                        <span class="mt-2">5.99€</span>
                    </div>
                    <div class="col-2 h3">
                        <a href="#" class=""><?= Html::img('@web/img/Icons/Color/unlocked.png', ['class' => 'align-top', 'style' => 'width: 50px']) ?></a>
                    </div>
                </div>
            </span>
            <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-8 h3">
                        <span class="h3 mt-2" id="idMesa">25-11-2020</span>
                    </div>
                    <div class="col-2 h3">
                        <span class="mt-2">5.99€</span>
                    </div>
                    <div class="col-2 h3">
                        <a href="#" class=""><?= Html::img('@web/img/Icons/Color/unlocked.png', ['class' => 'align-top', 'style' => 'width: 50px']) ?></a>
                    </div>
                </div>
            </span>
            <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-8 h3">
                        <span class="h3 mt-2" id="idMesa">24-11-2020</span>
                    </div>
                    <div class="col-2 h3">
                        <span class="mt-2">5.99€</span>
                    </div>
                    <div class="col-2 h3">
                        <a href="#" class=""><?= Html::img('@web/img/Icons/Color/unlocked.png', ['class' => 'align-top', 'style' => 'width: 50px']) ?></a>
                    </div>
                </div>
            </span>
        </div>
    </div>
</div>
