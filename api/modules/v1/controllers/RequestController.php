<?php

namespace api\modules\v1\controllers;

use common\models\Account;
use common\models\ProductsToBePaid;
use common\models\Request;
use common\models\Table;
use yii\rest\ActiveController;
use yii\web\HttpException;
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
            ->orderBy("dateTime desc")
            ->asArray()
            ->all();
    }

    public function actionDelete_request($id){
        $request=Request::findOne($id);
        if(empty($request)){
            throw new HttpException(404, 'The request not be found.');
        }
        if(ProductsToBePaid::deleteAll(["request_id"=>$id])){
            if($request->delete()){
                $account=$request->account;
                if(!Request::find()->where(["account_id"=>$request->account->id])->exists()){
                   if($account->delete()){
                       if(!Account::find()->where(["status"=>Account::TOPAY,"table_id"=>$account->table_id])->exists()){
                           $account->table->status=Table::STATUS_FREE;
                           if(!$account->table->save()){
                               throw new HttpException(500, 'The table not save a new status.');
                           }
                       }
                   }
                   else{
                       throw new HttpException(500, 'The account wasn\'t be deleted.');
                   }
                }
            }
            else{
                throw new HttpException(500, 'The request wasn\'t be deleted.');
            }
        }
        else{
            throw new HttpException(500, 'The product wasn\'t be deleted.');
        }
        return "Deleted success";
    }
}
