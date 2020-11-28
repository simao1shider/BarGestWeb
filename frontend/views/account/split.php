<?php

use yii\helpers\Html;

$this->title = "Pagamento Parcial";
?>
<div class="split-view">

    <h1><?= Html::img('@web/img/icons/color/sale.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <div class="mt-5 container">
        <div class="row mb-3">
            <div class="col-6">
                <div class="row">
                    <div class="col-6"><?= Html::img('@web/img/icons/color/drink.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-2"><?= Html::img('@web/img/icons/color/sorting.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-3"><?= Html::img('@web/img/icons/color/pricing.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="row ml-2 text-right">
                    <div class="col-1"></div>
                    <div class="col-5"><?= Html::img('@web/img/icons/color/drink.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-2"><?= Html::img('@web/img/icons/color/sorting.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-4"><?= Html::img('@web/img/icons/color/pricing.png', ['class' => 'align-top mr-4', 'style' => 'width: 45px']) ?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="list-group" id="listProductsToBePaid"></div>
            </div>
            <div class="col-6">
                <div class="list-group text-right">
                    <span class="list-group-item list-group-item-action list-group-item-secondary">
                        <div class="row">
                            <div class="col-1 text-center">
                                <a href="#" class="mr-5"><i class="fa fa-2x fa-arrow-left"></i></a>
                            </div>
                            <div class="col-6 h3">
                                <span class="h3 mt-2" id="idMesa">Gordons</span>
                            </div>
                            <div class="col-2 h3">
                                <span class="mt-2">3</span>
                            </div>
                            <div class="col-3 h3">
                                <span class="mt-2">5.99€</span>
                            </div>

                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-6">

            </div>
            <div class="col-6 text-right">
                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                    <?= Html::img('@web/img/icons/color/receipt.png', ['class' => 'align-top', 'style' => 'width: 65px']) ?>
                </button>
                <span class="h4 text-dark">Total: <span class="h2">5.99€</span></span>

            </div>
        </div>
    </div>
</div>