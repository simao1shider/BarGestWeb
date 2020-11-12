<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Table */

$this->title = $model->number;
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
            <?php

            foreach ($model->bills as $bill){
                ?>
                <a href="<?=\yii\helpers\Url::to('../bill/view')?>" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2" id="idMesa">Conta <?=$bill->id?></span></a>

                <?php
            }
            ?>

        </div>
    </div>

</div>
