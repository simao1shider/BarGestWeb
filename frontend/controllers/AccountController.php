<?php

namespace frontend\controllers;

use common\models\Table;
use Yii;
use common\models\Account;
use common\models\ProductsPaid;
use common\models\ProductsToBePaid;
use common\models\Request;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class AccountController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view', 'split', 'ltr', 'rtl', 'paysplitaccount'],
                        'roles' => ['employee'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete_product', 'delete'],
                        'roles' => ['counter'],
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
                $request = Request::findOne($request->id);
                $request->status = Request::STATUS_PAYED;
                $request->save();
            }
            $model->table->status = 0;
            $model->status = Account::PAID;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            unset($_SESSION['productstobepaid']);
            unset($_SESSION['productstopay']);

            $products = ProductsToBePaid::find()
                ->select(["name", "price", "sum(quantity) as quantity", "request_id", "product_id"])
                ->innerJoin("request", 'request_id=id')
                ->innerJoin("product", "product_id=product.id")
                ->where(["account_id" => $id, "request.status" => 3])
                ->groupBy("product_id")
                ->createCommand()->queryAll();

            return $this->render('view', [
                'account' => $this->findModel($id),
                'products' => $products,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $account = Account::findOne($id);
        foreach ($account->requests as $request) {
            foreach ($request->productsToBePas as $product) {
                $product->delete();
            }
            $request->delete();
        }

        $table = $account->table;
        $account->delete();
        $quantAccounts = Account::find()->where(["table_id" => $table->id, "status" => Account::TOPAY])->count();
        if ($quantAccounts == 0) {
            $table->status = Table::STATUS_FREE;
            $table->save();
        }
        $this->redirect(["table/index"]);
    }

    public function actionSplit($id)
    {
        //unset($_SESSION['productstobepaid']);
        //unset($_SESSION['productstopay']);

        if (isset($_SESSION['productstopay'])) {
            return $this->render('split', [
                'account' => $this->findModel($id),
                'productstobepaid' => $_SESSION['productstobepaid'],
                'productstopay' => $_SESSION['productstopay'],
            ]);
        } else {
            unset($_SESSION['productstobepaid']);
            unset($_SESSION['productstopay']);
            unset($_SESSION['total']);

            $productstobepaid = ProductsToBePaid::find()
                ->select(["name", "price", "sum(quantity) as quantity", "request_id", "product_id"])
                ->innerJoin("request", 'request_id=id')
                ->innerJoin("product", "product_id=product.id")
                ->where(["account_id" => $id, "request.status" => 3])
                ->groupBy("product_id")
                ->createCommand()->queryAll();


            foreach ($productstobepaid as $product) {
                $_SESSION['productstobepaid'][$product['product_id']] = $product;
            }

            $_SESSION['total'] = 0;

            foreach ($_SESSION['productstobepaid'] as $product) {
                $_SESSION['total'] += $product['price'] * $product['quantity'];
            }

            return $this->render('split', [
                'account' => $this->findModel($id),
                'productstobepaid' => $_SESSION['productstobepaid'],
            ]);
        }
    }

    public function actionLtr($id)
    {

        $request = Yii::$app->request;
        $product_id = $request->post('productId');

        //* Caso o produto nao exista na lista
        if (isset($_SESSION['productstopay'][$product_id])) {
            $_SESSION['productstopay'][$product_id]['quantity'] += 1;
            if ($_SESSION['productstobepaid'][$product_id]['quantity'] == 1) {
                unset($_SESSION['productstobepaid'][$product_id]);
            } else {
                $_SESSION['productstobepaid'][$product_id]['quantity'] -= 1;
            }
        } else {
            $_SESSION['productstopay'][$product_id] = $_SESSION['productstobepaid'][$product_id];
            $_SESSION['productstopay'][$product_id]['quantity'] = 1;
            if ($_SESSION['productstobepaid'][$product_id]['quantity'] == 1) {
                unset($_SESSION['productstobepaid'][$product_id]);
            } else {
                $_SESSION['productstobepaid'][$product_id]['quantity'] -= 1;
            }
        }
        return $this->redirect(["split", 'id' => $id]);
    }

    public function actionRtl($id)
    {
        $request = Yii::$app->request;
        $product_id = $request->post('productId');

        //* Caso o produto nao exista na lista
        if (isset($_SESSION['productstobepaid'][$product_id])) {
            $_SESSION['productstobepaid'][$product_id]['quantity'] += 1;
            if ($_SESSION['productstopay'][$product_id]['quantity'] == 1) {
                unset($_SESSION['productstopay'][$product_id]);
            } else {
                $_SESSION['productstopay'][$product_id]['quantity'] -= 1;
            }
        } else {
            $_SESSION['productstobepaid'][$product_id] = $_SESSION['productstopay'][$product_id];
            $_SESSION['productstobepaid'][$product_id]['quantity'] = 1;
            if ($_SESSION['productstopay'][$product_id]['quantity'] == 1) {
                unset($_SESSION['productstopay'][$product_id]);
            } else {
                $_SESSION['productstopay'][$product_id]['quantity'] -= 1;
            }
        }
        return $this->redirect(["split", 'id' => $id]);
    }

    public function actionPaysplitaccount($id)
    {
        $model = $this->findModel($id);


        $account = Account::findOne($id);

        $dbnumProductsToBePaid = 0;
        $sessionnumProductsToBePaid = 0;

        foreach ($account->requests as $request) {
            if ($request->status == 3) {
                foreach ($request->productsToBePas as $productToBePaid) {
                    $dbnumProductsToBePaid += $productToBePaid->quantity;
                }
            }
        }

        foreach ($_SESSION['productstopay'] as $product) {
            $sessionnumProductsToBePaid += $product['quantity'];
        }

        if ($dbnumProductsToBePaid > $sessionnumProductsToBePaid) {

            $newaccount = new Account();
            $newrequest = new Request();

            if ($model->nif == 0) {
                $newaccount->nif = 999999990;
            } else {
                //Valida se o nif está correto
                if (!$model->validateNIF($model->nif)) {
                    throw new HttpException(403, "Nif errado");
                }
                $newaccount->nif = $model->nif;
            }

            $newaccount->id = Account::find()->max('id') + 1;
            $newaccount->name = $model->name;
            $newaccount->total = 0;
            $newaccount->dateTime = $model->dateTime;
            $newaccount->status = 1;
            $newaccount->table_id = $model->table_id;
            $newaccount->cashier_id = $model->cashier_id;
            if (!$newaccount->save()) {
                throw new HttpException(403, "Erro ao criar conta!");
            }

            $newrequest->id = Request::find()->max('id') + 1;
            $newrequest->status = 3;
            $newrequest->dateTime = $newaccount->dateTime;
            $newrequest->account_id = $newaccount->id;
            $newrequest->employee_id = $model->requests[0]->employee_id;
            if (!$newrequest->save()) {
                throw new HttpException(403, "Erro ao criar pedido!");
            }
        } else {
            $newaccount = $model;
            $newrequest = $model->requests[0];
            if ($model->nif == 0) {
                $newaccount->nif = 999999990;
            } else {
                //Valida se o nif está correto
                if (!$model->validateNIF($model->nif)) {
                    throw new HttpException(403, "Nif errado");
                }
                $newaccount->nif = $model->nif;
            }

            $newaccount->status = Account::PAID;
            $accountToBePaied=Account::find()->where(["status"=>Account::TOPAY,"table_id"=>$newaccount->table->id])->count();
            if($accountToBePaied == 0){
                $newaccount->table->status = Table::STATUS_FREE;
                $newaccount->table->save();
            }
        }

        $productstobepaid = ProductsToBePaid::find()
            ->innerJoin("request", 'request_id = id')
            ->innerJoin("product", "product_id = product.id")
            ->where(["account_id" => $id, "request.status" => 3])
            ->All();

        $total = 0;
        foreach ($productstobepaid as $producttobepaid) {
            if (isset($_SESSION['productstopay'][$producttobepaid->product_id])) {
                if ($_SESSION['productstopay'][$producttobepaid->product_id]['quantity'] < $producttobepaid->quantity) {
                    $newrequest->employee_id = $producttobepaid->request->employee_id;

                    $producttopaydb = new ProductsPaid();
                    $producttopaydb->request_id = $newrequest->id;
                    $producttopaydb->product_id = $producttobepaid->product_id;
                    $producttopaydb->quantity = $_SESSION['productstopay'][$producttobepaid->product_id]['quantity'];
                    $producttopaydb->save();
                    $total += $producttopaydb->quantity * $producttopaydb->product->price;

                    $producttobepaid->quantity -= $_SESSION['productstopay'][$producttobepaid->product_id]['quantity'];
                    $producttobepaid->save();
                    unset($_SESSION['productstopay'][$_SESSION['productstopay'][$producttobepaid->product_id]['product_id']]);
                } else {
                    $newrequest->employee_id = $producttobepaid->request->employee_id;

                    $producttopaydb = new ProductsPaid();
                    $producttopaydb->request_id = $newrequest->id;
                    $producttopaydb->product_id = $producttobepaid->product_id;
                    $producttopaydb->quantity = $_SESSION['productstopay'][$producttobepaid->product_id]['quantity'];
                    $producttopaydb->save();
                    $total += $producttopaydb->quantity * $producttopaydb->product->price;

                    unset($_SESSION['productstopay'][$_SESSION['productstopay'][$producttobepaid->product_id]['product_id']]);
                    $producttobepaid->delete();
                }
            }
        }

        $newaccount->total = $total;
        $newaccount->save();

        $numProductsTobePaid = ProductsToBePaid::find()
            ->innerJoin("request","request_id=request.id")
            ->innerJoin("product","product_id = product.id")
            ->where(["account_id"=>$id])
            ->andWhere("request.status!=".Request::STATUS_PAYED)
            ->count();
        if($numProductsTobePaid == 0){
            $model->status=Account::PAID;
            $model->save();
            $table=$model->table;
            $accountToBePaied=Account::find()->where(["status"=>Account::TOPAY,"table_id"=>$table->id])->count();
            if($accountToBePaied == 0){
                $table->status=Table::STATUS_FREE;
                $table->save();
                return $this->redirect(["table/index"]);
            }
            return $this->redirect(["table/view","id"=>$table->id]);
        }
        return $this->redirect(["split", 'id' => $id]);
    }

    public function actionDelete_product($request_id, $product_id)
    {
        $request = Request::findOne($request_id);
        $account = $request->account;
        $product = ProductsToBePaid::find()->where(["request_id" => $request_id, "product_id" => $product_id])->one();
        $product->delete();
        $price = $product->quantity * $product->product->price;
        $account->total -= $price;
        $account->save();
        if (count($request->productsToBePas) <= 0) {
            $request->delete();
            if (count($account->requests) <= 0) {
                $table = $account->table;
                $account->delete();
                $existAccount = Account::find()->where(["table_id" => $table->id, "status" => 0]);;
                if (!$existAccount->exists()) {
                    $table->status = false;
                    $table->save();
                }
                return $this->redirect(["table/index"]);
            } else {
                return $this->redirect(["view", "id" => $account->id]);
            }
        }
        if (count($account->requests) <= 0) {
            $table = $account->table;
            $account->delete();
            $existAccount = Account::find()->where(["table_id" => $table->id, "status" => 0])->all();
            if (empty($existAccount)) {
                $table->status = false;
                $table->save();
            }
            return $this->redirect(["table/index"]);
        }
        return $this->redirect(["account/view", 'id' => $account->id]);
    }

    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
