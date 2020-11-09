<?php

use yii\helpers\Html;

$this->title = 'Mesas';
?>
<!--<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-outline btn-info">
            <i class="fa fa-align-left"></i>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>-->
<h1><?= Html::img('@web/img/tableColor.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

<p>
    <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success float-right']) ?>
</p>

<div class="mt-5 container">
    <div class="list-group">
        <a href="/index.php?r=table%2Fview&id=1" class="list-group-item list-group-item-action list-group-item-success"><?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2" id="idMesa">Mesa 1</span></a>
        <a href="/index.php?r=table%2Fview&id=2" class="list-group-item list-group-item-action list-group-item-warning"><?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?><span class="h3 ml-3 mt-2" id="idMesa">Mesa 2</span></a>
    </div>
</div>