<?php

namespace frontend\controllers;

use common\models\Bill;
use common\models\Product;
use common\models\Table;
use frontend\models\RequestForm;
use Yii;
use common\models\Request;
use common\models\RequestSearch;
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
        $model= new RequestForm();
        $request=Yii::$app->request;
        if($request->isPost)
        {
            $bill = Bill::find()->where(["Tables_id"=>$request->post("RequestForm")['tableNumber']]);

            if(!$bill->exists()){
                $bill = new Bill();
                $bill->dateTime=date('Y-m-d H:i:s');
                $bill->status=1;
                $bill->total=0;
                $bill->Tables_id=$request->post("RequestForm")['tableNumber'];
                $bill->Employees_id=1;
                $bill->Cashiers_id=1;
                $bill->save();
            }
            else{
                $bill=$bill->one();
            }
            $model = new Request();
            $model->dateTime=date('Y-m-d H:i:s');
            $model->status=1;
            $model->Bills_id=$bill->id;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $tables = Table::find()->orderBy('number')->all();
        return $this->render('create', [
            'tables' => $tables,
            'model' => $model,
        ]);
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
