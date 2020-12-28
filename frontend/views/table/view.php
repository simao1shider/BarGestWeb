<?php

use yii\helpers\Html;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Table */

$this->title = "Contas";
?>
<div class="table-view container-fluid ml-5">

    <h1><?= Html::img('@web/img/Icons/Color/table.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2"><span class="mt-2"><?= Html::encode($model->number) ?></span></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Mesas</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($model->number) ?></li>
        </ol>
    </nav>
    <div class="btn-group btn-group-toggle float-right">
        <a href="<?= Url::to(['request/create', 'tableId' => $model->id]) ?>" class="btn btn-outline-success btn-lg">Criar Conta</a>
        <?php
        if (!isset($_GET['CR'])) {
        ?>
            <?= Html::a('Apagar Mesa', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-outline-danger btn-lg',
                'data' => [
                    'confirm' => 'Tem a certeza que pretende apagar?',
                    'method' => 'post',
                ],
            ]) ?> <?php
        }
        ?> 
    </div>

    <div class="mt-5 container">
        <div class="list-group">

            <?php
            if (empty($model->accounts)) {
            ?>
                <h3 class="text-center">Não exitem contas</h3>
                <?php
            }
            foreach ($model->accounts as $account) {
                if($account->status == 0){
                    if (isset($_GET['CR'])) {
                    ?>
                        <a href="<?= Url::to(['request/create', 'CR' => 1, 'account' => $account->id]) ?>" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/Icons/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2"><?= $account->name ?></span></a>
                    <?php
                    } else {
                    ?>

                        <a href="<?= Url::to(['account/view', 'id' => $account->id]) ?>" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/Icons/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2"><?= $account->name ?></span></a>
            <?php
                    }
                }
            }
            ?>

        </div>
    </div>
</div>