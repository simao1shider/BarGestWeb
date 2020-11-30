<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $employee common\models\Employee */
/* @var $signup frontend\models\SignupForm */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="employee-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($employee, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($employee, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($employee, 'phone')->textInput() ?>

        <div class="form-group field-employee-birthdate">
            <label for="employee-birthdate">Birth Date</label>
            <input type="date" id="employee-birthdate" class="form-control" name="Employee[birthDate]">

            <div class="invalid-feedback"></div>
        </div>

        <?= $form->field($signup, 'username')->textInput() ?>

        <?= $form->field($signup, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
