<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $employee common\models\Employee */

$this->title = 'Update Employee: ' . $employee->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $employee->name, 'url' => ['view', 'id' => $employee->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="employee-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($employee, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($employee, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($employee, 'phone')->textInput() ?>

        <?= $form->field($employee, 'birthDate')->textInput() ?>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
