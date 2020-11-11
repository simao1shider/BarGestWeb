<?php

namespace frontend\controllers;

use common\models\Bill;
use Yii;
use common\models\Table;
use common\models\TableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TableController implements the CRUD actions for Table model.
 */
class TableController extends Controller
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
     * Lists all Table models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Table::find()->orderBy('number')->all();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Displays a single Table model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model=Bill::find()->where(["Tables_id"=>$id])->all();
        $BillsQuantity=count($model);
        if($BillsQuantity > 1){
           //redirect to bills
        }
        if($BillsQuantity == 0){
            $this->redirect("../table/index");
        }
        if($BillsQuantity == 1){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);

        }

    }

    /**
     * Creates a new Table model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Table();

        if(isset($_POST["Table"])){
            $model->status=false;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Finds the Table model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Table the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Table::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
