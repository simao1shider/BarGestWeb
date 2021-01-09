<?php namespace frontend\tests;

use common\fixtures\AccountFixture;
use common\fixtures\CategoryFixture;
use common\fixtures\EmployeeFixture;
use common\fixtures\ProductFixture;
use common\fixtures\TableFixture;
use common\fixtures\UserFixture;
use common\models\Employee;
use common\models\Request;

class RequestTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
            'employee' => [
                'class' => EmployeeFixture::className(),
                'dataFile' => codecept_data_dir() . 'employee_data.php',
            ],
            'table' => [
                'class' => TableFixture::className(),
                'dataFile' => codecept_data_dir() . 'table_data.php',
            ],
            'account' => [
                'class' => AccountFixture::className(),
                'dataFile' => codecept_data_dir() . 'account_data.php',
            ],
        ];
    }

    protected function _before()
    {
    }

    // tests
    public function testRequestDatetimeValidation()
    {
        $model = new Request();
        $model->dateTime= 000000000000000000000;
        $this->assertFalse($model->validate(["dateTime"]),"A data não pode ser integer");
        $model->dateTime="aaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($model->validate(["dateTime"]),"A data não pode ser texto");
        $model->dateTime="";
        $this->assertFalse($model->validate(["dateTime"]),"A data não pode ser vazia");
        $model->dateTime="2020-12-12";
        $this->assertFalse($model->validate(["dateTime"]),"A data não pode ser do tipo texto");
        $model->dateTime=date("2020-12-12 12:12:12");
        $this->assertTrue($model->validate(["dateTime"]),"A ");
        $model->dateTime=date("12-12-2020 12:12:12");
        $this->assertFalse($model->validate(["dateTime"]));
        $model->dateTime=date("2020-29-12 12:12:12");
        $this->assertFalse($model->validate(["dateTime"]));
        $model->dateTime=date("2020-29-12 30:20:12");
        $this->assertFalse($model->validate(["dateTime"]));
        $model->dateTime=date("2020-29-12");
        $this->assertFalse($model->validate(["dateTime"]));

    }

    public function testRequestStatusValidation(){
        $model = new Request();
        $model->status = "aaaaaaaaaaaaa";
        $this->assertFalse($model->validate(["status"]));
        $model->status = "";
        $this->assertFalse($model->validate(["status"]));
        $model->status = null;
        $this->assertFalse($model->validate(["status"]));
        $model->dateTime=date("2020-12-12 12:12:12");
        $this->assertFalse($model->validate(["status"]));
        $model->status = -1;
        $this->assertFalse($model->validate(["status"]));
        $model->status = 0;
        $this->assertTrue($model->validate(["status"]));
        $model->status = 4;
        $this->assertTrue($model->validate(["status"]));
        $model->status = 5;
        $this->assertFalse($model->validate(["status"]));
    }

    public function testRequestAccountidValidation(){
        $model = new Request();
        $model->account_id = "aaaaaaaaaaaaa";
        $this->assertFalse($model->validate(["account_id"]));
        $model->account_id = "";
        $this->assertFalse($model->validate(["account_id"]));
        $model->account_id = null;
        $this->assertFalse($model->validate(["account_id"]));
        $model->account_id=date("2020-12-12 12:12:12");
        $this->assertFalse($model->validate(["account_id"]));
        $model->account_id = -1;
        $this->assertFalse($model->validate(["account_id"]));
        $model->account_id = 1;
        $this->assertTrue($model->validate(["account_id"]));
        $model->account_id = 4;
        $this->assertFalse($model->validate(["account_id"]));
        $model->account_id = 200;
        $this->assertFalse($model->validate(["account_id"]));
    }

    public function testRequestEmployeeidValidation(){
        $model = new Request();
        $model->employee_id = "aaaaaaaaaaaaa";
        $this->assertFalse($model->validate(["employee_id"]));
        $model->employee_id = "";
        $this->assertFalse($model->validate(["employee_id"]));
        $model->employee_id = null;
        $this->assertFalse($model->validate(["employee_id"]));
        $model->employee_id=date("2020-12-12 12:12:12");
        $this->assertFalse($model->validate(["employee_id"]));
        $model->employee_id = -1;
        $this->assertFalse($model->validate(["employee_id"]));
        $model->employee_id = 1;
        $this->assertTrue($model->validate(["employee_id"]));
        $model->employee_id = 4;
        $this->assertFalse($model->validate(["employee_id"]));
        $model->employee_id = 200;
        $this->assertFalse($model->validate(["employee_id"]));
    }

    public function testRequestInputTrueValidation()
    {
        $this->tester->haveRecord('common\models\Request',[
            'id'=>'1',
            'dateTime' => date("Y-m-d h:i:s"),
            'status' => '0',
            'account_id' =>'1',
            'employee_id' => '1',
        ]);
        $this->tester->seeRecord('common\models\Request', array('id' => '1'));
    }

}