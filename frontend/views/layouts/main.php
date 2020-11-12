<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
    <div class="wrapper">
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <!--<h3>BarGest</h3>-->
                <strong class="">BG</strong> <?php // Html::img('@web/img/Logo/white.png', ['class' => 'mr-5', 'style' => 'width: 55px;']) ?>
            </div>

            <ul class="components">
                <li class="active">
                    <a href="<?=Url::to('../site/index')?>">
                        <?= Html::img('@web/img/home.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to('../table/index')?>">
                        <?= Html::img('@web/img/tableBlue.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
                <li>
                    <a href="<?=Url::to('../request/index')?>">
                        <?= Html::img('@web/img/list.png', ['class' => '', 'style' => 'width: 35px']) ?>
                    </a>
                </li>
            </ul>
        </nav>
        <div id="content" class="mt-5 ml-5">
            <?= Breadcrumbs::widget([
                'itemTemplate' => "\n\t<li class=\"breadcrumb-item\"><i>{link}</i></li>\n",
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