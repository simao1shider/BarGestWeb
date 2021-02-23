<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\Category;

class CategoryCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryNotCategories(FunctionalTester $I)
    {
        $this->startCategory($I);
        $I->dontSee("Vinhos");
        $I->see("Não existem categorias");

    }

    public function tryActiveCategories(FunctionalTester $I)
    {
       $I->haveRecord('common\models\Category',[
            'id'=>1,
            'name' => "Vinhos",
            'status' => Category::STATUS_ACTIVE,
        ]);
        $this->startCategory($I);
        $I->see("Vinhos");
        $I->see("Não existem categorias");
    }

    public function tryDeletedCategories(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Category',[
            'id'=>1,
            'name' => "Vinhos",
            'status' => Category::STATUS_DELETED,
        ]);
        $this->startCategory($I);
        $I->see("Não existem categorias");
        $I->see("Vinhos");
    }

    public function tryBothCategories(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Category',[
            'id'=>1,
            'name' => "Vinhos",
            'status' => Category::STATUS_ACTIVE,
        ]);
        $I->haveRecord('common\models\Category',[
            'id'=>2,
            'name' => "Sumos",
            'status' => Category::STATUS_DELETED,
        ]);
        $this->startCategory($I);
        $I->dontSee("Não existem categorias");
        $I->see("Sumos");
        $I->see("Vinhos");
    }

    public function tryCreateCategories(FunctionalTester $I)
    {
        $this->startCategory($I);
        $I->see("Não existem categorias");
        $I->dontSee("Vinhos");
        $I->click("Criar");
        $I->seeInTitle("Criar Categoria");
        $I->fillField('input[name="Category[name]"]', 'Vinhos');
        $I->click("Criar");
        $I->seeInTitle("Categorias");
        $I->see("Não existem categorias");
        $I->see("Vinhos");
    }
    public function tryEditCategories(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Category',[
            'id'=>1,
            'name' => "Vinhos",
            'status' => Category::STATUS_ACTIVE,
        ]);
        $this->startCategory($I);
        $I->see("Não existem categorias");
        $I->see("Vinhos");
        $I->dontSee("Sumos");
        $I->click(['class' => 'btn-outline-secondary']);
        $I->seeInTitle("Vinhos");
        $I->fillField('input[name="Category[name]"]', 'Sumos');
        $I->click("Guardar");
        $I->seeInTitle("Categorias");
        $I->see("Não existem categorias");
        $I->dontSee("Vinhos");
        $I->see("Sumos");

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
}
