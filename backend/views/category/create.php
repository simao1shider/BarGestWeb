<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Criar Categoria';
?>
<div class="category-create">

    <h1><?= Html::img('@web/img/Icons/Color/grid.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Categorias</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Criar', ['class' => 'btn btn-success float-right']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
