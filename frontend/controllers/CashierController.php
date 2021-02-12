<?php

namespace frontend\controllers;

use common\models\Cashier;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * CashierController implements the CRUD actions for Cashier model.
 */
class CashierController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['fecharcaixa', 'abrircaixa'],
                        'roles' => ['employee'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionFecharcaixa()
    {
        if (\Yii::$app->user->can('counter')) {
            $caixa = Cashier::find()->where(['status' => 1])->one();

            foreach($caixa->accounts as $account){
                if($account->status == 0){
                    return $this->render('error', ['exception' => "Não pode fechar a caixa porque existem contas abertas!"]);
                }
            }

            $caixa->status = 0;
            $caixa->save();   

            $cashier = Cashier::find()->where(['status' => 1])->one();
            if(!$cashier){
                return $this->redirect(['site/index']);
            }
            return $this->redirect(['site/index'], [
                'cashier' => $cashier,
            ]);
        }

        throw new ForbiddenHttpException('A sua conta não tem permissão para esta ação!');
    }

    public function actionAbrircaixa()
    {
        if (\Yii::$app->user->can('counter')) {
            $caixan = Cashier::find()->where(['status' => 1])->count();
            $caixad = Cashier::find()->where(['date' => date("Y/m/d")])->count();

            if ($caixad > 0) {
                return $this->render('error', ['exception' => "Já foi aberta uma caixa hoje!"]);
            }
            if ($caixan == 0) {
                $caixa = new Cashier();
                $caixa->status = 1;
                $caixa->total = 0;
                $caixa->date = date("Y-m-d");
                $caixa->save();
            } else {
                return $this->render('error', ['exception' => "Uma caixa já está aberta, apenas pode ter uma caixa aberta!"]);
            }

            return $this->redirect(['site/index']);
        }

        throw new ForbiddenHttpException('A sua conta não tem permissão para esta ação!');
    }


    protected function findModel($id)
    {
        if (($model = Cashier::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
