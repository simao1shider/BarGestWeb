<?php

use yii\helpers\Html;
use yii\widgets\ListView;


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
            <?php
            foreach ($model as $request){
                switch ($request->status){
                    case 2:
                        ?>
                        <span class="list-group-item list-group-item-action list-group-item-success">
                                <div class="row">
                                     <div class="col-1 h3 text-center"><?=$request->accounts->tables->number?></div>
                                     <div class="col-2 h3 text-center"><?=date_create($request->dateTime)->format("H:i")?></div>
                                     <div class="col-6"
                                         <h3>Yaroslav Antonenko</h3>
                                         <?php
                                         foreach ($request->products as $product){
                                             ?>
                                             <div class="row ml-3">
                                                 <div class="col-4 h4 ml-4"><?=$product->name?></div>
                                                 <div class="col-2 h4"><?=$product->price?>€</div>
                                                 <div class="col-1"></div>
                                                 <div class="col-2 h4"><?=$getquantity=\common\models\ProductsToBePaid::find()->
                                                     where(['Requests_id'=>$request->id])->
                                                     andWhere(['Products_id'=>$product->id])->one()->quantity;
                                                     ?></div>
                                             </div>
                                             <?php
                                         }
                                         ?>
                                     </div>
                                    <div class="col-3 text-center">
                                        <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-3x fa-check"></i></a>
                                        <a href="<?=\yii\helpers\Url::to(["request/update",'id'=>$request->id])?>"><i class="fa fa-3x fa-eye"></i></a>
                                    </div>
                                </div>
                            </span>
                        <?php
                        break;
                    case 1:
                        ?>
                        <span class="list-group-item list-group-item-action list-group-item-warning">
                                 <div class="row">
                                     <div class="col-1 h3 text-center">23</div>
                                     <div class="col-2 h3 text-center">23:23</div>
                                     <div class="col-6">
                                         <h3>Yaroslav Antonenko</h3>
                                         <?php
                                         foreach ($request->products as $product){
                                             ?>
                                             <div class="row ml-3">
                                                 <div class="col-4 h4 ml-4"><?=$product->name?></div>
                                                 <div class="col-2 h4"><?=$product->price?>€</div>
                                                 <div class="col-1"></div>
                                                 <div class="col-2 h4"><?=$getquantity=\common\models\ProductsToBePaid::find()->
                                                     where(['Requests_id'=>$request->id])->
                                                     andWhere(['Products_id'=>$product->id])->one()->quantity;
                                                     ?></div>
                                             </div>
                                             <?php
                                         }
                                         ?>
                                     </div>
                                     <div class="col-3 text-center">
                                         <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-3x fa-lock"></i></a>
                                         <a href="<?=\yii\helpers\Url::to(["request/update",'id'=>$request->id])?>"><i class="fa fa-3x fa-eye"></i></a>
                                     </div>
                                </div>
                            </span>
                        <?php
                        break;
                    case 0:
                        ?>
                        <span class="list-group-item list-group-item-action list-group-item-danger">
                                <div class="row">
                                     <div class="col-1 h3 text-center">23</div>
                                     <div class="col-2 h3 text-center">23:23</div>
                                     <div class="col-6">
                                         <h3>Yaroslav Antonenko</h3>
                                         <?php
                                         foreach ($request->products as $product){
                                             ?>
                                             <div class="row ml-3">
                                                 <div class="col-4 h4 ml-4"><?=$product->name?></div>
                                                 <div class="col-2 h4"><?=$product->price?>€</div>
                                                 <div class="col-1"></div>
                                                 <div class="col-2 h4"><?=$getquantity=\common\models\ProductsToBePaid::find()->
                                                     where(['Requests_id'=>$request->id])->
                                                     andWhere(['Products_id'=>$product->id])->one()->quantity;
                                                     ?></div>
                                             </div>
                                             <?php
                                         }
                                         ?>
                                     </div>
                                     <div class="col-3 text-center">
                                         <a href="/index.php?r=table%2Fview&id=1" class="mr-5"><i class="fa fa-3x fa-lock"></i></a>
                                         <a href="<?=\yii\helpers\Url::to(["request/update",'id'=>$request->id])?>"><i class="fa fa-3x fa-eye"></i></a>
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