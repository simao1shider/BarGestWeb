<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $account app\models\Bill */

$this->title = $account->name;
?>
<div class="bill-view container-fluid ml-5">

    <h3>
        <?= Html::img('@web/img/Icons/Color/account.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?>
        <span class="mt-4 h4"><span class="text-secondary h3">Nome da conta:</span> <?= Html::encode($this->title) ?></span>
    </h3>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="../table/index">Mesas</a></li>
            <li class="breadcrumb-item"><a href="../table/view?id=<?= $account->table->id ?>">Mesa <?= $account->table->number ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <p class="text-right">
        <?= Html::a('Apagar Conta', ['delete', 'id' => $account->id], [
            'class' => 'btn btn-outline-danger',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar esta conta?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="mt-5 container">
        <div class="row mb-3 ml-1">
            <div class="col-4"><?= Html::img('@web/img/Icons/Color/drink.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-3"><?= Html::img('@web/img/Icons/Color/sorting.png', ['class' => 'align-top ml-4', 'style' => 'width: 45px']) ?></div>
            <div class="col-4"><?= Html::img('@web/img/Icons/Color/pricing.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-1"></div>
        </div>
        <div class="list-group scrollbar-gradient" id="listProductsAccount">
            <?php
            if (empty($products)) {
                echo '<h3>Não há produtos prontos para pagamento!</h3>';
            }
            $total = 0;
            foreach ($products as $product) {
                $total += $product["price"] * $product["quantity"];
            ?>
                <span class="list-group-item list-group-item-action list-group-item-secondary" id="product_<?= $product["product_id"] ?>">
                    <div class="row">
                        <div class="col-4 h3">
                            <span class="h3 mt-2" id="idMesa"><?= $product["name"] ?></span>
                        </div>
                        <div class="col-3 h3">
                            <a onclick="accountAddQuantity(<?= $account->id ?>,<?= $product['product_id'] ?>)"><?= Html::img('@web/img/Icons/Color/plus.png', ['class' => 'align-top mt-1', 'style' => 'width: 40px']) ?></a>
                            <span id="accountProductQuantity_<?= $product["product_id"] ?>" class="mt-2 mr-2 ml-2"><?= $product["quantity"] ?></span>
                            <a onclick="accountRemoveQuantity(<?= $account->id ?>,<?= $product['product_id'] ?>)"><?= Html::img('@web/img/Icons/Color/minus.png', ['class' => 'align-top mt-1', 'style' => 'width: 40px']) ?></a>
                        </div>
                        <div class="col-4 h3">
                            <span id="accountProductPrice_<?= $product["product_id"] ?>" class="mt-2 mr-2 ml-2"><?= $product["price"] * $product["quantity"] ?> €</span>
                        </div>
                        <div class="col-1 text-center">
                            <a href="<?= \yii\helpers\Url::to(["account/delete_product", "request_id" => $product["request_id"], "product_id" => $product["product_id"]]) ?>" class="mr-5"><?= Html::img('@web/img/Icons/Color/delete.png', ['class' => 'align-top mt-1', 'style' => 'width: 40px']) ?></a>
                        </div>
                    </div>
                </span>
            <?php
            }
            ?>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter" title="Pagar">
                    <?= Html::img('@web/img/Icons/Color/receipt.png', ['class' => 'align-top', 'style' => 'width: 65px']) ?>
                </button>
                <a href="split?id=<?= $account->id ?>" name="splitPayment" class="btn" role="button" title="Dividir Conta">
                    <?= Html::img('@web/img/Icons/Color/split.png', ['class' => 'align-top', 'style' => 'width: 65px']) ?>
                </a>
            </div>
            <?php
            if (!empty($products)) {
            ?>
                <div class="col-6 text-right">
                    <p class="h4 text-dark mt-4">Total: <span class="h2"><span id="accountTotal"><?= $total ?> </span>€</span></p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" aria-labelledby="exampleModalCenterTitle" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body border-bottom text-center">
                    <h4 class="">Pagamento</h4>
                </div>
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
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

<?php
if (false) {
?>
    <div class="alert-message">
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> Erro!</h4>
            <hr>
            <p class="mb-0">Número de contribuinte inválido!</p>
        </div>
    </div>
<?php
}
?>