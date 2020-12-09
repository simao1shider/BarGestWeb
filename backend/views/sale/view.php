<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $account common\models\Account */

$this->title = $account->name;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bill-view container-fluid ml-5">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $account->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $account->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $account,
        'attributes' => [
            'id',
            'name',
            'dateTime',
            'status',
            'total',
            'Tables_id',
            'Employees_id',
            'Cashiers_id',
        ],
    ]) ?>

    <?php
    foreach ($products as $product){
        ?>
        <ul>
            <li><?=$product->product->name?></li>
            <li><?=$product->quantity?></li>
            <li><?=$product->product->price?></li>
        </ul>
    <?php
    }
    ?>

</div>
