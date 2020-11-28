<?php

namespace backend\controllers;

use common\models\Account;
use common\models\ProductsPaid;
use Yii;
use common\models\Bill;
use common\models\BillSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BillController implements the CRUD actions for Bill model.
 */
class SaleController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all Bill models.
     * @return mixed
     */
    public function actionIndex()
    {
        $accounts=Account::find()->where(["status"=>Account::STATUS_PAYED]);
        if(isset($_POST["date"])){
            $accounts->andwhere(['like', 'dateTime', Yii::$app->request->post("date")]);
        }
        return $this->render('index', [
            "accounts"=>$accounts->all(),
        ]);
    }

    /**
     * Displays a single Bill model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $account = Account::findOne(["id"=>$id,"status"=>Account::STATUS_PAYED]);
        if(empty($account))
            return $this->redirect("index");


        $productsPaid=ProductsPaid::find()
            ->innerJoin("request","request_id=request.id")
            ->where(["account_id"=>$id])
            ->groupBy("product_id")
            ->all();
        foreach ($productsPaid as $product){
            $product->quantity= ProductsPaid::find()
                ->innerJoin("request","request_id=request.id")
                ->where(["account_id"=>$id,"product_id"=>$product->product_id])
                ->sum("quantity");
        }


        return $this->render('view', [
            'account' => $account,
            'products' => $productsPaid,
        ]);
    }


    /**
     * Deletes an existing Bill model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
