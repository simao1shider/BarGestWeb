<?php
if(empty($categories)){
    echo "<h3>Não existem categorias</h3>";
}
foreach ($categories as $category) {
    ?>
    <div class="col-4 mt-3">
            <div class="card shadow-sm text-center pt-2 pb-2" style="cursor: pointer" onclick="getProducts(<?=$category->id?>)">
                <div class="card-body">
                    <h5 class="card-title mt-5 mb-5"><?= $category->name ?></h5>
                </div>
            </div>
    </div>
    <?php
}
?>

