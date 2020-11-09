<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Table */

$this->title = $model->id;
?>
<div class="table-view">

    <h1>Mesa <?= Html::encode($this->title) ?></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="/index.php?r=table%2Findex">Mesas</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detalhes de Mesa</li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>
    <p>
        <?= Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-lg float-right',
            'data' => [
                'confirm' => 'Tem a certeza que pretende apagar?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="mt-5 container">
        <div class="list-group">
            <a href="/index.php?r=bill%2Fview&id=1" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2" id="idMesa">Conta 1</span></a>
            <a href="/index.php?r=bill%2Fview&id=2" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2" id="idMesa">Conta 2</span></a>
            <a href="/index.php?r=bill%2Fview&id=3" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2" id="idMesa">Conta 3</span></a>
            <a href="/index.php?r=bill%2Fview&id=4" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2" id="idMesa">Conta 4</span></a>
        </div>
    </div>

</div>
