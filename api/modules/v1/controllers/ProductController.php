<?php

namespace api\modules\v1\controllers;

use common\models\Product;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';

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

    public function actionGetall(){
        return Product::find()
            ->where(["status"=>Product::STATUS_ACTIVE])
            ->all();
    }

    public function actionGet_porducts_by_category($id){
        return Product::find()
            ->where(["category_id"=>$id, "status"=>Product::STATUS_ACTIVE])
            ->all();
    }


}
