<?php

namespace api\modules\v1\controllers;

use common\models\ProductsToBePaid;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class ProductstobepaidController extends ActiveController
{
    public $modelClass = 'common\models\ProductsToBePaid';

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

    public function actionAll(){
        return ProductsToBePaid::find()
        ->select("quantity, request_id, product_id, request.account_id as account_id, product.name as product_name, product.price as product_price")
        ->innerJoin("request", "request_id = request.id")
        ->innerJoin("product", "product_id = product.id")
        ->asArray()
        ->all();
    }
}
