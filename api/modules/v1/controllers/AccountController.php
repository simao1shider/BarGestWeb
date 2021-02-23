<?php

namespace api\modules\v1\controllers;

use common\models\ProductsToBePaid;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\web\HttpException;
use common\models\Account;
use common\models\Request;
use common\models\ProductsPaid;
use yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class AccountController extends ActiveController
{
    public $modelClass = 'common\models\Account';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [

            'class' => 'yii\filters\ContentNegotiator',

            'formats' => [

                'application/json' => Response::FORMAT_JSON,

            ]
        ];
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password){
                        $user = \common\models\User::findByUsername($username);
                        if ($user && $user->validatePassword($password)){
                            return $user;
                        }
                        return null;
                    }
                ],
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actionAll()
    {
        return Account::find()
            ->where(["account.status" => 0])
            ->asArray()
            ->all();
    }

    public function actionAccountinfo($id)
    {
        return ProductsToBePaid::find()
            ->select("product.id as id, SUM(quantity) as quantity, price, product.name, product.category_id")
            ->innerJoin("request", "request_id=request.id")
            ->innerJoin("account", "account_id=account.id")
            ->innerJoin("product", "product_id=product.id")
            ->where(["account.id" => $id])
            ->groupBy("product.id")
            ->asArray()
            ->all();
    }

    public function actionPay($id)
    {
        $nif = Yii::$app->request->post('nif');
        
        $account = Account::findOne($id);
        if (empty($nif)) {
            throw new HttpException(404, 'Request not found.');
        }

        if ($nif == null) {
            $nif = 999999990;
        } else {
            //Valida se o nif está correto
            if (!$account->validateNIF($nif)) {
                throw new HttpException(415, 'NIF is not valid!');
            }
        }

        foreach ($account->requests as $request) {
            foreach ($request->productsToBePas as $productToBePaid) {
                //Transferir os produtos do ProductsToBePaid para o ProductsPaid
                $productPaid = new ProductsPaid();
                $productPaid->request_id = $productToBePaid->request_id;
                $productPaid->product_id = $productToBePaid->product_id;
                $productPaid->quantity = $productToBePaid->quantity;
                $productPaid->save();
                //Apagar os produtos do ProductsToBePaid
                ProductsToBePaid::findOne($productToBePaid->request_id, $productToBePaid->product_id)->delete();
            }
            $request = Request::findOne($request->id);
            $request->status = 4;
            $request->save();
        }
        $account->status = 1;
        $account->save();

        return "Pagamento efetuado com sucesso!";

    }

    public function actionSplitpay($id){
        //return print_r(Yii::$app->request->post());
        $nif = Yii::$app->request->post('nif');
        $products = json_decode(Yii::$app->request->post('products'));

        $account = Account::findOne($id);

        $dbnumProductsToBePaid = 0;
        $headernumProductsToBePaid = 0;
        $newaccount = new Account();
        $newrequest = new Request();

        foreach ($account->requests as $request) {
            if ($request->status == 3) {
                foreach ($request->productsToBePas as $productToBePaid) {
                    $dbnumProductsToBePaid += $productToBePaid->quantity;
                }
            }
        }

        foreach ($products as $product) {
            $headernumProductsToBePaid += $product->quantity;
        }

        if ($dbnumProductsToBePaid > $headernumProductsToBePaid) {

            $newaccount = new Account();
            $newrequest = new Request();

            if ($account->nif == 0) {
                $newaccount->nif = 999999990;
            } else {
                //Valida se o nif está correto
                if (!$account->validateNIF($account->nif)) {
                    throw new HttpException(403, "Nif errado");
                }
                $newaccount->nif = $account->nif;
            }

            $newaccount->id = Account::find()->max('id') + 1;
            $newaccount->name = $account->name;
            $newaccount->total = 0;
            $newaccount->dateTime = $account->dateTime;
            $newaccount->status = 1;
            $newaccount->table_id = $account->table_id;
            $newaccount->cashier_id = $account->cashier_id;
            if (!$newaccount->save()) {
                throw new HttpException(403, "Erro ao criar conta!");
            }

            $newrequest->id = Request::find()->max('id') + 1;
            $newrequest->status = 3;
            $newrequest->dateTime = $newaccount->dateTime;
            $newrequest->account_id = $newaccount->id;
            $newrequest->employee_id = $account->requests[0]->employee_id;
            if (!$newrequest->save()) {
                throw new HttpException(403, "Erro ao criar pedido!");
            }

        }else{
            $newaccount = $account;
            $newrequest = $account->requests[0];
            if ($account->nif == 0) {
                $newaccount->nif = 999999990;
            } else {
                //Valida se o nif está correto
                if (!$account->validateNIF($account->nif)) {
                    throw new HttpException(415, "Nif errado");
                }
                $newaccount->nif = $account->nif;
            }

            $newaccount->status = 1;
            $newaccount->table->status = 0;
            $newaccount->table->save();
        }
        

        $productstobepaid = ProductsToBePaid::find()
                                    ->innerJoin("request", 'request_id = request.id')
                                    ->innerJoin("product", "product_id = product.id")
                                    ->where(["account_id" => $id, "request.status" => 3])
                                    ->all();
        //return print_r($productstobepaid);

        $total = 0;
        foreach($products as $product){
            foreach($productstobepaid as $producttobepaid){
                if($producttobepaid->product_id == $product->id){
                    if($product->quantity < $producttobepaid->quantity){
                        $newrequest->employee_id = $producttobepaid->request->employee_id;

                        $producttopaydb = new ProductsPaid();
                        $producttopaydb->request_id = $newrequest->id;
                        $producttopaydb->product_id = $producttobepaid->product_id;
                        $producttopaydb->quantity = $product->quantity;
                        $total += $producttopaydb->quantity * $producttopaydb->product->price;

                        $producttobepaid->quantity -= $product->quantity;
                        if($producttopaydb->save() && $producttobepaid->save()){
                            //nice
                        }
                        else{
                            throw new HttpException(415, 'Parâmetros Inválidos!');
                        }
                        
                    }
                    else{
                        $newrequest->employee_id = $producttobepaid->request->employee_id;

                        $producttopaydb = new ProductsPaid();
                        $producttopaydb->request_id = $newrequest->id;
                        $producttopaydb->product_id = $producttobepaid->product_id;
                        $producttopaydb->quantity = $product->quantity;
                        $total += $producttopaydb->quantity * $producttopaydb->product->price;

                        if($producttopaydb->save() && $producttobepaid->delete()){
                            //nice
                        }
                        else{
                            throw new HttpException(415, 'Parâmetros Inválidos!');
                        }
                    }
                }
            }
        }

        $newaccount->total = $total;
        $newaccount->save();

        $numproductstobepaid = ProductsToBePaid::find()
            ->innerJoin("request", 'request_id = request.id')
            ->innerJoin("product", "product_id = product.id")
            ->where(["account_id" => $id, "request.status" => 3])
            ->count();
        
        if($numproductstobepaid == 0){
            $newaccount->status = 1;
            $newaccount->save();
        }
        return "Pagamento efetuado com Sucesso!";
    }
}
