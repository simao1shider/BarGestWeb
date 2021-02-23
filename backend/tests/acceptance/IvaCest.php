<?php namespace backend\tests\acceptance;
use backend\tests\AcceptanceTester;

class IvaCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryCreate(AcceptanceTester $I)
    {
        $this->startIva($I);
        $I->dontSee("55%");
        $I->click("Criar");
        $I->seeInTitle("Criar Iva");
        $I->fillField('input[name="Iva[rate]"]', '55');
        $I->click("Guardar");
        $I->wait(2);
        $I->seeInTitle("Ivas");
        $I->see("55%");
    }

    protected function login(AcceptanceTester $I)
    {
        $I->see("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->fillField('input[name="LoginForm[password]"]', 'admin');
        $I->click('button[name="login-button"]');
        $I->wait(2);
        $I->dontSee("Incorrect username or password.");
    }

    protected function startIva(AcceptanceTester $I)
    {
        $I->amOnPage("iva/index");
        $this->login($I);
        $I->amOnPage("iva/index");
        $I->wait(2);
        $I->seeInTitle("Ivas");
    }
}
