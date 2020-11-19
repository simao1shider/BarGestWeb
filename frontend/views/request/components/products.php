<div class="w-100" style="text-align: start; cursor: pointer" onclick="backToCategories()" >
    <i class="fa fa-arrow-left fa-3x" aria-hidden="true"  ></i>
</div>

<?php
foreach ($category->products as $product) {
    ?>
    <div class="col-4 mt-3" onclick="addProduct(<?=$product->id?>)">
            <div class="card shadow-sm text-center pt-2 pb-2" style="cursor: pointer">
                <div class="card-body">
                    <h5 class="card-title mt-5 mb-5"><?= $product->name ?></h5>
                </div>
            </div>
    </div>
    <?php
}
?>
