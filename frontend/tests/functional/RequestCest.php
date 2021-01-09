<?php namespace frontend\tests\functional;
use common\fixtures\AccountFixture;
use common\fixtures\CategoryFixture;
use common\fixtures\EmployeeFixture;
use common\fixtures\ProductFixture;
use common\fixtures\RequestFixture;
use common\fixtures\TableFixture;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;


class RequestCest
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
            'category' => [
                'class' => CategoryFixture::className(),
                'dataFile' => codecept_data_dir() . 'category_data.php',
            ],
            'product' => [
                'class' => ProductFixture::className(),
                'dataFile' => codecept_data_dir() . 'product_data.php',
            ],
            'table' => [
                'class' => TableFixture::className(),
                'dataFile' => codecept_data_dir() . 'table_data.php',
            ],
            'account' => [
                'class' => AccountFixture::className(),
                'dataFile' => codecept_data_dir() . 'account_data.php',
            ],
        ];
    }
    // tests
    public function trySeeRequestIndexWithOutRequests(FunctionalTester $I)
    {
        $this->login($I);
        $I->amOnPage(["request/index"]);
        $I->seeInTitle("Pedidos");
        $I->see("Não tem pedidos neste momento");

    }

    public function trySeeIndexWithRequest(FunctionalTester $I){
        $I->haveFixtures(["request" => [
            'class' => RequestFixture::className(),
            'dataFile' => codecept_data_dir() . 'request_data.php',
        ]]);
        $this->login($I);
        $I->amOnPage(["request/index"]);
        $I->seeInTitle("Pedidos");
        $I->see("admin");
    }

    public function trySeeSpecificRequest(FunctionalTester $I){
        $this->login($I);
        $I->haveFixtures(["request" => [
                'class' => RequestFixture::className(),
                'dataFile' => codecept_data_dir() . 'request_data.php',
            ]]);
        $I->amOnPage(["request/update",'id'=>1]);
        $I->seeInTitle("Pedido");
    }



    protected function login(FunctionalTester $I){
        $I->see("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]','admin');
        $I->fillField('input[name="LoginForm[password]"]','admin');
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }
}
