<?php namespace frontend\tests;

use common\fixtures\CashierFixture;
use common\fixtures\TableFixture;
use common\models\Account;

class AccountTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'cashier' => [
                'class' => CashierFixture::className(),
                'dataFile' => codecept_data_dir() . 'cashier_data.php',
            ],
            'table' => [
                'class' => TableFixture::className(),
                'dataFile' => codecept_data_dir() . 'table_data.php',
            ],

        ];
    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testName()
    {
        $account = new Account();
        $account->name = null;
        $this->assertFalse($account->validate(["name"]), "Não pode ser nullo");
        $account->name = 1;
        $this->assertFalse($account->validate(["name"]), "Não pode ser numero");
        $account->name = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($account->validate(["name"]), "Não pode conter mais de 255 carateres");
        $account->name = "unit";
        $this->assertTrue($account->validate(["name"]), "Nome valido");
    }

    public function testDatetimeValidation()
    {
        $model = new Account();
        $model->dateTime = null;
        $this->assertFalse($model->validate(["dateTime"]), "A data não pode ser nulo");
        $model->dateTime = 000000000000000000000;
        $this->assertFalse($model->validate(["dateTime"]), "A data não pode ser integer");
        $model->dateTime = "aaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($model->validate(["dateTime"]), "A data não pode ser texto");
        $model->dateTime = "";
        $this->assertFalse($model->validate(["dateTime"]), "A data não pode ser vazia");
        $model->dateTime = "2020-12-12";
        $this->assertFalse($model->validate(["dateTime"]), "A data não pode ser do tipo texto");
        $model->dateTime = date("2020-12-12 12:12:12");
        $this->assertTrue($model->validate(["dateTime"]), "A ");
        $model->dateTime = date("12-12-2020 12:12:12");
        $this->assertFalse($model->validate(["dateTime"]));
        $model->dateTime = date("2020-29-12 12:12:12");
        $this->assertFalse($model->validate(["dateTime"]));
        $model->dateTime = date("2020-29-12 30:20:12");
        $this->assertFalse($model->validate(["dateTime"]));
        $model->dateTime = date("2020-29-12");
        $this->assertFalse($model->validate(["dateTime"]));

    }

    public function testNif()
    {
        $account = new Account();
        $account->nif = null;
        $this->assertFalse($account->validate(["nif"]), "Não pode ser nulo");
        $account->nif = "asdasd";
        $this->assertFalse($account->validate(["nif"]), "Não pode ser texto");
        $account->nif = 0;
        $this->assertTrue($account->validate(["nif"]), "Tem de ser numerico");
        $this->assertFalse($account->validateNif(000000100));
        $this->assertTrue($account->validateNif(261099957));

    }

    public function testStatusValidation()
    {
        $account = new Account();
        $account->status = null;
        $this->assertFalse($account->validate(["status"]), "Não pode ser nulo");
        $account->status = "asdasd";
        $this->assertFalse($account->validate(["status"]), "Não pode ser texto");
        $account->status = -1;
        $this->assertFalse($account->validate(["status"]), "Não pode ser negativo");
        $account->status = 2;
        $this->assertFalse($account->validate(["status"]), "Não pode ser negativo");
        $account->status = true;
        $this->assertTrue($account->validate(["status"]), "Pode ser true");
        $account->status = false;
        $this->assertTrue($account->validate(["status"]), "Pode ser false");
    }


    public function testNifValidation()
    {
        $account = new Account();
        $account->total = null;
        $this->assertFalse($account->validate(["total"]), "Não pode ser nulo");
        $account->total = "asdasd";
        $this->assertFalse($account->validate(["total"]), "Não pode ser texto");
        $account->total = -1;
        $this->assertFalse($account->validate(["total"]), "Não pode ser negativo");
        $account->total = 2;
        $this->assertTrue($account->validate(["total"]), "Pode ser numerico");

    }

    public function testInputTrueValidation()
    {
        $this->tester->haveRecord('common\models\Account', [
            'id' => '1',
            'name' => 'unit',
            'dateTime' => date("Y-m-d h:i:s"),
            'nif'=>0,
            'status' => false,
            'total' => 20,
            'table_id' => 1,
            'cashier_id' => 1,
        ]);
        $this->tester->seeRecord('common\models\Account', array('id' => '1'));
    }
}