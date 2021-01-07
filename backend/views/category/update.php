<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = $model->name;
?>
<div class="category-update container-fluid ml-5">
    <h1><?= Html::img('@web/img/Icons/Color/grid.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Categorias</a></li>
            <li class="breadcrumb-item" aria-current="page">Editar</li>
            <li class="breadcrumb-item active" aria-current="page"><?= $model->name ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>