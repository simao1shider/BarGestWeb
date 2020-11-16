<?php

use yii\helpers\Html;

if (empty($products)) {
?>
    <h3 class="text-center">Não tem produtos adicionados</h3>
<?php
}

foreach ($products as $product) {
?>
    <span class="list-group-item list-group-item-action list-group-item-secondary">
        <div class="row">
            <div class="col-6 h3">
                <span class="h3 mt-2" id="idMesa"><?= $product["name"] ?></span>
            </div>
            <div class="col-2 h3">
                <span class="mt-2"><?= $product["quantity"] ?></span>
            </div>
            <div class="col-2 h3">
                <span class="mt-2"><?= $product["price"] ?></span>
            </div>
            <div class="col-2 h3 mt-1">
                <a href="#" onclick="addQuantity(<?= $product["id"] ?>)" class=""><?= Html::img('@web/img/Icons/Color/plus.png', ['class' => 'align-top', 'style' => 'width: 40px']) ?></a>
                <a href="#" onclick="removeQuantity(<?= $product["id"] ?>)" class=""><?= Html::img('@web/img/Icons/Color/minus.png', ['class' => 'align-top', 'style' => 'width: 40px']) ?></a>
            </div>
        </div>
    </span>
<?php
}
?>
<script>


</script>