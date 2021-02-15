<?php namespace backend\tests\acceptance;
use backend\tests\AcceptanceTester;

class CategoryCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryCreate(AcceptanceTester $I)
    {
        $I->amOnPage("category/index");
        $this->login($I);
        $I->amOnPage("category/index");
        $I->seeInTitle("Categorias");
        $I->click("Criar");
        $I->wait(2);
        $I->seeInTitle("Criar Categoria");
        $I->fillField('input[name="Category[name]"]', 'Acceptance test');
        $I->click("Criar");
        $I->wait(2);
        $I->seeInTitle("Categorias");
        $I->see("Acceptance test");
    }

    public function tryEdit(AcceptanceTester $I)
    {
        $I->amOnPage("category/index");
        $this->login($I);
        $I->amOnPage("category/index");
        $I->seeInTitle("Categorias");
        $I->see("Acceptance test");
        $I->click(['class' => 'btn-outline-secondary']);
        $I->wait(2);
        $I->fillField('input[name="Category[name]"]', 'Edit Acceptance test');
        $I->click("Guardar");
        $I->wait(2);
        $I->seeInTitle("Categorias");
        $I->see("Edit Acceptance test");
    }

    public function trySeeCategoryProducts(AcceptanceTester $I)
    {
        $I->amOnPage("category/index");
        $this->login($I);
        $I->amOnPage("category/index");
        $I->seeInTitle("Categorias");
        $I->see("Acceptance test");
        $I->click("Acceptance test");
        $I->wait(2);
        $I->seeInTitle("Acceptance test");
        $I->see("Esta categoria não tem produtos");
    }

    protected function login(AcceptanceTester  $I){
        $I->see("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]','admin');
        $I->fillField('input[name="LoginForm[password]"]','admin');
        $I->click('button[name="login-button"]');
        $I->wait(2);
        $I->dontSee("Incorrect username or password.");
    }
}
