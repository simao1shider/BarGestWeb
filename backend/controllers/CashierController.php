<?php

namespace backend\controllers;

use Yii;
use common\models\Cashier;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
                        'actions' => ['index','view','create','update','fecharcaixa','abrircaixa'],
                        'roles' => ['admin'],
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

    /**
     * Lists all Cashier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cashiers = Cashier::find()->orderBy(['date' => SORT_DESC])->all();
        return $this->render('index', [
            'cashiers' => $cashiers
        ]);
    }

    /**
     * Displays a single Cashier model.
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
     * Creates a new Cashier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cashier();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cashier model.
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

    public function actionFecharcaixa(){
        
        $caixa = Cashier::find()->where(['status' => 1])->one();
        $caixa->status = 0;
        $caixa->save();

        $cashiers = Cashier::find()->all();
        return $this->redirect(['cashier/index']);
    }

    public function actionAbrircaixa(){
        $caixan = Cashier::find()->where(['status' => 1])->count();
        $caixad = Cashier::find()->where(['date' => date("Y/m/d")])->count();

        if($caixad > 0){
            return $this->render('error',[
                'message' => 'Já foi aberta uma caixa hoje!'
            ]);
        }
        if($caixan == 0){
            $caixa = new Cashier();
            $caixa->status = 1;
            $caixa->total = 0;
            $caixa->date = date("Y/m/d");
            $caixa->save();
        }
        else{
            return $this->render('error',[
                'message' => 'Uma caixa já está aberta, apenas pode ter uma caixa aberta!'
            ]);
        }

        $cashiers = Cashier::find()->all();
        return $this->redirect(['cashier/index']);
    }


    protected function findModel($id)
    {
        if (($model = Cashier::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
