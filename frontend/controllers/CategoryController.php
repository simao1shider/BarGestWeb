<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use yii\web\Controller;
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
        $categories = Category::find()->where(["status"=>Category::STATUS_ACTIVE])->all();

        return $this->render('index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $products = Product::find()->where(["status"=>Product::STATUS_ACTIVE,"category_id"=>$id])->all();

        return $this->render('view', [
            'products' => $products,
        ]);
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
        if (($model = Category::find()->where(["status"=>Category::STATUS_ACTIVE,"id"=>$id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A categoria especificada não existe!');
    }
}
