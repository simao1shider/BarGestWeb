'use strict';

function accountAddQuantity(account_id,product_id){
    $.ajax({
        url: "../ajax/account_add_quantity",
        method: "post",
        data: {'account_id':account_id,'product_id':product_id},
    }).done(function (msg){
        msg=jQuery.parseJSON(msg);
        $("#accountProductQuantity_"+product_id).html(msg["quantity"]);
        $("#accountTotal").html(msg.total);
    });
}

function accountRemoveQuantity(account_id,product_id){
    $.ajax({
        url: "../ajax/account_remove_quantity",
        method: "post",
        data: {'account_id':account_id,'product_id':product_id},
    }).done(function (msg){
        msg=jQuery.parseJSON(msg);
        if(msg["quantity"]==0){
            $("#product_"+product_id).remove();
        }
        else{
            $("#accountProductQuantity_"+product_id).html(msg["quantity"]);
        }
        $("#accountTotal").html(msg["total"]);
    });
}

function loadAccountProducts(request_id){
    $.ajax({
        url: "../ajax/account_load_products",
        method: "post",
        data: {'request_id':request_id},
    }).done(function (msg){
        $("#listofProducs_"+request_id).html(msg);
    });
}
