<?php

namespace frontend\controllers;

use common\models\Account;

use common\models\Cashier;
use common\models\Employee;
use common\models\ProductsToBePaid;
use common\models\Table;
use Yii;
use common\models\Request;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['listRequest']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['showCreateRequest'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['postcreate'],
                        'roles' => ['createRequest'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['showUpdateRequest'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['execupdate'],
                        'roles' => ['updateRequest'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['change_status'],
                        'roles' => ['changeStatusRequest'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deleteRequest'],
                    ],
                ],
            ],
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
        if(empty(Yii::$app->user->id)){
            echo 'teste';
        }
        $model = Request::find()
            ->where("status!=".Request::STATUS_DELIVERED)
            ->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        unset($_SESSION["Addproducts"]);
        unset($_SESSION["Deleteproducts"]);
        $model = new Account();
        if (isset($_GET['account']) || isset($_GET['tableId'])) {
            if (isset($_GET["account"])) {
                $model = Account::findOne($_GET["account"]);
                if($model == null){
                    throw new HttpException(404,"Conta não existe");
                }
            } else {
                echo Table::find()->where(["id"=>$_GET['tableId']])->exists();
                if(Table::find()->where(["id"=>$_GET['tableId']])->exists()){
                    $model->table_id = $_GET['tableId'];
                }
                else
                {
                    throw new HttpException(404,"Mesa não existe");
                }
            }
            return $this->render('create', [
                'model' => $model,
            ]);
            /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }*/
        } else {
            return $this->redirect(['table/index', 'CR' => '1']);
        }
    }

    public function actionPostcreate()
    {
        $account = Yii::$app->request->post("Account");
        if (isset($_SESSION["Addproducts"]) && count($_SESSION["Addproducts"]) > 0) {
            if (isset($account["table_id"])) {
                $table = Table::findOne($account["table_id"]);
                $newAccount = new Account();
                $newAccount->load(Yii::$app->request->post());
                $newAccount->dateTime = date("Y-m-d H:i:s");
                $newAccount->total = 0;
                $newAccount->nif = 0;
                $newAccount->status = Account::TOPAY;
                $cashier=Cashier::findOne(["status"=>Cashier::OPEN]);
                if(!empty($cashier))
                    $newAccount->cashier_id = $cashier->id;
                else
                    throw new HttpException(404,"Não existem caixas abertas");
                if(!$newAccount->save())
                    throw new HttpException(500,"Não foi possivel criar uma conta");
                $table->status = Table::STATUS_BUSY;
                if(!$table->save())
                    throw new HttpException(500,"Não foi possivel alterar o estao da mesa");
                $account = $this->addRequest($newAccount, $_SESSION["Addproducts"]);
                if ($account->save()) {
                    unset($_SESSION["Addproducts"]);
                    return $this->redirect(["index"]);
                }
                else{
                    throw new HttpException(500,"Não foi possivel adicionar productos a conta");
                }
            }
            if (isset($account["id"])) {
                $account = Account::findOne($account["id"]);
                $account = $this->addRequest($account, $_SESSION["Addproducts"]);
                if ($account->save()) {
                    unset($_SESSION["Addproducts"]);
                    return $this->redirect(["index"]);
                }
                else{
                    throw new HttpException(500,"Não foi possivel adicionar productos a conta");
                }
            }
        } else {
            if (isset($account["table_id"])) {
                //TODO:Notificar que não hove inserção do produto
                return $this->redirect(["create", "tableId" => $account["table_id"]]);
            } else {
                //TODO:Notificar que não hove inserção do produto
                return $this->redirect(["create", "CR" => 1, "account" => $account["id"]]);
            }
        }
        return $this->redirect(["index"]);
    }

    private function addRequest($account, $addproducts)
    {
        $request = new Request();
        $request->dateTime = date("Y-m-d H:i:s");
        $request->status = Request::STATUS_REQUEST;
        $request->account_id = $account->id;
        $request->employee_id = Employee::findOne(["user_id"=>Yii::$app->user->id])->id;
        if ($request->save()) {
            foreach ($addproducts as $addproduct) {
                $toPaid = new ProductsToBePaid();
                $toPaid->request_id = $request->id;
                $toPaid->product_id = $addproduct['id'];
                $toPaid->quantity = $addproduct['quantity'];
                $toPaid->save();
            }
        }
        $total = 0;
        foreach ($account->requests as $request) {
            foreach ($request->productsToBePas as $productsToPa) {
                $total += $productsToPa->quantity * $productsToPa->product->price;
            }
        }
        $account->total = $total;
        return $account;
    }

    public function actionUpdate($id)
    {
        unset($_SESSION["Addproducts"]);
        $model = $this->findModel($id);
        foreach ($model->productsToBePas as $listProduct) {
            $addToSession = $listProduct->product->toArray();
            $addToSession["quantity"] = $listProduct->quantity;
            if (!isset($_SESSION["Addproducts"])) {
                $addProducts = array($listProduct->product->id => $addToSession);
            } else {
                $addProducts = $_SESSION["Addproducts"];
                $addProducts[$listProduct->product->id] = $addToSession;
            }
            $_SESSION["Addproducts"] = $addProducts;
        }
        return $this->render('update', [
            'request' => $model,
        ]);
    }

    public function actionExecupdate()
    {
        $model = $this->findModel($_GET["request"]);
        if (isset($_SESSION["Addproducts"])) {
            foreach ($_SESSION["Addproducts"] as $product) {
                $con = ProductsToBePaid::find()
                    ->where(["request_id" => $model->id])
                    ->andWhere(["product_id" => $product['id']]);
                if ($con->exists()) {
                    $edit = $con->one();
                    $edit->quantity = $product["quantity"];
                    $edit->update();
                } else {
                    $edit = new ProductsToBePaid();
                    $edit->product_id = $product['id'];
                    $edit->request_id = $model->id;
                    $edit->quantity = $product["quantity"];
                    $edit->save();
                }
            }
            unset($_SESSION["Addproducts"]);
        }
        if (isset($_SESSION["Deleteproducts"])) {
            foreach ($_SESSION["Deleteproducts"] as $product) {
                ProductsToBePaid::find()
                    ->where(["request_id" => $model->id])
                    ->andWhere(["product_id" => $product])->one()->delete();
            }
            unset($_SESSION["Deleteproducts"]);
        }

        if ($model->save()) {
            return $this->redirect(['index']);
        }
        //TODO:Layout de messagem de erro
        return null;
    }


    public function actionDelete($id)
    {
        $request = $this->findModel($id);
        foreach ($request->productsToBePas as $connection) {
            $connection->delete();
        }
        $account = $request->account;
        $request->delete();
        if (!count($account->requests) > 0) {
            $table = $account->table;
            $account->delete();
            $tableAtualAccounts = Account::find()->where(["table_id" => $account->table->id, "status" => 0])->all();
            if (empty($tableAtualAccounts)) {
                $total = 0;
                foreach ($table->accounts as $account)
                    $total += $account->total;
                $table->status = false;
                $table->save();
            }
        }
        return $this->redirect(['index']);
    }

    public function actionChange_status()
    {
        $get = Yii::$app->request->get();

        if (isset($get["block"])) {
            $request = $this->findModel($get["block"]);
            $request->status = 1;
            $request->save();
        }
        if (isset($get["prepare"])) {
            $request = $this->findModel($get["prepare"]);
            $request->status = 2;
            $request->save();
        }
        $this->redirect(["index"]);
    }


    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
