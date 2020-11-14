<?php

namespace frontend\controllers;

use common\models\Bill;
use \common\models\Category;
use common\models\Product;
use frontend\models\ProductsToAdd;
use yii\helpers\VarDumper;
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
                array_push($addProducts,$product);
            }
            else{
                $addProducts[$_POST["id"]]["quantity"]+=1;
            }
        }
        $_SESSION["Addproducts"]=$addProducts;
        //unset( $_SESSION["Addproducts"]);
        return $this->renderAjax('ListOfProducts',["products"=>$addProducts]);
    }

}
