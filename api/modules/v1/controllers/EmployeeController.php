<?php

namespace api\modules\v1\controllers;

use common\models\LoginForm;
use common\models\User;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class EmployeeController extends ActiveController
{
    public $modelClass = 'common\models\Employee';
    private $username;
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
                        $this->username=$username;
                        $user = \common\models\User::findByUsername($username);
                        if ($user && $user->validatePassword($password)){
                            Yii::$app->response->cookies->remove("_csrf-backend");
                            Yii::$app->response->cookies->remove("PHPSESSID");
                            return $user;
                        }
                        return null;
                    }
                ],
            ],
        ];
        return $behaviors;
    }
    public function actionLoginuser(){
         $user=User::findByUsername($this->username);
         return $user->auth_key;

    }

}