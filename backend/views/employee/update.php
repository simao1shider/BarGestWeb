<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $employee common\models\Employee */

$this->title = $employee->name;
?>
<div class="employee-update container-fluid ml-5">

    <h1><?= Html::img('@web/img/Icons/Color/waiter.png', ['class' => 'align-top', 'style' => 'width: 66px']) ?><span class="h3 ml-3 mt-2" id="idMesa"><span class="mt-2"><?= Html::encode($this->title) ?></span></h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../site/index">Home</a></li>
            <li class="breadcrumb-item"><a href="index">Funcionários</a></li>
            <li class="breadcrumb-item" aria-current="page">Editar</li>
            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
        </ol>
    </nav>

    <div class="employee-form">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($employee, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($employee, 'email')->input('email') ?>

                <?= $form->field($employee, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '999999999',
                ]) ?>

                <?= $form->field($employee, 'birthDate')->widget(\yii\widgets\MaskedInput::className(), [
                    'mask' => '9999-99-99',
                ]) ?>

                <?= $form->field($signup, 'role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'),['prompt'=>'Selecione o tipo de utilizador']);?>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success float-right']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
