<?php

namespace backend\controllers;

use common\models\Product;
use Yii;
use common\models\Category;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete','active_category','active_product'],
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            "activeCategories" => Category::find()->where(['status' => Category::STATUS_ACTIVE])->all(),
            "deletedCategories" => Category::find()->where(['status' => Category::STATUS_DELETED])->all(),
        ]);
    }

    public function actionActive_category($id){
        $category=Category::findOne($id);
        try {
            foreach ($category->products as $product) {
                $product->status = Product::STATUS_ACTIVE;
                $product->save();
            }
        }
        catch (Exception $exception){
            throw new HttpException(500,"Não foi possivel ativar um produto\n Exp:".$exception);
        }
        finally {
            $category->status=Category::STATUS_ACTIVE;
            $category->save();
        }
       $this->redirect(["index"]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'category' => $this->findModel($id),
            'products' => Product::find()->where(['category_id' => $id])->all(),
        ]);
    }

    public function actionActive_product($id){
        $product = Product::findOne($id);
        $category = $product->category;
        $category->status=Category::STATUS_ACTIVE;
        if($category->save()){
            $product->status=Product::STATUS_ACTIVE;
            $product->save();
        }
        return $this->redirect(["view","id"=>$category->id]);
    }

    /**
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $model->status = true;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $category = $this->findModel(Yii::$app->request->post("id"));
        $category->status = false;
        foreach ($category->products as $product) {
            $product->status = false;
            $product->save();
        }
        $category->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
