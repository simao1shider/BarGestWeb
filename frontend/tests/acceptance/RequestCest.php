<?php namespace frontend\tests\acceptance;
use common\fixtures\UserFixture as UserFixture;
use frontend\tests\AcceptanceTester;
use yii\helpers\Url;


class RequestCest
{
    /*public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',
            ],
        ];
    }*/

    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryRequestCreateRequestWithAccount(AcceptanceTester $I)
    {
        $I->amOnPage('request/index');
        $I->wait(5);
        $I->see("Sistema de Autenticação");
        $this->login($I);
        $I->wait(2);
        $I->amOnPage('request/index');
        $I->seeInTitle("Pedidos");
        $I->wait(2);
        $I->click(".btn");
        $I->seeInTitle("Mesas");
        $I->wait(2);
        $I->click(".list-group-item");
        $I->wait(3);
        $I->seeInTitle("Contas");
        $I->see("1");
        $I->click(".list-group-item");
        $I->wait(3);
        $I->seeInTitle("Criar Pedido");
        $I->see("Conta:");
        $I->see("Não tem produtos adicionados");
        $I->click(".card");
        $I->wait(3);
        $I->see("Ice Tea");
        $I->click(".card");
        $I->wait(3);
        $I->dontSee("Não tem produtos adicionados");
        $I->click("button[type='submit']");
        $I->wait(3);
        $I->see("Pedidos");
    }
    public function tryRequestCreateRequestWithoutAccount(AcceptanceTester $I)
    {
        $I->amOnPage('request/index');
        $I->wait(5);
        $I->see("Sistema de Autenticação");
        $this->login($I);
        $I->wait(2);
        $I->amOnPage('request/index');
        $I->seeInTitle("Pedidos");
        $I->wait(2);
        $I->click(".btn");
        $I->seeInTitle("Mesas");
        $I->wait(2);
        $I->click(".list-group-item");
        $I->wait(3);
        $I->seeInTitle("Contas");
        $I->see("1");
        $I->click(".btn");
        $I->wait(3);
        $I->seeInTitle("Criar Pedido");
        $I->dontSee("Conta:");
        $I->see("Não tem produtos adicionados");
        $I->click(".card");
        $I->wait(3);
        $I->see("Ice Tea");
        $I->click(".card");
        $I->wait(3);
        $I->dontSee("Não tem produtos adicionados");
        $I->fillField("input[name='Account[name]']","AcceptTest");
        $I->click("button[type='submit']");
        $I->wait(3);
        $I->see("Pedidos");
        $I->amOnPage('table/index');
        $I->click(".list-group-item");
        $I->see("AcceptTest");
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
