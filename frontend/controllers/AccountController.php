<?php

namespace frontend\controllers;

use common\models\Account;
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

        return $this->render('view', [
            'model' => $this->findModel($id),
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
