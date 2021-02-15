<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;

class TableCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryCreate(AcceptanceTester $I)
    {
        $I->amOnPage("table/index");
        $this->login($I);
        $I->amOnPage("table/index");
        $I->seeInTitle("Mesas");
        $I->click("Criar Mesa");
        $I->seeInTitle("Criar Mesa");
        $I->fillField('input[name="Table[number]"]','404');
        $I->click('button[type="submit"]');
        $I->wait(2);
        $I->seeInTitle("Mesas");
        $I->see("Mesa 404");
    }

    public function trySeeTableAccounts(AcceptanceTester $I)
    {
        $I->amOnPage("table/index");
        $this->login($I);
        $I->amOnPage("table/index");
        $I->seeInTitle("Mesas");
        $I->click("Mesa 404");
        $I->wait(2);
        $I->seeInTitle("Contas");
        $I->see("Não exitem contas");
    }

    protected function login(AcceptanceTester $I){
        $I->seeInTitle("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]','admin');
        $I->fillField('input[name="LoginForm[password]"]','admin');
        $I->wait(2);
        $I->click('button[name="login-button"]');
        $I->wait(2);
        $I->dontSee("Incorrect username or password.");
    }
}
