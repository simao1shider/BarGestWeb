<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = "Pagamento Parcial";
?>
<div class="split-view container-fluid ml-5">

    <h1><?= Html::img('@web/img/icons/color/split.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <div class="mt-5 container">
        <div class="row mb-3">
            <div class="col-6">
                <div class="row mb-3">
                    <div class="col-12">
                    <h2>Produtos por pagar:</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"><?= Html::img('@web/img/icons/color/drink.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-2"><?= Html::img('@web/img/icons/color/sorting.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-3"><?= Html::img('@web/img/icons/color/pricing.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
                    <div class="col-1"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="row mb-3">
                    <div class="col-12">
                    <h2>Produtos a pagar:</h2>
                    </div>
                </div>
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
                <div class="list-group">
                    <?php
                    if (empty($productstobepaid)) {
                        echo '<h4>Não há produtos prontos para pagamento!</h4>';
                    }else{
                    foreach ($productstobepaid as $product) {
                    ?>
                        <span class="list-group-item list-group-item-action list-group-item-secondary" id="product_<?= $product["product_id"] ?>">
                            <div class="row">
                                <div class="col-5 h3">
                                    <span class="h3 mt-2" id="idMesa"><?= $product["name"] ?></span>
                                </div>
                                <div class="col-2 h3">
                                    <span id="accountProductQuantity_<?= $product["product_id"] ?>" class="mt-2 mr-2 ml-2"><?= $product["quantity"] ?></span>
                                </div>
                                <div class="col-4 h3">
                                    <span id="accountProductQuantity" class="mt-2 mr-2 ml-2"><?= $product["price"] * $product["quantity"] ?> €</span>
                                </div>
                                <div class="col-1 text-center">
                                    <?= Html::a('<i class="fa fa-2x fa-arrow-right mr-5"></i>', Url::to(['account/ltr?id='.$account->id]), ['data-method' => 'POST',
                                        'data-params' => [
                                            'productId' => $product["product_id"],
                                        ]]) ?>
                                </div>
                            </div>
                        </span>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-6">
                <div class="list-group text-right">
                <?php
                    $total = 0;

                    if (empty($productstopay)) {
                        echo '<h4>Adicione produtos transferindo da lista do lado esquerdo!</h4>';
                    }else{
                    foreach ($productstopay as $product) {
                        $total += $product["price"] * $product["quantity"];
                ?>
                    <span class="list-group-item list-group-item-action list-group-item-secondary">
                        <div class="row">
                            <div class="col-1 text-center">
                            <?= Html::a('<i class="fa fa-2x fa-arrow-left mr-5"></i>', Url::to(['account/rtl?id='.$account->id]), ['data-method' => 'POST',
                                        'data-params' => [
                                            'productId' => $product["product_id"],
                                        ]]) ?>
                            </div>
                            <div class="col-6 h3">
                                <span class="h3 mt-2" id="idMesa"><?= $product["name"] ?></span>
                            </div>
                            <div class="col-2 h3">
                                <span class="mt-2"><?= $product["quantity"] ?></span>
                            </div>
                            <div class="col-3 h3">
                                <span class="mt-2"><?= $product["price"] * $product["quantity"] ?> €</span>
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
        <div class="row mt-4">
            <div class="col-6">

            </div>
            <div class="col-6 text-right">
                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                    <?= Html::img('@web/img/icons/color/receipt.png', ['class' => 'align-top', 'style' => 'width: 65px']) ?>
                </button>
                <span class="h4 text-dark">Total: <span class="h2"><?= $total ?>€</span></span>

            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter" aria-labelledby="exampleModalCenterTitle" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body border-bottom text-center">
                    <h4 class="">Pagamento</h4>
                </div>
                <?php $form = ActiveForm::begin([
                    'id' => 'payment-form',
                    'action' => 'paysplitaccount?id='.$account->id
                ]) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mb-3">Pretende inserir número de contribuinte?</label>
                        <?= $form->field($account, 'nif')->textInput(['type' => 'number']) ?>
                        <small class="form-text text-muted mt-3">Não é obrigatório!</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" class="close" data-dismiss="modal" aria-label="Close">Cancelar</button>
                    <?= Html::submitButton('Pagar', ['class' => 'btn btn-primary', 'name' => 'teste']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>