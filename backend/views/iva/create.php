<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Iva */

$this->title = 'Criar Iva';
?>
<div class="iva-create container-fluid ml-5">

    <div class="row">
        <div class="col-4">
            <h1><?= Html::img('@web/img/Icons/Color/ratio.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="../iva/index">Ivas</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
