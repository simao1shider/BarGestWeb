<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CashierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Erro';
?>
<div class="cashier-index container-fluid ml-5">

    <h1><?= Html::img('@web/img/Icons/Color/receipt.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Caixas</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <p class="text-right">
        <?= Html::a('Abrir Caixa <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="mt-5 container">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro!</h4>
            <p><?= $message ?></p>
            <hr>
            <p class="mb-0">Estes erros são apenas informativos!</p>
        </div>
    </div>
</div>