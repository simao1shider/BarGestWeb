<?php namespace backend\tests;

use common\fixtures\CategoryFixture;
use common\fixtures\IvaFixture;
use common\fixtures\ProductFixture;
use common\models\Product;

class ProductTest extends \Codeception\Test\Unit
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
            'product' => [
                'class' => ProductFixture::className(),
                'dataFile' => codecept_data_dir() . 'product_data.php',
            ],
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php',
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
        $product= new Product();

        $product->name=null;
        $this->assertFalse($product->validate(["name"]),"O nome não pode ser nulo");
        $product->name="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($product->validate(["name"]),"O nome não pode conter mais de 255 carateres");
        $product->name=1;
        $this->assertFalse($product->validate(["name"]),"O nome não pode ser numero");
        $product->name="unitTest";
        $this->assertTrue($product->validate(["name"]),"O nome unitTest é valido");
    }

    public function testPrice()
    {
        $product= new Product();

        $product->price=null;
        $this->assertFalse($product->validate(["price"]),"O preço não pode ser nulo");
        $product->price="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($product->validate(["price"]),"O preço não pode ser texto");
        $product->price=-1;
        $this->assertFalse($product->validate(["price"]),"O preço não pode ser negativo");
        $product->price=10.1;
        $this->assertTrue($product->validate(["price"]),"O preço é valido");
        $product = Product::findOne(1);
        $this->assertEquals(3.0258,$product->calculateProductPrice(2,23));
    }

    public function testBasePrice()
    {
        $product= new Product();

        $product->base_price=null;
        $this->assertFalse($product->validate(["base_price"]),"O preço não pode ser nulo");
        $product->base_price="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($product->validate(["base_price"]),"O preço não pode ser texto");
        $product->base_price=-1;
        $this->assertFalse($product->validate(["base_price"]),"O preço não pode ser negativo");
        $product->base_price=10;
        $this->assertTrue($product->validate(["base_price"]),"O preço é valido");
    }

    public function testProfitMargin()
    {
        $product= new Product();

        $product->profit_margin=null;
        $this->assertFalse($product->validate(["profit_margin"]),"O preço não pode ser nulo");
        $product->profit_margin="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($product->validate(["profit_margin"]),"O preço não pode ser texto");
        $product->profit_margin=-1;
        $this->assertFalse($product->validate(["profit_margin"]),"O preço não pode ser negativo");
        $product->profit_margin=1.10;
        $this->assertFalse($product->validate(["profit_margin"]),"O preço não pode ser decimal");
        $product->profit_margin=10;
        $this->assertTrue($product->validate(["profit_margin"]),"O preço é valido");
    }

    public function testStatus()
    {
        $product= new Product();

        $product->status=null;
        $this->assertFalse($product->validate(["status"]),"O status não pode ser nulo");
        $product->status="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($product->validate(["status"]),"O nome não pode ser texto");
        $product->status=3;
        $this->assertFalse($product->validate(["status"]),"O status não pode ser numero");
        $product->status=true;
        $this->assertTrue($product->validate(["status"]),"O status true é valido");
        $product->status=false;
        $this->assertTrue($product->validate(["status"]),"O nome false é valido");
    }

    public function testRecover()
    {
        $product = Product::findOne(1);
        $this->tester->seeRecord('common\models\Product', array('name' => 'rose','status'=>Product::STATUS_DELETED));
        $product->recover();
        $this->tester->seeRecord('common\models\Product', array('name' => 'rose','status'=>Product::STATUS_ACTIVE));
    }

    public function testInputTrueValidation()
    {
        $this->tester->haveRecord('common\models\Product',[
            'id'=>2,
            'name'=>'cockburns',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>Product::STATUS_DELETED,
            'iva_id'=>1
        ]);
        $this->tester->seeRecord('common\models\Product', array('id' => 2));
    }
}