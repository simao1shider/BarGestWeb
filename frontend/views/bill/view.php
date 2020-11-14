<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Account */

$this->title = "Contas";
?>
<div class="bill-view">

    <h1><?= Html::img('@web/img/billColor.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <p class="text-right">
        <?= Html::a('Apagar', ['delete', 'id' => $model->id], [
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
        <div class="list-group">
            <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-4 h3">
                        <span class="h3 mt-2" id="idMesa">Gordons</span>
                    </div>
                    <div class="col-3 h3">
                        <span class="mt-2">3</span>
                    </div>
                    <div class="col-4 h3">
                        <span class="mt-2">5.99€</span>
                    </div>
                    <div class="col-1 text-center">
                        <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-2x fa-pencil"></i></a>
                    </div>
                </div>
            </span>
            <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-4 h3">
                        <span class="h3 mt-2" id="idMesa">Frize de Limão</span>
                    </div>
                    <div class="col-3 h3">
                        <span class="mt-2">1</span>
                    </div>
                    <div class="col-4 h3">
                        <span class="mt-2">1.20€</span>
                    </div>
                    <div class="col-1 text-center">
                        <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-2x fa-pencil"></i></a>
                    </div>
                </div>
            </span>
            <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-4 h3">
                        <span class="h3 mt-2" id="idMesa">Frize de Frutos Vermelhos</span>
                    </div>
                    <div class="col-3 h3">
                        <span class="mt-2">2</span>
                    </div>
                    <div class="col-4 h3">
                        <span class="mt-2">2.40€</span>
                    </div>
                    <div class="col-1 text-center">
                        <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-2x fa-pencil"></i></a>
                    </div>
                </div>
            </span>
        </div>
        <div class="row mt-4">
            <div class="col-6">
                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                    <?= Html::img('@web/img/receiptColor.png', ['class' => 'align-top', 'style' => 'width: 65px']) ?>
                </button>
                <a name="" id="" class="btn" href="/index.php?r=bill%2Fsplit&id=2" role="button">
                    <?= Html::img('@web/img/splitColor.png', ['class' => 'align-top', 'style' => 'width: 65px']) ?>
                </a>
            </div>
            <div class="col-6 text-right">
                <p class="h4 text-dark mt-4">Total: <span class="h2">9.59€</span></p>
            </div>
        </div>
    </div>
    <!--<div class="modal fade show" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog" style="padding-right: 17px; display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">Pretende inserir número de contribuinte?</label>
                      <input type="number" class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">Não é obrigatório!</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Pagar</button>
                </div>
            </div>
        </div>
    </div>-->
</div>