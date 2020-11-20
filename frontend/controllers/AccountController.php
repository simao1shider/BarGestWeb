<?php

namespace frontend\controllers;

use common\models\Account;
use common\models\ProductsToBePaid;
use common\models\Request;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class AccountController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id){

        $products=ProductsToBePaid::find()
            ->select(["name", "price", "sum(quantity) as quantity", "request_id","product_id"])
            ->innerJoin("request",'request_id=id')
            ->innerJoin("product","product_id=product.id")
            ->where(["account_id"=>$id,"status"=>3])
            ->groupBy("product_id")
            ->createCommand()->queryAll();

        return $this->render('view', [
            'products' => $products,
            'account' => $this->findModel($id),
        ]);
    }





    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
