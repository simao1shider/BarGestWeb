'use strict';

function accountAddQuantity(request_id,product_id){
    $.ajax({
        url: "../ajax/account_add_quantity",
        method: "post",
        data: {'request_id':request_id,'product_id':product_id},
    }).done(function (msg){
        msg=jQuery.parseJSON(msg);
        $("#accountProductQuantity").html(msg["quantity"]);
        $("#accountTotal").html(msg.total);
    });
}

function accountRemoveQuantity(request_id,product_id){
    $.ajax({
        url: "../ajax/account_remove_quantity",
        method: "post",
        data: {'request_id':request_id,'product_id':product_id},
    }).done(function (msg){
        msg=jQuery.parseJSON(msg);
        $("#accountProductQuantity").html(msg["quantity"]);
        $("#accountTotal").html(msg.total);
    });
}