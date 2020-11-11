<?php

use yii\helpers\Html;
use \yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Table */

$this->title = 'Criar Mesa';

?>
<h1><?= Html::encode($this->title) ?></h1>
<?php
$this->params['breadcrumbs'][] = ['label' => 'Mesas', 'url' => ['index']];
$this->params["breadcrumbs"][] = $this->title
?>
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