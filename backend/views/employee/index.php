<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Funcionários';
?>
<div class="employee-index">
    <h1><?= Html::img('@web/img/Icons/Blue/people.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <p class="text-right">
        <?= Html::a('Criar <i class="fa fa-plus ml-1"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <?php
        foreach ($employees as $employee){
            ?>
            
        <?
        }
        ?>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2">Simão Marques</span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary">simao@teste.pt</span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary">934234578</span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary">24-07-2000</span></p>
                    <p class="text-dark m-0">Salário: <span class="card-text text-secondary">800€</span></p>
                    <div class="btn-group float-right mt-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2">Simão Marques</span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary">simao@teste.pt</span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary">934234578</span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary">24-07-2000</span></p>
                    <p class="text-dark m-0">Salário: <span class="card-text text-secondary">800€</span></p>
                    <div class="btn-group float-right mt-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2">Simão Marques</span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary">simao@teste.pt</span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary">934234578</span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary">24-07-2000</span></p>
                    <p class="text-dark m-0">Salário: <span class="card-text text-secondary">800€</span></p>
                    <div class="btn-group float-right mt-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2">Simão Marques</span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary">simao@teste.pt</span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary">934234578</span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary">24-07-2000</span></p>
                    <p class="text-dark m-0">Salário: <span class="card-text text-secondary">800€</span></p>
                    <div class="btn-group float-right mt-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2">Simão Marques</span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary">simao@teste.pt</span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary">934234578</span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary">24-07-2000</span></p>
                    <p class="text-dark m-0">Salário: <span class="card-text text-secondary">800€</span></p>
                    <div class="btn-group float-right mt-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2">Simão Marques</span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary">simao@teste.pt</span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary">934234578</span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary">24-07-2000</span></p>
                    <p class="text-dark m-0">Salário: <span class="card-text text-secondary">800€</span></p>
                    <div class="btn-group float-right mt-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2">Simão Marques</span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary">simao@teste.pt</span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary">934234578</span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary">24-07-2000</span></p>
                    <p class="text-dark m-0">Salário: <span class="card-text text-secondary">800€</span></p>
                    <div class="btn-group float-right mt-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2">Simão Marques</span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary">simao@teste.pt</span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary">934234578</span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary">24-07-2000</span></p>
                    <p class="text-dark m-0">Salário: <span class="card-text text-secondary">800€</span></p>
                    <div class="btn-group float-right mt-1">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


</div>