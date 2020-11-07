<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Table */

$this->title = 'Criar Mesa';
?>
<h1><?= Html::encode($this->title) ?></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="/index.php?r=table%2Findex">Mesas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Criar Mesa</li>
    </ol>
</nav>

<div class="table-create container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-6">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>