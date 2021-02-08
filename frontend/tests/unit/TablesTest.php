<?php namespace frontend\tests;

use common\fixtures\TableFixture;
use common\models\Table;

class TablesTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [

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
    public function testNumber()
    {
        $table = new Table();

        $table->number = "asdfsdf";
        $this->assertFalse($table->validate(["number"]),"Não poder conter letras");
        $table->number = date("Y-m-d h:i:s");
        $this->assertFalse($table->validate(["number"]),"Não pode ser data");
        $table->number = -1;
        $this->assertFalse($table->validate(["number"]),"Não pode ser negativo");
        $table->number = 1;
        $this->assertFalse($table->validate(["number"]),"Não pode existir");
        $table->number = 2;
        $this->assertTrue($table->validate(["number"]));
    }

    public function testStatus()
    {
        $table = new Table();

        $table->status = "asdasfsadf";
        $this->assertFalse($table->validate(["status"]),"Não poder conter letras");
        $table->status = date("Y-m-d h:i:s");
        $this->assertFalse($table->validate(["status"]),"Não pode ser data");
        $table->status = -1;
        $this->assertFalse($table->validate(["status"]),"Não pode ser negativo");
        $table->status = 3;
        $this->assertFalse($table->validate(["status"]),"Não pode existir");
        $table->status = 1;
        $this->assertTrue($table->validate(["status"]),"Pode inserir 1");
        $table->status = 0;
        $this->assertTrue($table->validate(["status"]),"Pode inserir 0");
        $table->status = true;
        $this->assertTrue($table->validate(["status"]),"Pode inserir true");
        $table->status = false;
        $this->assertTrue($table->validate(["status"]),"Pode inserir false");
    }

    public function testTableInputTrueValidation()
    {
        $this->tester->haveRecord('common\models\Table',[
            'id'=>'2',
            'number' => 2,
            'status' => false,
        ]);
        $this->tester->seeRecord('common\models\Table', array('id' => '2'));
    }
}