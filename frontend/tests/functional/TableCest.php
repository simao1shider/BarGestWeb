<?php namespace frontend\tests\functional;
use common\fixtures\TableFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class TableCest
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
    public function tryNoTables(FunctionalTester $I)
    {
        $I->amOnPage(["table/index"]);
        $this->login($I);
        $I->amOnPage(["table/index"]);
        $I->see("Não existem mesas");
    }

    public function tryWithTables(FunctionalTester $I)
    {
        $I->haveFixtures(["table" => [
            'class' => TableFixture::className(),
            'dataFile' => codecept_data_dir() . 'table_data.php',
        ]]);
        $I->amOnPage(["table/index"]);
        $this->login($I);
        $I->amOnPage(["table/index"]);
        $I->see("Mesa 1");
    }

    public function tryCreateTable(FunctionalTester $I)
    {
        $I->amOnPage(["table/index"]);
        $this->login($I);
        $I->amOnPage(["table/index"]);
        $I->click("Criar Mesa");
        $I->seeInTitle("Criar Mesa");
        $I->fillField('input[name="Table[number]"]','1');
        $I->click('button[type="submit"]');
        $I->seeInTitle("Mesas");
        $I->see("Mesa 1");
    }



    protected function login(FunctionalTester $I){
        $I->seeInTitle("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]','admin');
        $I->fillField('input[name="LoginForm[password]"]','admin');
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }
}
