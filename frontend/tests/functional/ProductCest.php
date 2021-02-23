<?php namespace frontend\tests\functional;
use common\fixtures\CategoryFixture;
use common\fixtures\ProductFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class ProductCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
            "category" => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php',
            ]
        ];
    }


    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryNoProduct(FunctionalTester $I)
    {
        $I->amOnPage(["category/index"]);
        $this->login($I);
        $I->amOnPage(["category/index"]);
        $I->seeInTitle("Categorias");
        $I->see("Vinhos");
        $I->click("Vinhos");
        $I->seeInTitle("Vinhos");
        $I->see("Esta categoria não tem produtos");
    }

    public function tryWithProduct(FunctionalTester $I)
    {
        $I->haveFixtures(["product" => [
            'class' => ProductFixture::className(),
            'dataFile' => codecept_data_dir() . 'product_data.php',
        ]]);
        $I->amOnPage(["category/index"]);
        $this->login($I);
        $I->amOnPage(["category/index"]);
        $I->seeInTitle("Categorias");
        $I->see("Vinhos");
        $I->click("Vinhos");
        $I->seeInTitle("Vinhos");
        $I->see("Ice Tea");
    }


    protected function login(FunctionalTester $I){
        $I->seeInTitle("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]','admin');
        $I->fillField('input[name="LoginForm[password]"]','admin');
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }
}
