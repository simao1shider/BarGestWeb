<?php
if (empty($request->productsToBePas)) {
    echo '<h3>Não há produtos prontos para pagamento!</h3>';
}
foreach ($request->productsToBePas->groupBy(["product_id"]) as $productList) {
?>
    <span class="list-group-item list-group-item-action list-group-item-secondary" id="product_<?= $product["product_id"] ?>">
        <div class="row">
            <div class="col-5 h3">
                <span class="h3 mt-2" id="idMesa"><?= $product["name"] ?></span>
            </div>
            <div class="col-2 h3">
                <span id="productQuantity_<?= $product["product_id"] ?>" class="mt-2 mr-2 ml-2"><?= $product["quantity"] ?></span>
            </div>
            <div class="col-4 h3">
                <span id="productPrice" class="mt-2 mr-2 ml-2"><?= $product["price"] ?> €</span>
            </div>
            <div class="col-1 text-center">
                <a href="#" class="mr-5"><i class="fa fa-2x fa-arrow-right"></i></a>
            </div>
        </div>
    </span>
<?php
}
