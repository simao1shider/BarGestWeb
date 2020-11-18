<div class="col-1 h3 text-center"><?=$request->account->table->number?></div>
<div class="col-2 h3 text-center"><?=date_create($request->dateTime)->format("H:i")?></div>
<div class="col-7">
    <h3><?=$request->employee->name?></h3>
    <?php
    foreach ($request->productsToBePas as $productToBePaid){
        ?>
        <div class="row ml-3">
            <div class="col-4 h4 ml-4"><?= $productToBePaid->product->name ?></div>
            <div class="col-2 h4"><?= $productToBePaid->product->price ?>€</div>
            <div class="col-1"></div>
            <div class="col-2 h4"><?= $productToBePaid->quantity ?></div>
        </div>
        <?php
    }
    ?>
</div>
