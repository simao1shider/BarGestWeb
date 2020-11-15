<?php

namespace frontend\controllers;


use \common\models\Category;
use common\models\Product;
use yii\web\Controller;

class AjaxController extends Controller
{
    public function actionGet_categories(){
        $model= Category::find()->all();

        return $this->renderAjax('categories',["categories"=>$model]);

    }

    public function actionGet_products(){
        $model= Category::findOne($_POST["categoryId"]);
        return $this->renderAjax('products',["products"=>$model->products]);
    }

    public function actionShow_products(){
        if(isset($_SESSION["Addproducts"]))
        {
            return $this->renderAjax('ListOfProducts',["products"=>$_SESSION["Addproducts"]]);
        }
        else{
            return $this->renderAjax('ListOfProducts');
        }
    }

    public function actionAdd_product(){
        $product=Product::findOne($_POST["id"])->toArray();
        $product["quantity"]=1;

        if(!isset($_SESSION["Addproducts"])){
            $addProducts=array($_POST["id"]=>$product);
        }
        else{
            $addProducts=$_SESSION["Addproducts"];
            if(empty($addProducts[$_POST["id"]])){
                $addProducts[$_POST["id"]]=$product;
            }
            else{
                $addProducts[$_POST["id"]]["quantity"]+=1;
            }
        }
        if(isset($_SESSION["Deleteproducts"][$_POST["id"]]))
        {
            unset($_SESSION["Deleteproducts"][$_POST["id"]]);
        }
        $_SESSION["Addproducts"]=$addProducts;
        //unset( $_SESSION["Addproducts"]);
        return $this->renderAjax('ListOfProducts',["products"=>$addProducts]);
    }

    public function actionAdd_product_quantity(){
        $product=$_SESSION["Addproducts"][$_POST["id"]];
        $product["quantity"]+=1;
        $_SESSION["Addproducts"][$_POST["id"]]=$product;
        return $this->renderAjax('ListOfProducts',["products"=>$_SESSION["Addproducts"]]);
    }
    public function actionRemove_product_quantity(){
        $product=$_SESSION["Addproducts"][$_POST["id"]];
        $product["quantity"]-=1;
        if($product["quantity"]==0){
            unset($_SESSION["Addproducts"][$_POST["id"]]);
            $_SESSION["Deleteproducts"][$_POST["id"]]=$_POST["id"];
        }
        else{
            $_SESSION["Addproducts"][$_POST["id"]]=$product;
        }
        return $this->renderAjax('ListOfProducts',["products"=>$_SESSION["Addproducts"]]);
    }

}
