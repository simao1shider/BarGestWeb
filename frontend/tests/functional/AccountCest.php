<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;
use common\fixtures\AccountFixture;
use common\fixtures\CategoryFixture;
use common\fixtures\EmployeeFixture;
use common\fixtures\ProductFixture;
use common\fixtures\RequestFixture;
use common\fixtures\TableFixture;
use common\fixtures\UserFixture;

class AccountCest
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
            'employee' => [
                'class' => EmployeeFixture::className(),
                'dataFile' => codecept_data_dir() . 'employee_data.php',
            ],
            'table' => [
                'class' => TableFixture::className(),
                'dataFile' => codecept_data_dir() . 'table_data.php',
            ],
        ];
    }
    // tests
    public function trySeeAccountInTable(FunctionalTester $I)
    {
        $this->login($I);
        $I->amOnPage(["table/view?id=1"]);
        $I->seeInTitle("Contas");
    }


    protected function login(FunctionalTester $I)
    {
        $I->see("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->fillField('input[name="LoginForm[password]"]', 'admin');
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }
}
