<?php

namespace frontend\controllers;

use Yii;
use common\models\Account;
use common\models\ProductsPaid;
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

    public function actionView($id)
    {
        $model = $this->findModel($id);
                
        if ($model->load(Yii::$app->request->post())) {
            //Caso não indique o nif
            if ($model->nif == 0) {
                $model->nif = 999999990;
            } else {
                //Valida se o nif está correto
                if (!$model->validateNIF($model->nif)) {
                    return $this->redirect(['error']);
                }
            }

            //Procurar os produtos a serem pagos
            foreach ($model->requests as $request) {
                foreach ($request->productsToBePas as $productToBePaid) {
                    //Transferir os produtos do ProductsToBePaid para o ProductsPaid
                    $productPaid = new ProductsPaid();
                    $productPaid->request_id = $productToBePaid->request_id;
                    $productPaid->product_id = $productToBePaid->product_id;
                    $productPaid->quantity = $productToBePaid->quantity;
                    $productPaid->save();
                    //Apagar os produtos do ProductsToBePaid
                    ProductsToBePaid::findOne($productToBePaid->request_id, $productToBePaid->product_id)->delete();
                }
                Request::findOne($request->id)->delete();
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $productsToBePaid = ProductsToBePaid::find()
                ->select(["name", "price", "sum(quantity) as quantity"])
                ->innerJoin("request", 'request_id=id')
                ->innerJoin("product", "product_id=product.id")
                ->where(["account_id" => $id, "status" => 3])
                ->groupBy("product_id")
                ->createCommand()->queryAll();
                
            return $this->render('view', [
                'account' => $this->findModel($id),
                'productsToBePaid' => $productsToBePaid,
            ]);
        }
    }

    public function actionSplit($id)
    {

        return $this->render('split', [
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
