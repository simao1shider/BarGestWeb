<?php

namespace frontend\controllers;


use Codeception\Module\Yii2;
use common\models\Account;
use common\models\Category;
use common\models\Product;
use common\models\ProductsToBePaid;
use Yii;
use yii\web\Controller;

class AjaxController extends Controller
{
    public function actionGet_categories()
    {
        $model = Category::find()->where(["status"=>Category::STATUS_ACTIVE])->all();

        return $this->renderAjax('../request/components/categories', ["categories" => $model]);
    }

    public function actionGet_products()
    {
        $categoryId = Yii::$app->request->post("categoryId");
        $model = Product::find()->where(["category_id"=>$categoryId,"status"=>Category::STATUS_ACTIVE])->all();
        return $this->renderAjax('../request/components/products', ["products" => $model]);
    }

    public function actionShow_products()
    {
        if (isset($_SESSION["Addproducts"])) {
            return $this->renderAjax('../request/components/ListOfProducts', ["products" => $_SESSION["Addproducts"]]);
        } else {
            return $this->renderAjax('../request/components/ListOfProducts');
        }
    }

    public function actionAdd_product()
    {
        $productId = Yii::$app->request->post("id");
        $product = Product::find()->where(['id' => $productId])->one()->toArray();
        $product["quantity"] = 1;

        if (!isset($_SESSION["Addproducts"])) {
            $addProducts = array($productId => $product);
        } else {
            $addProducts = $_SESSION["Addproducts"];
            if (empty($addProducts[$productId])) {
                $addProducts[$productId] = $product;
            } else {
                $addProducts[$productId]["quantity"] += 1;
            }
        }
        if (isset($_SESSION["Deleteproducts"][$productId])) {
            unset($_SESSION["Deleteproducts"][$productId]);
        }
        $_SESSION["Addproducts"] = $addProducts;
        //unset( $_SESSION["Addproducts"]);
        return $this->renderAjax('../request/components/ListOfProducts', ["products" => $addProducts]);
    }

    public function actionAdd_product_quantity()
    {
        $product = $_SESSION["Addproducts"][$_POST["id"]];
        $product["quantity"] += 1;
        $_SESSION["Addproducts"][$_POST["id"]] = $product;
        return $this->renderAjax('../request/components/ListOfProducts', ["products" => $_SESSION["Addproducts"]]);
    }

    public function actionRemove_product_quantity()
    {
        $product = $_SESSION["Addproducts"][$_POST["id"]];
        $product["quantity"] -= 1;
        if ($product["quantity"] == 0) {
            unset($_SESSION["Addproducts"][$_POST["id"]]);
            $_SESSION["Deleteproducts"][$_POST["id"]] = $_POST["id"];
        } else {
            $_SESSION["Addproducts"][$_POST["id"]] = $product;
        }
        return $this->renderAjax('../request/components/ListOfProducts', ["products" => $_SESSION["Addproducts"]]);
    }

    public function actionAccount_add_quantity()
    {
        $post = Yii::$app->request->post();
        $product = ProductsToBePaid::find()
            ->innerJoin("request", "request.id=request_id")
            ->innerJoin("account", "account.id=account_id")
            ->where(['account_id' => $post['account_id'], 'product_id' => $post["product_id"]])->one();
        $product->quantity += 1;
        $product->save();
        $account = $product->request->account;
        $quantity = ProductsToBePaid::find()
            ->select(["sum(quantity) as quantity"])
            ->innerJoin("request", 'request_id=id')
            ->innerJoin("product", "product_id=product.id")
            ->where(["account_id" => $account->id, "status" => 3, "product_id" => $post["product_id"]])
            ->groupBy("product_id")
            ->createCommand()->queryOne();
        $account->total += $product->product->price;
        $account->save();
        return json_encode(array("quantity" => $quantity["quantity"], "total" => $account->total));
    }

    public function actionAccount_remove_quantity()
    {
        $post = Yii::$app->request->post();
        $product = ProductsToBePaid::find()
            ->innerJoin("request", "request.id=request_id")
            ->innerJoin("account", "account.id=account_id")
            ->where(['account_id' => $post['account_id'], "request.status" => 3, 'product_id' => $post["product_id"]])->one();
        $product->quantity -= 1;
        $product->save();
        $account = $product->request->account;
        $request = $product->request;
        $quantity = ProductsToBePaid::find()
            ->select(["sum(quantity) as quantity"])
            ->innerJoin("request", 'request_id=id')
            ->innerJoin("product", "product_id=product.id")
            ->where(["account_id" => $account->id, "status" => 3, "product_id" => $post["product_id"]])
            ->groupBy("product_id")
            ->createCommand()->queryOne();
        $account->total -= $product->product->price;
        $account->save();
        if ($product->quantity == 0) {
            $product->delete();
        }
        if (count($request->productsToBePas) == 0) {
            $product->request->delete();
            if (count($account->requests) == 0) {
                $table = $account->table;
                $account->delete();
                if (count($table->accounts) == 0) {
                    $table->status = false;
                    $table->save();
                }
            }
        }
        return json_encode(array("quantity" => $quantity["quantity"], "total" => $account->total));
    }

    public function actionProductsToBePaid(){
        $post = Yii::$app->request->post();
        
        $products = ProductsToBePaid::find()->where('request.account.id' == $post['account_id']);

    }
}
