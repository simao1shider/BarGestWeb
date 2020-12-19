<?php

use common\models\Employee;
use common\models\User;
use frontend\models\SignupForm;
use yii\db\Migration;

/**
 * Class m201214_194322_init_rbac
 */
class m201214_194322_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

       // $rule = new common\models\UserGroupRule;
        //$auth->add($rule);

        $createShowRequest= $auth->createPermission("showCreateRequest");
        $createShowRequest->description = 'Show view create a request in frontend';
        $auth->add($createShowRequest);


        $createRequest = $auth->createPermission('createRequest');
        $createRequest->description = 'Create a request in frontend';
        $auth->add($createRequest);

        $updateShowRequest = $auth->createPermission('showUpdateRequest');
        $updateShowRequest->description = 'Show view update request in frontend';
        $auth->add($updateShowRequest);

        $updateRequest = $auth->createPermission('updateRequest');
        $updateRequest->description = 'Update request in frontend';
        $auth->add($updateRequest);

        $listRequest = $auth->createPermission('listRequest');
        $listRequest->description = 'List request in frontend';
        $auth->add($listRequest);

        $deleteRequest = $auth->createPermission('deleteRequest');
        $deleteRequest->description = 'Delete request in frontend';
        $auth->add($deleteRequest);

        $changeStatusRequest = $auth->createPermission('changeStatusRequest');
        $changeStatusRequest->description = 'Change status of request in frontend';
        $auth->add($changeStatusRequest);

        $employee = $auth->createRole('employee');
        //$employee->ruleName = $rule->name;
        $counter = $auth->createRole('counter');
        //$counter->ruleName = $rule->name;
        $admin = $auth->createRole('admin');
        //$admin->ruleName = $rule->name;

        $auth->add($employee);
        $auth->add($counter);
        $auth->add($admin);

        $auth->addChild($employee, $updateRequest);
        $auth->addChild($employee,$updateShowRequest);
        $auth->addChild($employee,$deleteRequest);
        $auth->addChild($employee,$changeStatusRequest);
        $auth->addChild($employee, $createShowRequest);
        $auth->addChild($employee, $createRequest);
        //$auth->addChild($employee,$listRequest);
        $auth->addChild($counter,$listRequest);
        $auth->addChild($counter, $employee);
        $auth->addChild($admin, $counter);
        $auth->addChild($admin, $employee);


        $transaction = $this->getDb()->beginTransaction();
        $newuser = \Yii::createObject([
            'class'    => User::className(),
            'scenario' => 'create',
            'email'    => 'admin@example.com',
            'username' => 'admin',
            'password' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'verification_token' => Yii::$app->security->generateRandomString() . '_' . time(),
        ]);
        if (!$newuser->save(false)) {
            $transaction->rollBack();
            return false;
        }
        $newemployee = \Yii::createObject([
            'class'    => Employee::className(),
            'scenario' => 'create',
            'email'    => 'admin@example.com',
            'name' => 'admin',
            'phone' => 0000000,
            'birthDate' => date("Y-m-d H:i:s"),
            'user_id' =>$newuser->id
        ]);
        if (!$newemployee->save(false)) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();


        $auth->assign($admin, $newuser->id);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        $transaction = $this->getDb()->beginTransaction();
        $user = User::findOne(['username'=>'admin']);
        if (!$user->delete()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201214_194322_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
