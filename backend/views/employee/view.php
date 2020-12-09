<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $employee app\models\Employee */

$this->title = $employee->name;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

    <h1><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Funcionários</a></li>
            <li class="breadcrumb-item" aria-current="page">Detalhes</li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <p>
        <?= Html::a('Delete', ['delete', 'id' => $employee->id], [
            'class' => 'btn btn-danger float-right mb-3',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h4><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top mr-2', 'style' => 'width: 40px']) ?><span class="mt-2"><?= $employee->name ?></span></h4>
                    <p class="text-dark m-0">Email: <span class="card-text text-secondary"><?= $employee->email ?></span></p>
                    <p class="text-dark m-0">Telemóvel: <span class="card-text text-secondary"><?= $employee->phone ?></span></p>
                    <p class="text-dark m-0">Data de nascimento: <span class="card-text text-secondary"><?= $employee->birthDate ?></span></p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    dados relacionados

</div>