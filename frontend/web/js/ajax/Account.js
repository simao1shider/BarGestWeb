"use strict";

function accountAddQuantity(account_id, product_id) {
  $.ajax({
    url: "../ajax/account_add_quantity",
    method: "post",
    data: { account_id: account_id, product_id: product_id },
  }).done(function (msg) {
    msg = jQuery.parseJSON(msg);
    $("#accountProductQuantity_" + product_id).html(msg["quantity"]);
    $("#accountProductPrice_" + product_id).html((msg.quantity * msg.price).toFixed(2) + "€");
    $("#accountTotal").html(msg.total.toFixed(2));
  });
}

function accountRemoveQuantity(account_id, product_id) {
  $.ajax({
    url: "../ajax/account_remove_quantity",
    method: "post",
    data: { account_id: account_id, product_id: product_id },
  }).done(function (msg) {
    msg = jQuery.parseJSON(msg);
    if (msg["quantity"] == 0) {
      $("#product_" + product_id).remove();
      var num = 0;
      $('#listProductsAccount span').each(function(){
        num++;
      });
      if(num==0){
        window.history.back();
      }
    } else {
      $("#accountProductQuantity_" + product_id).html(msg["quantity"]);
      $("#accountProductPrice_" + product_id).html((msg.quantity * msg.price).toFixed(2) + "€");
    }
    $("#accountTotal").html(msg.total.toFixed(2));
  });
}

function loadAccountProducts(request_id) {
  $.ajax({
    url: "../ajax/account_load_products",
    method: "post",
    data: { request_id: request_id },
  }).done(function (msg) {
    $("#listofProducs_" + request_id).html(msg);
  });
}

function loadAccountProductsToBePaid(account_id) {
  $.ajax({
    url: "../ajax/account_load_products_to_be_paid",
    method: "post",
    data: { account_id: account_id },
  }).done(function (msg) {
    $("#listProductsToBePaid" + account_id).html(msg);
  });
}
