<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Product;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','view'],
                        'roles' => ['employee'],
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


    public function actionIndex()
    {
        $categories = Category::find()->where(["status"=>Category::STATUS_ACTIVE])->all();

        return $this->render('index', [
            'categories' => $categories,
        ]);
    }


    public function actionView($id)
    {
        $products = Product::find()->where(["status"=>Product::STATUS_ACTIVE,"category_id"=>$id])->all();

        return $this->render('view', [
            'products' => $products,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Category::find()->where(["status"=>Category::STATUS_ACTIVE,"id"=>$id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('A categoria especificada não existe!');
    }
}
