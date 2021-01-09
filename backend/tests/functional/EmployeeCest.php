<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use Symfony\Component\CssSelector\Node\FunctionNode;

class EmployeeCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }

    public function checkAccessToIndexWithoutLogin(FunctionalTester $I)
    {
        $I->amOnPage(["employee/index"]);
        $I->see('Autenticação');
    }

    public function checkAccessToCreateWithoutLogin(FunctionalTester $I)
    {
        $I->amOnPage(["employee/create"]);
        $I->see('Autenticação');
    }

    public function checkAccessToDeleteWithoutLogin(FunctionalTester $I)
    {
        $I->amOnPage(["employee/delete"]);
        $I->see('Autenticação');
    }

    public function checkAccessWithAccountWithNoAccess(FunctionalTester $I){
        $this->login($I , 'simao', '12345678');
        $I->amOnPage('employee/index');
        $I->see('Forbidden');
    }

    public function checkAccessLoggedUserinUsersList(FunctionalTester $I)
    {
        $this->login($I , 'admin', 'admin');
        $I->amOnPage('employee/index');
        $I->see('Funcionários');
    }

    public function checkAccessLoggedUserinCreateUser(FunctionalTester $I)
    {
        $this->login($I , 'admin', 'admin');
        $I->amOnPage('employee/create');
        $I->see('Criar Funcionário');
        $I->fillField("input[name='Employee[name]']","EmployeeFuncionalTest");
        $I->fillField("input[name='Employee[email]']","employee@funcional.test");
        $I->fillField("input[name='Employee[phone]']","911111111");
        $I->fillField("input[name='Employee[birthDate]']",date("1999-03-04"));
        $I->fillField("input[name='SignupForm[username]']","employeefuncionaltest");
        $I->fillField("input[name='SignupForm[password]']","12345678");
        $I->fillField("input[name='SignupForm[password_repeat]']","12345678");
        $I->selectOption("select","employee");
        $I->click("button[type='submit']");
        $I->see("EmployeeFuncionalTest");
    }

    protected function login(FunctionalTester $I, $nome, $password){
        $I->see("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]', $nome);
        $I->fillField('input[name="LoginForm[password]"]', $password);
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }
}
