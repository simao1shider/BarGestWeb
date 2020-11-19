<?php

use yii\helpers\Html;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Table */

$this->title = $model->number;
?>
<div class="table-view">

    <h1>Mesa <?= Html::encode($this->title) ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=Url::to("index")?>">Mesas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contas</li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <?php
    if(!isset($_GET['CR'])){
        ?>
        <p>
            <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-lg float-right',
                'data' => [
                    'confirm' => 'Tem a certeza que pretende apagar?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

    <?php
    }
    ?>


    <div class="mt-5 container">
        <div class="list-group">
            <a href="<?=Url::to(['request/create','tableId'=>$model->id])?>" class="list-group-item list-group-item-action list-group-item-success text-center mb-3"><?= Html::img('@web/img/Icons/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2">Criar Conta</span></a>
            <?php
            if(empty($model->accounts)){
                ?>
                <h3 class="text-center">Não exitem contas</h3>
                    <?php
            }
            foreach ($model->accounts as $account){
                if(isset($_GET['CR'])){
                ?>
                    <a href="<?=Url::to(['request/create','CR'=>1,'account'=>$account->id])?>" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/Icons/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2">Conta <?=$account->id?></span></a>
                    <?php
                }
                else{
                ?>

                <a href="<?=Url::to(['account/view','id'=>$account->id])?>" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/Icons/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2">Conta <?=$account->id?></span></a>
                <?php
                }
            }
            ?>

        </div>
    </div>
</div>
