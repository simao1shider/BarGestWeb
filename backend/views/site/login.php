<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$this->title = 'Autenticação';

$this->registerCssFile("/css/login.css");
?>


    <div class="text-center">
        <?= Html::img('@web/img/cocktail.png', ['class' => 'mb-4']) ?>
        <h1 class="h2 mb-3 font-weight-normal">BarGest<span style="color: #F50057;">Web</span></h1>
        <h1 class="h5 mb-3 font-weight-normal">Sistema de Autenticação</h1>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>