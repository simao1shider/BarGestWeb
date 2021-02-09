<?php namespace backend\tests;

use common\fixtures\CashierFixture;
use common\models\Cashier;

class CashierTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
            'cashier' => [
                'class' => CashierFixture::className(),
                'dataFile' => codecept_data_dir() . 'cashier_data.php',
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
    public function testDate()
    {
        $cashier = new Cashier();
        $cashier->date = null;
        $this->assertFalse($cashier->validate(["date"]),"A data não pode ser nula");
        $cashier->date = "asfgreahsoghafdçi";
        $this->assertFalse($cashier->validate(["date"]),"A data não pode ser texto");
        $cashier->date = 12312;
        $this->assertFalse($cashier->validate(["date"]),"A data não pode ser numero");
        $cashier->date = date("Y-m-d h:i:s");
        $this->assertFalse($cashier->validate(["date"]),"A data não pode ter tempo");
        $cashier->date = date("2020-11-30");
        $this->assertFalse($cashier->validate(["date"]),"A data não pode ser duplicado");
        $cashier->date = date("Y-m-d");
        $this->assertTrue($cashier->validate(["date"]),"A data valida");
    }

    public function testStatus(){
        $cashier = new Cashier();

        $cashier->status=null;
        $this->assertFalse($cashier->validate(["status"]),"O status não pode ser nulo");
        $cashier->status="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($cashier->validate(["status"]),"O nome não pode ser texto");
        $cashier->status=3;
        $this->assertFalse($cashier->validate(["status"]),"O status não pode ser numero");
        $cashier->status=true;
        $this->assertTrue($cashier->validate(["status"]),"O status true é valido");
        $cashier->status=false;
        $this->assertTrue($cashier->validate(["status"]),"O nome false é valido");
    }

    public function testTotal(){
        $cashier = new Cashier();

        $cashier->total=null;
        $this->assertFalse($cashier->validate(["total"]),"O status não pode ser nulo");
        $cashier->total="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($cashier->validate(["total"]),"O nome não pode ser texto");
        $cashier->total=-1;
        $this->assertFalse($cashier->validate(["total"]),"O nome não pode ser numero negativo");
        $cashier->total=10;
        $this->assertTrue($cashier->validate(["total"]),"O nome unitTest é valido");
    }

    public function testInputTrueValidation(){
        $this->tester->haveRecord('common\models\Cashier',[
            'id'=>2,
            'date' => date("y-m-d"),
            'status' => Cashier::OPEN,
            'total'=>20
        ]);
        $this->tester->seeRecord('common\models\Cashier', array('id' => 2));
    }
}