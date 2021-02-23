<?php

namespace backend\controllers;

use Yii;
use common\models\Iva;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * IvaController implements the CRUD actions for Iva model.
 */
class IvaController extends Controller
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
                        'actions' => ['index', 'create', 'delete', 'reactivate'],
                        'roles' => ['admin']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Iva models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'ivas_act' => Iva::find()->where(["status" => Iva::ACTIVE])->all(),
            'ivas_inact' => Iva::find()->where(["status" => Iva::INACTIVE])->all(),
        ]);
    }

    /**
     * Creates a new Iva model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Iva();
        $model->status = 1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Iva model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $iva = $this->findModel($id);
        $iva->status = 0;
        $iva->save();

        return $this->redirect(['index']);
    }

    /**
     * get back an existing Iva model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionReactivate($id)
    {
        $iva = $this->findModel($id);
        $iva->status = 1;
        $iva->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Iva model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Iva the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Iva::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
