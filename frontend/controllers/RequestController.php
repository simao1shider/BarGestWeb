<?php

namespace frontend\controllers;

use common\models\Account;

use common\models\ProductsToBePaid;
use common\models\Table;
use Yii;
use common\models\Request;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Request::find()->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        unset($_SESSION["Addproducts"]);
        unset($_SESSION["Deleteproducts"]);
        $model = new Account();
        if(isset($_GET['account']) || isset($_GET['tableId']))
        {
            if(isset($_GET["account"])){
                $model=Account::findOne($_GET["account"]);
            }
            else{
                $model->table_id=$_GET['tableId'];
            }
            return $this->render('create', [
                'model' => $model,
            ]);
            /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }*/

        }
        else{
            return $this->redirect(['table/index','CR'=>'1']);
        }
    }

    public function actionPostcreate()
    {
        $account=Yii::$app->request->post("Account");
        if(isset($_SESSION["Addproducts"]) && count($_SESSION["Addproducts"])>0)
        {
            if(isset($account["table_id"])){
                $table = Table::findOne($account["table_id"]);
                $newAccount= new Account();
                $newAccount->load(Yii::$app->request->post());
                $newAccount->dateTime=date("Y-m-d H:i:s");
                $newAccount->total=0;
                $newAccount->status=0;
                $newAccount->save();
                $table->status=true;
                $table->save();
                $account=$this->addRequest($newAccount,$_SESSION["Addproducts"]);
                if($account->save()){
                    unset($_SESSION["Addproducts"]);
                    return $this->redirect(["index"]);
                }
            }
            if(isset($account["id"])){
                $account=Account::findOne($account["id"]);
                $account=$this->addRequest($account,$_SESSION["Addproducts"]);
                if($account->save()){
                    unset($_SESSION["Addproducts"]);
                    return $this->redirect(["index"]);
                }
            }
        }
        else{
            if(isset($_GET["Table"])){
                //TODO:Notificar que não hove inserção do produto
                return $this->redirect(["create","Table"=>$account["table_id"]]);
            }
            else{
                //TODO:Notificar que não hove inserção do produto
                return $this->redirect(["create","CR"=>1,"account"=>$account["id"]]);
            }
        }
        return $this->redirect(["index"]);
    }

    private function addRequest($account,$addproducts){
        $request = new Request();
        $request->dateTime = date("Y-m-d H:i:s");
        $request->status=0;
        $request->account_id=$account->id;
        $request->employee_id = 1;
        if($request->save()){
            foreach ($addproducts as $addproduct){
                $toPaid = new ProductsToBePaid();
                $toPaid->request_id = $request->id;
                $toPaid->product_id = $addproduct['id'];
                $toPaid->quantity = $addproduct['quantity'];
                $toPaid->save();
            }
        }
        $total=0;
        foreach ($account->requests as $request){
            foreach ($request->productsToBePas as $productsToPa){
                $total+=$productsToPa->quantity * $productsToPa->product->price;
            }
        }
        $account->total=$total;
        return $account;
    }
    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        unset($_SESSION["Addproducts"]);
        $model = $this->findModel($id);
        foreach ($model->productsToBePas as $listProduct){
                $addToSession=$listProduct->product->toArray();
                $addToSession["quantity"]=$listProduct->quantity;
                if(!isset($_SESSION["Addproducts"])){
                    $addProducts=array($listProduct->product->id=>$addToSession);
                }
                else{
                    $addProducts=$_SESSION["Addproducts"];
                    $addProducts[$listProduct->product->id]=$addToSession;
                }
                $_SESSION["Addproducts"]=$addProducts;
        }
        return $this->render('update', [
            'request' => $model,
        ]);
    }

    public function actionExecupdate(){
        $model = $this->findModel($_GET["request"]);
        if(isset($_SESSION["Addproducts"]))
        {
            foreach ($_SESSION["Addproducts"] as $product){
                $con= ProductsToBePaid::find()
                    ->where(["request_id"=>$model->id])
                    ->andWhere(["product_id"=>$product['id']]);
                if($con->exists()){
                    $edit=$con->one();
                    print_r($edit);
                    $edit->quantity=$product["quantity"];
                    $edit->update();
                }
                else{
                    $edit = new ProductsToBePaid();
                    $edit->product_id = $product['id'];
                    $edit->request_id = $model->id;
                    $edit->quantity = $product["quantity"];
                    $edit->save();
                }
            }
            unset($_SESSION["Addproducts"]);
        }
        if(isset($_SESSION["Deleteproducts"]))
        {
            foreach ($_SESSION["Deleteproducts"] as $product){
                ProductsToBePaid::find()
                    ->where(["request_id"=>$model->id])
                    ->andWhere(["product_id"=>$product])->one()->delete();
            }
            unset($_SESSION["Deleteproducts"]);
        }

        if ($model->save()) {
            return $this->redirect(['index']);
        }
        //TODO:Layout de messagem de erro
        return null;
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $request= $this->findModel($id);
        foreach ($request->productsToBePas as $connection){
            $connection->delete();
        }
        $account = $request->account;
        $request->delete();
        if(!count($account->requests)>0){
            $table=$account->table;
            $account->delete();
            $tableAtualAccounts=Account::find()->where(["table_id"=>$account->table->id,"status"=>0])->all();
            if(empty($tableAtualAccounts)){
                $total=0;
                foreach ($table->accounts as $account)
                    $total+=$account->total;
                $table->status=false;
                $table->save();
            }
        }
        return $this->redirect(['index']);
    }


    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
