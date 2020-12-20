<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $account common\models\Account */

$this->title = $account->dateTime;
?>
<div class="bill-view container-fluid ml-5">

    <h1><?= Html::img('@web/img/Icons/Color/getMoney.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Vendas</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="list-group">
                <?php
                if (empty($products)) {
                    echo '<h4>Sem produtos!</h4>';
                } else {
                    foreach ($products as $product) {
                ?>
                        <span class="list-group-item list-group-item-action list-group-item-secondary">
                            <div class="row">
                                <div class="col-6 h3">
                                    <span class="h3 mt-2" id="idMesa"><?= $product->product->name ?></span>
                                </div>
                                <div class="col-3 h3">
                                    <span class="mt-2"><?= $product->quantity ?></span>
                                </div>
                                <div class="col-3 h3">
                                    <span class="mt-2"><?= $product->product->price ?> €</span>
                                </div>
                            </div>
                        </span>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>