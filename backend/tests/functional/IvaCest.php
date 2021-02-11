<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\Category;

class IvaCest
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
    public function tryWithoutIva(FunctionalTester $I)
    {
        $this->startIva($I);
        $I->see("Não existem ivas inativos");
        $I->see("Não existem ivas ativos");
    }

    function tryWithActiveIva(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Iva',[
            'id' => '1',
            'rate' => 23,
            'status' => \common\models\Iva::ACTIVE,
        ]);
        $this->startIva($I);
        $I->see("Não existem ivas inativos");
        $I->dontSee("Não existem ivas ativos");
        $I->see("23%");
    }

    function tryWithDeletedIva(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Iva',[
            'id' => '1',
            'rate' => 23,
            'status' => \common\models\Iva::INACTIVE,
        ]);
        $this->startIva($I);
        $I->dontSee("Não existem ivas inativos");
        $I->see("Não existem ivas ativos");
        $I->see("23%");
    }

    function tryDeleteIva(FunctionalTester $I)
    {
        $I->haveRecord('common\models\Iva',[
            'id' => '1',
            'rate' => 23,
            'status' => \common\models\Iva::ACTIVE,
        ]);
        $this->startIva($I);
        $I->see("Não existem ivas inativos");
        $I->dontSee("Não existem ivas ativos");
        $I->see("23%");
        $I->click(['class' => 'btn-danger']);
        $I->dontSee("Não existem ivas inativos");
        $I->see("Não existem ivas ativos");
        $I->see("23%");
    }

    function tryCreateIva(FunctionalTester $I)
    {
        $this->startIva($I);
        $I->see("Não existem ivas inativos");
        $I->see("Não existem ivas ativos");
        $I->dontSee("23%");
        $I->click("Criar");
        $I->seeInTitle("Criar Iva");
        $I->fillField('input[name="Iva[rate]"]', '23');
        $I->click("Guardar");
        $I->see("Não existem ivas inativos");
        $I->dontSee("Não existem ivas ativos");
        $I->see("23%");
    }

    protected function login(FunctionalTester $I)
    {
        $I->see("Autenticação");
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->fillField('input[name="LoginForm[password]"]', 'admin');
        $I->click('button[name="login-button"]');
        $I->dontSee("Incorrect username or password.");
    }

    protected function startIva(FunctionalTester $I)
    {
        $I->amOnPage(["iva/index"]);
        $this->login($I);
        $I->amOnPage(["iva/index"]);
        $I->seeInTitle("Ivas");
    }
}
