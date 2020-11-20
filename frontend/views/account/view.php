<?php

use yii\helpers\Html;
use \yii\bootstrap4\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Bill */

$this->title = "Conta ".$account->name;
?>
<div class="bill-view">

    <h1><?= Html::img('@web/img/billColor.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <p class="text-right">
        <?= Html::a('Apagar', ['delete', 'id' => $account->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar esta conta?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'dateTime',
            'status',
            'total',
            'Tables_id',
            'Employees_id',
            'Cashiers_id',
        ],
    ])*/ ?>

    <div class="mt-5 container">
        <div class="row mb-3 ml-1">
            <div class="col-4"><?= Html::img('@web/img/drinkColor.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-3"><?= Html::img('@web/img/sortingColor.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-4"><?= Html::img('@web/img/pricingColor.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-1"></div>
        </div>
        <div class="list-group" id="listProductsAccount">
            <?php
                if(empty($products)) {
                    echo '<h3> Não ha produtos prontos para pagamento</h3>';
                }
                foreach ($products as $product){
                        ?>
                        <span class="list-group-item list-group-item-action list-group-item-secondary" id="product_">
                            <div class="row">
                                <div class="col-4 h3">
                                    <span class="h3 mt-2" id="idMesa"><?=$product["name"]?></span>
                                </div>
                                <div class="col-3 h3">
                                     <a href="#"  ><?= Html::img('@web/img/Icons/Color/plus.png', ['class' => 'align-top mt-1', 'style' => 'width: 40px']) ?></a>
                                    <span id="accountProductQuantity" class="mt-2 mr-2 ml-2"><?=$product["quantity"]?></span>
                                     <a href="#" ><?= Html::img('@web/img/Icons/Color/minus.png', ['class' => 'align-top mt-1', 'style' => 'width: 40px']) ?></a>
                                </div>
                                <div class="col-4 h3">
                                    <span class="mt-2"><?=$product["price"]?></span>
                                </div>
                                <div class="col-1 text-center">
                                    <a href="#" class="mr-5" data-toggle="modal" data-target="#editProduct"><i class="fa fa-2x fa-trash"></i></a>
                                </div>
                            </div>
                        </span>
                        <?php
                }
                    ?>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <button type="button" class="btn" data-toggle="modal" data-target="payment">
                    <?= Html::img('@web/img/receiptColor.png', ['class' => 'align-top', 'style' => 'width: 65px']) ?>
                </button>
                <a name="" id="" class="btn" href="/index.php?r=bill%2Fsplit&id=2" role="button">
                    <?= Html::img('@web/img/splitColor.png', ['class' => 'align-top', 'style' => 'width: 65px']) ?>
                </a>
            </div>
            <?php
            if(!empty($requests)){
            ?>
            <div class="col-6 text-right">
                <p class="h4 text-dark mt-4">Total: <span class="h2" id="accountTotal"><?=$account->total?></span></p>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

</div>