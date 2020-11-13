<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Create Request';
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="request-create">

    <h1><?= Html::encode($this->title) ?></h1>

<?php
    $form = ActiveForm::begin([
    'id' => 'Request-form',
    'options' => ['class' => 'form-horizontal'],
    ]) ?>
    <?= $form->field($model, 'tableNumber')->dropdownlist(ArrayHelper::map($tables,'id','number'),
        ['prompt'=>'Select...']) ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Criar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>

</div>
