<?php

namespace backend\controllers;

use api\modules\v1\controllers\ProductstobepaidController;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\ProductsPaid;
use common\models\ProductsToBePaid;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $lastyear = date("Y") - 1;
        $thisyear = date("Y");
        $profitlastYearr = ProductsPaid::find()
            ->select("SUM(product.profit_margin * product.base_price * quantity) as quantity, MONTH(request.dateTime) as request_id")
            ->where("YEAR(request.dateTime) = '" . $lastyear . "'")
            ->groupBy("MONTH(request.dateTime)")
            ->innerJoin("request", "request_id = request.id")
            ->innerJoin("product", "product_id = product.id")
            ->all();

        $profitthisYearr = ProductsPaid::find()
            ->select("SUM(product.profit_margin * product.base_price * quantity) as quantity, MONTH(request.dateTime) as request_id")
            ->where("YEAR(request.dateTime) = '" . $thisyear . "'")
            ->groupBy("MONTH(request.dateTime)")
            ->innerJoin("request", "request_id = request.id")
            ->innerJoin("product", "product_id = product.id")
            ->all();

        $sellslastYearr = ProductsPaid::find()
            ->select("SUM(quantity * product.price)  as quantity, MONTH(request.dateTime) as request_id")
            ->where("YEAR(request.dateTime) = '" . $lastyear . "'")
            ->groupBy("MONTH(request.dateTime)")
            ->innerJoin("request", "request_id = request.id")
            ->innerJoin("product", "product_id = product.id")
            ->all();

        $sellsthisYearr = ProductsPaid::find()
            ->select("SUM(quantity * product.price)  as quantity, MONTH(request.dateTime) as request_id")
            ->where("YEAR(request.dateTime) = '" . $thisyear . "'")
            ->groupBy("MONTH(request.dateTime)")
            ->innerJoin("request", "request_id = request.id")
            ->innerJoin("product", "product_id = product.id")
            ->all();

        for ($i = 0; $i < 12; $i++) {
            $profitlastYear[$i] = new ProductsPaid();
            $profitlastYear[$i]->quantity = 0;
            $profitthisYear[$i] = new ProductsPaid();
            $profitthisYear[$i]->quantity = 0;
            $sellslastYear[$i] = new ProductsPaid();
            $sellslastYear[$i]->quantity = 0;
            $sellsthisYear[$i] = new ProductsPaid();
            $sellsthisYear[$i]->quantity = 0;
        }

        foreach ($profitlastYearr as $item) {
            $item->quantity = $item->quantity * 0.01;
            $profitlastYear[$item->request_id - 1] = $item;
        }

        foreach ($profitthisYearr as $item) {
            $item->quantity = $item->quantity * 0.01;
            $profitthisYear[$item->request_id - 1] = $item;
        }

        foreach ($sellslastYearr as $item) {
            $sellslastYear[$item->request_id - 1] = $item;
        }

        foreach ($sellsthisYearr as $item) {
            $sellsthisYear[$item->request_id - 1] = $item;
        }

        return $this->render('index', [
            'profitlastYear' => $profitlastYear,
            'profitthisYear' => $profitthisYear,
            'sellslastYear' => $sellslastYear,
            'sellsthisYear' => $sellsthisYear,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
