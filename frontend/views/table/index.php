<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Mesas';

?>

<h1><?= Html::img('@web/img/tableColor.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>


<p>
    <?= Html::a('<i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-success float-right']) ?>
</p>

<div class="mt-5 container">
    <div class="list-group">
        <?php
        foreach ($model as $item){
            if(!$item->status){
                ?>
                <a href="<?= Url::to(['view', 'id' => $item->id]) ?>" class="list-group-item list-group-item-action list-group-item-success">
                    <?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?>
                    <span class="h3 ml-3 mt-2 ">Mesa <?=$item->number?></span>

                </a>
                <?php
            }
            else{
                ?>
                <a href="<?= Url::to(['view', 'id' => $item->id]) ?>" class="list-group-item list-group-item-action list-group-item-warning">
                    <?= Html::img('@web/img/tableBlack.png', ['class' => 'align-top', 'style' => 'width: 35px']) ?>
                    <span class="h3 ml-3 mt-2">Mesa <?=$item->number?></span>
                    <?php
                    $total=0;
                    foreach ($item->bills as $bill){
                        $total+=$bill->total;
                    }
                    ?>
                    <span class="h3 mr-3 mt-2 float-right"><?=$total?>€</span>
                </a>
                <?php

            }
            ?>
        <?php
        }
        ?>


    </div>
</div>