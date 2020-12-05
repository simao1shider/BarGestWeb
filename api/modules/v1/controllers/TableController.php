<?php

namespace api\modules\v1\controllers;

use common\models\Account;
use yii\rest\ActiveController;
use yii\web\Response;

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
        return $behaviors;
    }

    public function actionTable_accounts($id){
        return Account::find()->where(["status"=>Account::TOPAY,"table_id"=>$id])->all();
    }
}