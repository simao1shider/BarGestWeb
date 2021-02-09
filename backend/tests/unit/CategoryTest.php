<?php namespace backend\tests;

use common\fixtures\CategoryFixture;
use common\models\Category;

class CategoryTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    public function _fixtures()
    {
        return [
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
        $category = new Category();

        $category->name=null;
        $this->assertFalse($category->validate(["name"]),"O nome não pode ser nulo");
        $category->name="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($category->validate(["name"]),"O nome não pode conter mais de 255 carateres");
        $category->name="Vinhos";
        $this->assertFalse($category->validate(["name"]),"O nome não pode ser estar repetido");
        $category->name=1;
        $this->assertFalse($category->validate(["name"]),"O nome não pode ser numero");
        $category->name="unitTest";
        $this->assertTrue($category->validate(["name"]),"O nome unitTest é valido");
    }

    public function testStatus()
    {
        $category = new Category();

        $category->status=null;
        $this->assertFalse($category->validate(["status"]),"O status não pode ser nulo");
        $category->status="aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
        $this->assertFalse($category->validate(["status"]),"O nome não pode ser texto");
        $category->status=3;
        $this->assertFalse($category->validate(["status"]),"O nome não pode ser numero");
        $category->status=true;
        $this->assertTrue($category->validate(["status"]),"O nome unitTest é valido");
        $category->status=false;
        $this->assertTrue($category->validate(["status"]),"O nome unitTest é valido");
    }

    public function testRecover(){
        $category = Category::findOne(2);
        $this->tester->seeRecord('common\models\Category', array('name' => 'Sumos','status'=>Category::STATUS_DELETED));
        $category->recover();
        $this->tester->seeRecord('common\models\Category', array('name' => 'Sumos','status'=>Category::STATUS_ACTIVE));
    }

    public function testInputTrueValidation(){
        $this->tester->haveRecord('common\models\Category',[
            'id'=>3,
            'name' => "Aguas",
            'status' => Category::STATUS_ACTIVE,
        ]);
        $this->tester->seeRecord('common\models\Category', array('id' => 3));
    }
}