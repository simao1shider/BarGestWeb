<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\CategoryFixture;
use common\fixtures\IvaFixture;
use common\fixtures\UserFixture;
use common\models\Category;

class ProductCest
{

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php',
            ],
            'iva' => [
                'class' => IvaFixture::className(),
                'dataFile' => codecept_data_dir() . 'iva_data.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryAccessByCategoryWithoutProduct(FunctionalTester $I)
    {
        $this->startCategory($I);
        $I->click("Vinhos");
        $I->seeInTitle("Vinhos");
        $I->see("Esta categoria não tem produtos");
    }


    public function tryAccessByCategoryWithProductActive(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Product',[
            'id'=>1,
            'name'=>'rose',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>\common\models\Product::STATUS_ACTIVE,
            'iva_id'=>1
        ]);
        $this->startCategory($I);
        $I->click("Vinhos");
        $I->seeInTitle("Vinhos");
        $I->see("rose");
    }

    public function tryAccessByCategoryWithProductDeleted(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Product',[
            'id'=>1,
            'name'=>'rose',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>\common\models\Product::STATUS_DELETED,
            'iva_id'=>1
        ]);
        $this->startCategory($I);
        $I->click("Vinhos");
        $I->seeInTitle("Vinhos");
        $I->see("rose");
    }

    public function tryNotProduct(FunctionalTester $I)
    {
        $this->startProduct($I);
        $I->dontSee("rose");
        $I->see("Não existem produtos");

    }

    public function tryActiveProduct(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Product',[
            'id'=>1,
            'name'=>'rose',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>\common\models\Product::STATUS_ACTIVE,
            'iva_id'=>1
        ]);
        $this->startProduct($I);
        $I->see("rose");
        $I->see("Não existem produtos");
    }

    public function tryDeletedProduct(FunctionalTester $I)
    {

        $I->haveRecord('common\models\Product',[
            'id'=>1,
            'name'=>'rose',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>\common\models\Product::STATUS_DELETED,
            'iva_id'=>1
        ]);
        $this->startProduct($I);
        $I->see("rose");
        $I->see("Não existem produtos");
    }

    public function tryBothProduct(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Product',[
            'id'=>1,
            'name'=>'rose',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>\common\models\Product::STATUS_ACTIVE,
            'iva_id'=>1
        ]);
        $I->haveRecord('common\models\Product',[
            'id'=>2,
            'name'=>'Porto',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>\common\models\Product::STATUS_DELETED,
            'iva_id'=>1
        ]);
        $this->startProduct($I);
        $I->dontSee("Não existem produtos");
        $I->see("rose");
        $I->see("Porto");
    }

    public function tryCreateProduct(FunctionalTester $I){
        $this->startProduct($I);
        $I->see("Não existem produtos");
        $I->dontSee("rose");
        $I->click("Criar");
        $I->seeInTitle("Criar Produto");
        $I->fillField('input[name="Product[name]"]', 'rose');
        $I->fillField('input[name="Product[base_price]"]', '2');
        $I->fillField('input[name="Product[profit_margin]"]', '23');
        $I->selectOption('select[name="Product[iva_id]"]',"23");
        $I->selectOption('select[name="Product[category_id]"]',"Vinhos");
        $I->click("Guardar");
        $I->seeInTitle("Produtos");
        $I->see("Não existem produtos");
        $I->see("rose");
    }

    public function tryCreateProductByCategory(FunctionalTester $I){
        $this->startCategory($I);
        $I->click("Vinhos");
        $I->seeInTitle("Vinhos");
        $I->dontSee("rose");
        $I->click("Criar");
        $I->seeInTitle("Criar Produto");
        $I->fillField('input[name="Product[name]"]', 'rose');
        $I->fillField('input[name="Product[base_price]"]', '2');
        $I->fillField('input[name="Product[profit_margin]"]', '23');
        $I->selectOption('select[name="Product[iva_id]"]',"23");
        $I->click("Guardar");
        $I->seeInTitle("Produtos");
        $I->see("Não existem produtos");
        $I->see("rose");
    }

    public function tryEditProduct(FunctionalTester $I){
        $I->haveRecord('common\models\Product',[
            'id'=>1,
            'name'=>'rose',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>\common\models\Product::STATUS_ACTIVE,
            'iva_id'=>1
        ]);
        $this->startProduct($I);
        $I->see("Não existem produtos");
        $I->see("rose");
        $I->click(['class' => 'btn-outline-secondary']);
        $I->seeInTitle("rose");
        $I->fillField('input[name="Product[name]"]', 'Tejo');
        $I->fillField('input[name="Product[base_price]"]', '2');
        $I->fillField('input[name="Product[profit_margin]"]', '23');
        $I->selectOption('select[name="Product[iva_id]"]',"23");
        $I->selectOption('select[name="Product[category_id]"]',"Vinhos");
        $I->click("Guardar");
        $I->seeInTitle("Tejo");
        $I->see("Detalhes");
        $I->see("Tejo");
        $I->amOnPage(["product/index"]);
        $I->see("Tejo");
        $I->dontSee("rose");
    }

    public function tryDetailsProduct(FunctionalTester $I){
        $I->haveRecord('common\models\Product',[
            'id'=>1,
            'name'=>'rose',
            'price'=>2,
            'base_price'=>1,
            'profit_margin'=>2,
            'category_id'=>1,
            'status'=>\common\models\Product::STATUS_ACTIVE,
            'iva_id'=>1
        ]);
        $this->startProduct($I);
        $I->see("Não existem produtos");
        $I->see("rose");
        $I->click('rose');
        $I->seeInTitle("rose");
        $I->seeInTitle("rose");
        $I->see("Detalhes");
        $I->see("rose");
        $I->see("1.00€");
        $I->see("2.00€");
        $I->see("2%");
        $I->see("23%");
        $I->see("Vinhos");

    }

    protected function login(FunctionalTester $I)
    {
        $I->see("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->fillField('input[name="LoginForm[password]"]', 'admin');
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }

    protected function startCategory(FunctionalTester $I)
    {
        $I->amOnPage(["category/index"]);
        $this->login($I);
        $I->amOnPage(["category/index"]);
        $I->seeInTitle("Categorias");
    }

    protected function startProduct(FunctionalTester $I)
    {
        $I->amOnPage(["product/index"]);
        $this->login($I);
        $I->amOnPage(["product/index"]);
        $I->seeInTitle("Produtos");
    }
}
