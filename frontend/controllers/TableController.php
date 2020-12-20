<?php

namespace frontend\controllers;

use Yii;
use common\models\Table;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view','create'],
                        'roles' => ['employee'],
                    ],
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


    public function actionView($id)
    {
        $model=Table::findOne($id);
        if(isset($_GET['CR'])){
            if(Yii::$app->user->can("createRequest"))
            {
                return $this->render('view', [
                    'model' => $model,
                ]);
            }else{
                throw new HttpException(403,"Não tem premisões para aceder a este ficheiro");
            }
        }
        else{
            $AccountQuantity=count($model->accounts);
            if($AccountQuantity != 1){
                $model = Table::findOne($id);
                return $this->render('view', [
                    'model' => $model,
                ]);
            }
            else{
                return $this->redirect(['account/view', 'id' => $model->accounts[0]->id]);

            }
        }
    }


    public function actionCreate()
    {
        $model = new Table();

        if(isset($_POST["Table"])){
            $model->status=false;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Table::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
