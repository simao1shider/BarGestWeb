<?php

namespace api\modules\v1\controllers;

use common\models\Account;
use common\models\Request;
use common\models\Table;
use yii\rest\ActiveController;
use yii\web\Response;

class RequestController extends ActiveController
{
    public $modelClass = 'common\models\Request';

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

    public function actionCurrent_requests(){
        return Request::find()
            ->select("number as table_number, request.status, request.id,request.dateTime")
            ->innerJoin("account","account_id=account.id")
            ->innerJoin("table","table_id=table.id")
            ->where(["!=","request.status",Request::STATUS_DELIVERED])
            ->andWhere(["account.status"=>Account::TOPAY])
            ->asArray()
            ->all();
    }
}
