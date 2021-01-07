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

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Dados Pessoais</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Nova Password</a></div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="employee-form mt-4">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($employee, 'name')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($employee, 'email')->input('email') ?>

                        <?= $form->field($employee, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => '999999999',
                        ]) ?>

                        <div class="form-group field-employee-birthdate">
                            <label for="employee-birthdate">Data de Nascimento</label>
                            <input type="date" id="employee-birthdate" class="form-control" name="Employee[birthDate]">

                            <div class="invalid-feedback"></div>
                        </div>

                        <?= $form->field($signup, 'role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name'),['prompt'=>'Selecione o tipo de utilizador']);?>

                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success float-right']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade pt-4" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <?php $form = ActiveForm::begin([
                            "action"=>\yii\helpers\Url::to(["resetpassword"]),
                    ]); ?>
                    <div class="form-group field-signupform-id">
                        <input type="hidden" id="signupform-id" class="form-control" name="SignupForm[id]" value="<?=$employee->id?>">
                        <div class="invalid-feedback"></div>
                    </div>
                    <?= $form->field($signup, 'password')->passwordInput() ?>
                    <?= $form->field($signup, 'password_repeat')->passwordInput() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success float-right']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
    </div>


</div>
