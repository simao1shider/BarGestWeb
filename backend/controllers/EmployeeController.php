<?php

namespace backend\controllers;

use common\models\User;
use frontend\models\SignupForm;
use Yii;
use common\models\Employee;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $employee=Employee::find()->innerJoin("user","user.id=user_id")->where(["user.status"=>User::STATUS_ACTIVE])->all();
        return $this->render('index', [
            'employees'=>$employee,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $employee = new Employee();
        $signup = new SignupForm();
        if(isset($_POST["Employee"]) && isset($_POST["SignupForm"])) {
            $employeePost = Yii::$app->request->post("Employee");
            $signupPost=Yii::$app->request->post("SignupForm");
            $signup->username=$signupPost["username"];
            $signup->password= $signupPost["password"];
            $signup->email = $employeePost["email"];
            if($signup->signup()){
                $employee->user_id=User::find()
                    ->where(['id' => User::find()->max('id')])
                    ->one()->id;
                $employee->name=$employeePost["name"];
                $employee->email=$employeePost["email"];
                $employee->phone=$employeePost["phone"];
                $employee->birthDate=$employeePost["birthDate"];
                if ($employee->save()) {
                    return $this->redirect(['view', 'id' => $employee->id]);
                }
            }
        }
        return $this->render('create', [
            'employee' => $employee,
            'signup'=>$signup,
        ]);
    }

    /**
     * Updates an existing Employee model.
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
            'employee' => $model,
        ]);
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $employee=$this->findModel($id);
        $user=User::findOne($employee->user_id);
        $user->status=User::STATUS_DELETED;
        $user->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
