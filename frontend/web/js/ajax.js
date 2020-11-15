'use strict';
    $('#contentSelectProduct').ready(function (){
        loadCategories();
    });

$("#listProducts").ready(function (){
    $.ajax({
        url: "../ajax/show_products",
    }).done(function (msg){
        $("#listProducts").html(msg);
    });
});



function getProducts(categoriesId){
    $.ajax({
        url: "../ajax/get_products",
        method: "post",
        data: {'categoryId':categoriesId},
    }).done(function (msg){
        $("#contentSelectProduct").html(msg);
    });
}

function addProduct(product){
    $.ajax({
        url: "../ajax/add_product",
        method: "post",
        data: {'id':product},
    }).done(function (msg){
        $("#listProducts").html(msg);
    });
}

function backToCategories(){
    loadCategories();
}


function addQuantity(product){
    $.ajax({
        url: "../ajax/add_product_quantity",
        method: "post",
        data: {'id':product},
    }).done(function (msg){
        $("#listProducts").html(msg);
    });
}
function removeQuantity(product){
    $.ajax({
        url: "../ajax/remove_product_quantity",
        method: "post",
        data: {'id':product},
    }).done(function (msg){
        $("#listProducts").html(msg);
    });
}




function loadCategories(){
    $.ajax({
        url:"../ajax/get_categories",
        fail:function () {

        }
    }).done(function (msg) {
        $("#contentSelectProduct").html(msg);
    });
}