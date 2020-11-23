<?php

namespace frontend\controllers;

use common\models\Request;
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
        //TODO:p pagamento numa finção a parte
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
            $products=ProductsToBePaid::find()
                ->select(["name", "price", "sum(quantity) as quantity", "request_id","product_id"])
                ->innerJoin("request",'request_id=id')
                ->innerJoin("product","product_id=product.id")
                ->where(["account_id"=>$id,"status"=>3])
                ->groupBy("product_id")
                ->createCommand()->queryAll();
                
            return $this->render('view', [
                'account' => $this->findModel($id),
                'products' => $products,
            ]);
        }
    }

    public function actionDelete($id){
        $account=Account::findOne($id);
        foreach ($account->requests as $request){
            foreach ($request->productsToBePas as $product){
                $product->delete();
            }
            $request->delete();
        }

        $table=$account->table;
        if(count($table->accounts)==0){
            $table->status=false;
            $table->save();
        }
        $account->delete();
        $this->redirect(["table/index"]);
    }

    public function actionSplit($id)
    {

        return $this->render('split', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete_product($request_id,$product_id){
        $request = Request::findOne($request_id);
        $account=$request->account;
        $product=ProductsToBePaid::find()->where(["request_id"=>$request_id,"product_id"=>$product_id])->one();
        $product->delete();
        $price=$product->quantity*$product->product->price;
        $account->total-=$price;
        $account->save();
        if(count($request->productsToBePas)<=0){
            $request->delete();
            if(count($account->requests)<=0){
                $table=$account->table;
                $account->delete();
                $existAccount=Account::find()->where(["table_id"=>$table->id,"status"=>0]);;
                if(!$existAccount->exists()){
                    $table->status=false;
                    $table->save();
                }
                return $this->redirect(["table/index"]);
            }
            else{
                return $this->redirect(["view","id"=>$account->id]);
            }
        }
        if(count($account->requests)<=0){
            $table=$account->table;
            $account->delete();
            $existAccount=Account::find()->where(["table_id"=>$table->id,"status"=>0])->all();
            if(empty($existAccount)){
                $table->status=false;
                $table->save();
            }
            return $this->redirect(["table/index"]);
        }
        return $this->redirect(["account/view",'id'=>$account->id]);
    }



    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
