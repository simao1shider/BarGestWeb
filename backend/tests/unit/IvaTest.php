<?php namespace backend\tests;

use common\fixtures\IvaFixture;
use common\models\Iva;

class IvaTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    public function _fixtures()
    {
        return [
            'iva' => [
                'class' => IvaFixture::className(),
                'dataFile' => codecept_data_dir() . 'iva_data.php',
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
    public function testRate()
    {
        $iva = new Iva();

        $iva->rate = null;
        $this->assertFalse($iva->validate(["rate"]),"Não pode ser null");
        $iva->rate = "safdafagfafgef";
        $this->assertFalse($iva->validate(["rate"]),"Não pode ser texto");
        $iva->rate = 23.2;
        $this->assertFalse($iva->validate(["rate"]),"Não pode ser decimal");
        $iva->rate = 23;
        $this->assertFalse($iva->validate(["rate"]),"Não pode ser repetido");
        $iva->rate = 6;
        $this->assertTrue($iva->validate(["rate"]),"É valido");
    }

    public function testStatus(){
        $iva = new Iva();

        $iva->status = null;
        $this->assertFalse($iva->validate(["status"]),"Não pode ser null");
        $iva->status = "safdafagfafgef";
        $this->assertFalse($iva->validate(["status"]),"Não pode ser texto");
        $iva->status = 23.2;
        $this->assertFalse($iva->validate(["status"]),"Não pode ser decimal");
        $iva->status = 23;
        $this->assertFalse($iva->validate(["status"]),"Não pode ser numerico");
        $iva->status = true;
        $this->assertTrue($iva->validate(["status"]),"True é valido");
        $iva->status = false;
        $this->assertTrue($iva->validate(["status"]),"False é valido");
    }

    public function testInputTrueValidation(){
        $this->tester->haveRecord('common\models\Iva',[
            'id'=>'2',
            'rate' => 2,
            'status' => Iva::ACTIVE,
        ]);
        $this->tester->seeRecord('common\models\Iva', array('id' => '2'));
    }
}