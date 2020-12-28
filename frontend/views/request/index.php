<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = 'Pedidos';
?>
<div class="request-index container-fluid ml-5">

    <h1><?= Html::img('@web/img/Icons/Color/list.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <h5>
        <span class="badge badge-success">Pedido Pronto</span>
        <span class="badge badge-warning">Pedido em Execução</span>
        <span class="badge badge-danger">Pedido em Espera</span>
    </h5>
    <p>
        <?= Html::a('Criar Pedido <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-outline-success float-right','name'=>"CreateRequest"]) ?>
    </p>

    <div class="mt-5 container">
        <div class="row mb-3 ml-1">
            <div class="col-1 text-center"><?= Html::img('@web/img/Icons/Color/table.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-2 text-center"><?= Html::img('@web/img/Icons/Color/clock.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-7"><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top', 'style' => 'width: 45px']) ?></div>
            <div class="col-2 text-center"></div>
        </div>
        <div class="list-group">
            <?php
            if(empty($model)){
                echo '<h3 class="text-center">Não tem pedidos neste momento</h3>';
            }
            foreach ($model as $request){
                switch ($request->status){
                    case 2:
                        ?>
                        <span class="list-group-item list-group-item-action list-group-item-success">
                                <div class="row">
                                    <?=$this->render("components\ListRequests",['request'=>$request])?>
                                    <div class="col-2 text-right">
                                        <a href="<?= Url::to(["request/update",'id'=>$request->id])?>"><i class="fa fa-3x fa-eye" title="Ver detalhes"></i></a>
                                    </div>
                                </div>
                            </span>
                        <?php
                        break;
                    case 1:
                        ?>
                        <span class="list-group-item list-group-item-action list-group-item-warning">
                                 <div class="row">
                                    <?=$this->render("components\ListRequests",['request'=>$request])?>
                                     <div class="col-2 text-right">
                                         <a href="<?=Url::to(["request/change_status","prepare"=>$request->id])?>" class="mr-5"><i class="fa fa-3x fa-check" title="Mudar estado para concluido"></i></a>
                                         <a href="<?= Url::to(["request/update",'id'=>$request->id])?>"><i class="fa fa-3x fa-eye" title="Ver detalhes"></i></a>
                                     </div>
                                </div>
                            </span>
                        <?php
                        break;
                    case 0:
                        ?>
                        <span class="list-group-item list-group-item-action list-group-item-danger">
                                <div class="row">
                                     <?=$this->render("components\ListRequests",['request'=>$request])?>
                                     <div class="col-2 text-right">
                                         <a href="<?=Url::to(["request/change_status","block"=>$request->id])?>" class="mr-5"><i class="fa fa-3x fa-lock" title="Bloquear pedido"></i></a>
                                         <a href="<?= Url::to(["request/update",'id'=>$request->id])?>"><i class="fa fa-3x fa-eye" title="Ver detalhes"></i></a>
                                     </div>
                                </div>
                            </span>
                        <?php
                        break;
                }
                ?>
                <?php
            }
            ?>
        </div>
    </div>
</div>