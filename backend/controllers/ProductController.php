<?php

namespace backend\controllers;

use common\models\Category;
use common\models\Iva;
use Yii;
use common\models\Product;
use common\models\ProductySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'actions' => ['index','view','create','update','delete'],
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'products'=>Product::find()->where(["status"=>true])->all()
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($categoryId=null)
    {
        $model = new Product();

        if(isset($_POST["Product"])){
            if($categoryId!=null)
                $model->category_id=$categoryId;
            $model->status=true;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        }

        if($categoryId==null)
        {
            return $this->render('create', [
                'ivas'=>Iva::find()->where(["status"=>true])->all(),
                'categories'=>Category::find()->where(["status"=>true])->all(),
                'product' => $model,
            ]);
        }
        else{
            return $this->render('create', [
                'ivas'=>Iva::find()->where(["status"=>true])->all(),
                'product' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $product = $this->findModel($id);

        if ($product->load(Yii::$app->request->post()) && $product->save()) {
            return $this->redirect(['view', 'id' => $product->id]);
        }

        return $this->render('update', [
            'product' => Product::find()->where(["status"=>true,"id"=>$id])->one(),
            'ivas'=>Iva::find()->where(["status"=>true])->all(),
            'categories'=>Category::find()->where(["status"=>true])->all(),
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $product=$this->findModel($id);
        $product->status=false;
        $product->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
