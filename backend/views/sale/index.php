<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $accounts common\models\Account */


$this->title = 'Vendas';
?>
<div class="bill-index container-fluid ml-5">

<h1><?= Html::img('@web/img/Icons/Color/getMoney.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="mt-5 container">
        <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(); 
                if(isset($date)){
            ?>
                    <input type="date" value="<?= $date ?>" onchange="$(this).closest('form').trigger('submit');" class="form-control" name="date">
            <?php
                }
                else
                {
            ?>
                    <input type="date" onchange="$(this).closest('form').trigger('submit');" class="form-control" name="date">
            <?php  
                }
                ActiveForm::end(); 
            ?>
        </div>
        </div>
        
        <div class="row mb-3 ml-1">
            <div class="col-6"><?= Html::img('@web/img/Icons/Color/clock.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-4"><?= Html::img('@web/img/Icons/Color/pricing.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-1"></div>
        </div>
        <div class="list-group scrollbar-gradient">
            <?php
            if(empty($accounts)){
                echo "<h3>Não existem faturas</h3>";
            }
            foreach ($accounts as $account){
                ?>
                <span class="list-group-item list-group-item-action list-group-item-secondary">
                <div class="row">
                    <div class="col-6 h3">
                        <span class="h3 mt-2"><?=$account->dateTime?></span>
                    </div>
                    <div class="col-4 h3">
                        <span class="mt-2"><?=$account->total?>€</span>
                    </div>
                    <div class="col-2 h3">
                        <a href="<?=Url::to(["view","id"=>$account->id])?>" class="btn btn-outline-dark"><i class="fa fa-2x fa-eye"></i></a>
                    </div>
                </div>
            </span>
            <?php
            }
            ?>
        </div>
    </div>


</div>
