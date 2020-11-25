<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $product common\models\Product */
/* @var $ivas common\models\Iva */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if(isset($categories)){
        $this->render('_form', [
            'product' => $product,
            'ivas'=>$ivas,
            'categories'=>$categories,
        ]);
    }
    else{
        $this->render('_form', [
            'product' => $product,
            'ivas'=>$ivas,
        ]);
    }
     ?>

</div>
