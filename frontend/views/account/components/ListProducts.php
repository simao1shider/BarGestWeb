<?php
foreach ($request->productsToBePas->groupBy(["product_id"]) as $productList) {
?>
    <span class="list-group-item list-group-item-action list-group-item-secondary" id="product_">
        <div class="row">
            <div class="col-4 h3">
                <span class="h3 mt-2" id="idMesa"><?= $productList->product->name ?></span>
            </div>
            <div class="col-3 h3">
                <a href="#" onclick="accountAddQuantity(<?= $request->id ?>,<?= $productList->product->id ?>)"><?= Html::img('@web/img/Icons/Color/plus.png', ['class' => 'align-top mt-1', 'style' => 'width: 40px']) ?></a>
                <span id="accountProductQuantity" class="mt-2 mr-2 ml-2"><?= $productList->quantity ?></span>
                <a href="#" onclick="accountRemoveQuantity(<?= $request->id ?>,<?= $productList->product->id ?>)"><?= Html::img('@web/img/Icons/Color/minus.png', ['class' => 'align-top mt-1', 'style' => 'width: 40px']) ?></a>
            </div>
            <div class="col-4 h3">
                <span class="mt-2"><?= $productList->product->price ?></span>
            </div>
            <div class="col-1 text-center">
                <a href="#" class="mr-5" data-toggle="modal" data-target="#editProduct"><i class="fa fa-2x fa-trash"></i></a>
            </div>
        </div>
    </span>
<?php
}
