<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;
use common\widgets\Alert;
use \yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="wrapper" id="container">
        <?php 
            if(!Yii::$app->user->isGuest){
        ?>
        <nav id="sidebar" class="active" id="sidebar">
            <div class="sidebar-header">
                <!--<h3>BarGest</h3>-->
                <strong class="">BG</strong> <?php // Html::img('@web/img/Logo/white.png', ['class' => 'mr-5', 'style' => 'width: 55px;']) ?>
            </div>

            <ul class="components" style="height: 100%">
                <li class="active">
                    <a href="<?=Url::to(["site/index"])?>" title="Home">
                        <?= Html::img('@web/img/Icons/Blue/home.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(["employee/index"])?>" title="Funcionários">
                        <?= Html::img('@web/img/Icons/Blue/people.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(["cashier/index"])?>" title="Caixas">
                        <?= Html::img('@web/img/Icons/Blue/register.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(["category/index"])?>" title="Categorias">
                        <?= Html::img('@web/img/Icons/Blue/tags.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(["product/index"])?>" title="Produtos">
                        <?= Html::img('@web/img/Icons/Blue/beer.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(["sale/index"])?>" title="Vendas">
                        <?= Html::img('@web/img/Icons/Blue/rent.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to(["iva/index"])?>" title="Ivas">
                        <?= Html::img('@web/img/Icons/Blue/rate.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li style="position: absolute;bottom: 10px; width: 100%">
                    <?= Html::a("<i class='fa fa-power-off fa-5x' style='color: red' ></i>",Url::to(["site/logout"]))?>
                </li>
            </ul>
        </nav>
        <?php 
           }
        ?>
        <div id="content" class="mt-5 ml-5">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>