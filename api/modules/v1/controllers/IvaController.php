<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class IvaController extends ActiveController
{
    public $modelClass = 'common\models\Iva';

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
}
