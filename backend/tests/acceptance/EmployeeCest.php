<?php namespace backend\tests\acceptance;
use backend\tests\AcceptanceTester;

class EmployeeCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function tryEmployeeCreate(AcceptanceTester $I){
        $I->amOnPage('employee/index');
        $I->wait(3);
        $I->see("Sistema de Autenticação");
        $this->login($I);
        $I->wait(2);
        $I->amOnPage('employee/index');
        $I->seeInTitle('Funcionários');
        $I->wait(2);
        $I->click('.btn-outline-success');
        $I->seeInTitle('Criar Funcionário');
        $I->wait(2);
        $I->fillField("input[name='Employee[name]']","EmployeeAcceptanceTest");
        $I->wait(1);
        $I->fillField("input[name='Employee[email]']","employee@acceptance.test");
        $I->wait(1);
        $I->fillField("input[name='Employee[phone]']","911111111");
        $I->wait(1);
        $I->fillField("input[name='Employee[birthDate]']","06/01/1995");
        $I->wait(1);
        $I->fillField("input[name='SignupForm[username]']","employeeacceptancetest");
        $I->wait(1);
        $I->fillField("input[name='SignupForm[password]']","12345678");
        $I->wait(1);
        $I->fillField("input[name='SignupForm[password_repeat]']","12345678");
        $I->wait(1);
        $I->selectOption("select","employee");
        $I->wait(5);
        $I->click("button[type='submit']");
        $I->wait(2);
        $I->see("EmployeeAcceptanceTest");
        $I->wait(3);
    }

    protected function login(AcceptanceTester  $I){
        $I->see("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]','admin');
        $I->fillField('input[name="LoginForm[password]"]','admin');
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }
}
