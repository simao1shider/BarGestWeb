<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\web\HttpException;
use common\models\Account;
use common\models\Request;
use common\models\ProductsPaid;
use common\models\ProductsToBePaid;
use yii;

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
        return $behaviors;
    }

    public function actionAccountinfo($id)
    {
        return ProductsToBePaid::find()
            ->select("product.id as id, SUM(quantity) as quantity, price,product.name")
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

    public function actionSplitPay($id){
        $nif = Yii::$app->request->post('nif');
        $products = Yii::$app->request->post('products');

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
    }
}
