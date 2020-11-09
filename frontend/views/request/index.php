<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
?>
<div class="request-index">

    <h1><?= Html::img('@web/img/listColor.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <p>
        <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success float-right']) ?>
    </p>

    <div class="mt-5 container">
        <div class="row mb-3 ml-1">
            <div class="col-1 text-center"><?= Html::img('@web/img/tableColor.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-2 text-center"><?= Html::img('@web/img/clockColor.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-6"><?= Html::img('@web/img/waiterColor.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-2 text-center"></div>
        </div>
        <div class="list-group">
            <span class="list-group-item list-group-item-action list-group-item-success">
                <div class="row">
                    <div class="col-1 h3 text-center">10</div>
                    <div class="col-2 h3 text-center">23:17</div>
                    <div class="col-6">
                        <h3>Simão marques</h3>
                        <div class="row ml-3">
                            <div class="col-4 h4 ml-4">Gordon's</div>
                            <div class="col-2 h4">5.00€</div>
                            <div class="col-1"></div>
                            <div class="col-2 h4">4</div>
                        </div>
                        <div class="row ml-3">
                            <div class="col-4 h4 ml-4">Tanqueray's</div>
                            <div class="col-2 h4">7.00€</div>
                            <div class="col-1"></div>
                            <div class="col-2 h4">5</div>
                        </div>
                        <div class="row ml-3">
                            <div class="col-4 h4 ml-4">Monkey 47</div>
                            <div class="col-2 h4">12.00€</div>
                            <div class="col-1"></div>
                            <div class="col-2 h4">2</div>
                        </div>
                        <div class="row ml-3">
                            <div class="col-4 h4 ml-4">Hendrick's</div>
                            <div class="col-2 h4">8.00€</div>
                            <div class="col-1"></div>
                            <div class="col-2 h4">1</div>
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-3x fa-check"></i></a>
                        <a href="#"><i class="fa fa-3x fa-eye"></i></a>
                    </div>
                </div>
            </span>
            <span class="list-group-item list-group-item-action list-group-item-danger">
                <div class="row">
                    <div class="col-1 h3 text-center">13</div>
                    <div class="col-2 h3 text-center">23:23</div>
                    <div class="col-6">
                        <h3>Simão marques</h3>
                        <div class="row ml-3">
                            <div class="col-4 h4 ml-4">Gordon's</div>
                            <div class="col-2 h4">5.00€</div>
                            <div class="col-1"></div>
                            <div class="col-2 h4">4</div>
                        </div>
                        <div class="row ml-3">
                            <div class="col-4 h4 ml-4">Tanqueray's</div>
                            <div class="col-2 h4">7.00€</div>
                            <div class="col-1"></div>
                            <div class="col-2 h4">5</div>
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-3x fa-lock"></i></a>
                        <a href="#"><i class="fa fa-3x fa-eye"></i></a>
                    </div>
                </div>
            </span>
            <span class="list-group-item list-group-item-action list-group-item-danger">
                <div class="row">
                    <div class="col-1 h3 text-center">23</div>
                    <div class="col-2 h3 text-center">23:23</div>
                    <div class="col-6">
                        <h3>Yaroslav Antonenko</h3>
                        <div class="row ml-3">
                            <div class="col-4 h4 ml-4">Monkey 47</div>
                            <div class="col-2 h4">12.00€</div>
                            <div class="col-1"></div>
                            <div class="col-2 h4">2</div>
                        </div>
                        <div class="row ml-3">
                            <div class="col-4 h4 ml-4">Hendrick's</div>
                            <div class="col-2 h4">8.00€</div>
                            <div class="col-1"></div>
                            <div class="col-2 h4">1</div>
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-3x fa-lock"></i></a>
                        <a href="#"><i class="fa fa-3x fa-eye"></i></a>
                    </div>
                </div>
            </span>
        </div>
    </div>
</div>