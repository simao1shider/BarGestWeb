<?php

namespace frontend\controllers;

use common\models\Account;
use common\models\Bill;
use common\models\ProductsPaid;
use common\models\ProductsToBePaid;
use Yii;
use common\models\Request;
use common\models\RequestSearch;
use common\models\Category;
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
                    'delete' => ['POST'],
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
        $model = new Request();


        $categories = Category::find()->all();
        if(isset($_GET['bill']) || isset($_GET['tableId'])){
            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
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
        if(isset($_GET["Table"])){
            $bill= new Bill();
            $bill->Tables_id=$_GET["Table"];
            $bill->dateTime=date("Y-m-d H:i:s");
            $bill->total=0;
            $bill->status=1;
            $bill->save();
            $account= new Account();
            $account->name="Not need";
            $account->dateTime=date("Y-m-d H:i:s");
            $account->status=true;
            $account->total=0;
            $account->Tables_id=$_GET["Table"];
            $account->Employees_id=1; //TODO:Trocar para o empregado que esta logado
            $account->Cashiers_id=1; //TODO: Tocar para a caixa que esta aberta
            if($account->save()){
                $request = new Request();
                $request->dateTime = date("Y-m-d H:i:s");
                $request->status=2;
                $request->Accounts_id=$account->id;
                if($request->save()){
                    $addproducts=$_SESSION["Addproducts"];
                    foreach ($addproducts as $addproduct){
                        $toPaid = new ProductsToBePaid();
                        $toPaid->Requests_id = $request->id;
                        $toPaid->Products_id = $addproduct['id'];
                        $toPaid->quantity = $addproduct['quantity'];
                        $paid= new ProductsPaid();
                        $paid->Bills_id=$bill->id;
                        $paid->Products_id = $addproduct['id'];
                        $paid->quantity = $addproduct['quantity'];

                        if($paid->save() && $toPaid->save()){
                            unset($_SESSION["Addproducts"]);
                            $this->redirect(["index"]);
                        }
                    }
                }
            }
        }
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $this->findModel($id)->delete();

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
