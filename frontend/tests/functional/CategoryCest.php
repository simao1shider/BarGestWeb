<?php namespace frontend\tests\functional;
use common\fixtures\CategoryFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

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
        $I->amOnPage(["category/index"]);
        $this->login($I);
        $I->amOnPage(["category/index"]);
        $I->seeInTitle("Categorias");
        $I->see("Não existem categorias");
    }

    public function tryWithCategories(FunctionalTester $I)
    {
        $I->haveFixtures(["category" => [
            'class' => CategoryFixture::className(),
            'dataFile' => codecept_data_dir() . 'category_data.php',
        ]]);
        $I->amOnPage(["category/index"]);
        $this->login($I);
        $I->amOnPage(["category/index"]);
        $I->seeInTitle("Categorias");
        $I->see("Vinhos");
    }


    protected function login(FunctionalTester $I){
        $I->seeInTitle("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]','admin');
        $I->fillField('input[name="LoginForm[password]"]','admin');
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }
}
