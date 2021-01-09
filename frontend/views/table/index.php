<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Mesas';

?>
<div class="container-fluid ml-5">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::img('@web/img/Icons/Color/table.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
        </div>
        <div class="col-md-6 text-right">
            <?php
            if (!isset($_GET['CR'])) {
            ?>
                <p>
                    <?= Html::a('Criar Mesa <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-outline-success mt-3']) ?>
                </p>
            <?php
            }
            ?>
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="mt-5 container">
        <div class="list-group">
            <?php
            if (empty($model)) {
            ?>
                <h3 class="text-center">Não existem mesas</h3>
                <?php
            }
            foreach ($model as $item) {
                if (!$item->status) {
                ?>
                    <a href="<?= (isset($_GET['CR']) ? Url::to(['view', 'CR' => 1, 'id' => $item->id]) :  Url::to(['view', 'id' => $item->id])) ?>" class="list-group-item list-group-item-action list-group-item-success">
                        <?= Html::img('@web/img/Icons/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?>
                        <span class="h3 ml-3 mt-2 ">Mesa <?= $item->number ?></span>

                    </a>
                <?php
                } else {
                ?>
                    <a href="<?= (isset($_GET['CR']) ? Url::to(['view', 'CR' => 1, 'id' => $item->id]) :  Url::to(['view', 'id' => $item->id])) ?>" class="list-group-item list-group-item-action list-group-item-warning">
                        <?= Html::img('@web/img/Icons/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?>
                        <span class="h3 ml-3 mt-2">Mesa <?= $item->number ?></span>
                        <?php

                        ?>
                        <span class="h3 mr-3 mt-2 float-right"><?= $item->getTotal($item->id) ?>€</span>
                    </a>
            <?php

                }
            }
            ?>
        </div>
    </div>
</div>