<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $employee common\models\Employee */
/* @var $signup frontend\models\SignupForm */

$this->title = 'Criar Funcionário';
?>
<div class="employee-create container-fluid ml-5">

    <h1><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Funcionários</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="employee-form">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($employee, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($employee, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($employee, 'phone')->textInput() ?>

                <div class="form-group field-employee-birthdate">
                    <label for="employee-birthdate">Data de Nascimento</label>
                    <input type="date" id="employee-birthdate" class="form-control" name="Employee[birthDate]">

                    <div class="invalid-feedback"></div>
                </div>

                <?= $form->field($signup, 'username')->textInput() ?>

                <?= $form->field($signup, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Criar', ['class' => 'btn btn-success float-right']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
