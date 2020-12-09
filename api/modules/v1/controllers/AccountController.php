<?php

namespace api\modules\v1\controllers;

use common\models\Product;
use common\models\ProductsToBePaid;
use yii\rest\ActiveController;
use yii\web\Response;

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

    public function actionAccountinfo($id){
        return ProductsToBePaid::find()
            ->select("product.id as id, SUM(quantity) as quantity, price,product.name")
            ->innerJoin("request","request_id=request.id")
            ->innerJoin("account","account_id=account.id")
            ->innerJoin("product","product_id=product.id")
            ->where(["account.id"=>$id])
            ->groupBy("product.id")
            ->asArray()
            ->all();
    }
}
