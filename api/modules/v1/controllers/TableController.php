<?php

namespace api\modules\v1\controllers;

use common\models\Account;
use common\models\Table;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class TableController extends ActiveController
{
    public $modelClass = 'common\models\Table';

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

    public function actionTable_accounts($id){
        return Account::find()->where(["status"=>Account::TOPAY,"table_id"=>$id])->all();
    }

    public function actionTable(){
        $tables = Table::find()->asArray()->all();
        $newTable=array();
        foreach ($tables as $table){
            $table["total"]=Table::findOne($table["id"])->getTotal($table["id"]);
            array_push($newTable,$table);
        }
        return $newTable;
    }
}