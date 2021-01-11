<?php namespace backend\tests;

use common\fixtures\EmployeeFixture;
use common\models\Employee;
use common\fixtures\UserFixture;

class EmployeeTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

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
        ];
    }

    protected function _before()
    {
    }



    // comment
    public function testEmployeeNameValidation()
    {
        $employee = new Employee();

        $employee->name = "orfkreofefoerpfkerpofwlkwefwefmwoijwoeroigreogreigwekjweijdosijgojgoerireoingeroigeorigeorihgddddddroehgeoriheroheoo";
        $this->assertFalse($employee->validate(['name']),"Nome muito grande");
        $employee->name = 32423432423423;
        $this->assertFalse($employee->validate(['name']),"Não pode ser inteiro");
        $employee->name = "";
        $this->assertFalse($employee->validate(['name']),"Não pode ser vazio");
        $employee->name = null;
        $this->assertFalse($employee->validate(['name']),"Não pode ser nulo");
        $employee->name = "Simão Marques";
        $this->assertTrue($employee->validate(['name']),"Nome valido");

        return $employee->name;
    }

    //Falta o unique
    public function testEmployeeEmailValidation()
    {
        $employee = new Employee();

        $employee->email = "orfkreofefoerpfkerpofwlkwefwefmwoijwoeroigrfffffffffffffffffffffffffffffffffffffeogreigwekjweijdosijgojgoerireorrrrrrrrrrrrrrrrringeroigeorigeorihgroehgeoriheroheoo@fifj.pt";
        $this->assertFalse($employee->validate(['email']),"Tamanho de email invalido");
        $employee->email = "";
        $this->assertFalse($employee->validate(['email']),"O email não pode ser vazio");
        $employee->email = null;
        $this->assertFalse($employee->validate(['email']),"O email não pode ser nulo");
        $employee->email = "dwwqdwqd";
        $this->assertFalse($employee->validate(['email']),"Tem de ter o formato de email");
        $employee->email = "dwwqdwqd@tttt";
        $this->assertFalse($employee->validate(['email']),"Tem de ter o formato de email");
        $employee->email = 1;
        $this->assertFalse($employee->validate(['email']),"Não pode ser so numero, tem de ser o formato de email");
        $employee->email = "simado@bargest.pt";
        $this->assertFalse($employee->validate(['email']),"O email não pode ser duplicado");
        $employee->email = "simado2@bargest.pt";
        $this->assertTrue($employee->validate(['email']),"Email valido");

        return $employee->email;
    }

    public function testEmployeePhoneValidation()
    {
        $employee = new Employee();

        $employee->phone = "oeeggfdgfdgfdgfdgregergfdgr";
        $this->assertFalse($employee->validate(['phone']),"Não pode conter letras");
        $employee->phone = "918323453";
        $this->assertFalse($employee->validate(['phone']),"Não pode ser duplicado");
        $employee->phone = 918323452;
        $this->assertTrue($employee->validate(['phone']),"Phone valido");
        $employee->phone = "918323452";
        $this->assertTrue($employee->validate(['phone']),"Phone valido");

        return $employee->phone;
    }

    public function testEmployeeBirthDateValidation(){
        $employee = new Employee();

        $employee->birthDate = "ewfijwo+ifjwe+ifjweifjweifjweifjwepfjwepifj";
        $this->assertFalse($employee->validate(['birthDate']),"Não pode permitir texto");
        $employee->birthDate = date("01-07-2000");
        $this->assertFalse($employee->validate(['birthDate']),"Não esta de acordo com o foramto");
        $employee->birthDate = 9999999999999999999;
        $this->assertFalse($employee->validate(['birthDate']),"Não pode se inteiro");
        $employee->birthDate = date("2000-07-24");
        $this->assertTrue($employee->validate(['birthDate']),"Data valida valido");

        return $employee->birthDate;
    }

    public function testEmployeeInputTrueValidation()
    {
        $this->tester->haveRecord('common\models\Employee',[
            'id'=>3,
            'name' => $this->testEmployeeNameValidation(),
            'email' => $this->testEmployeeEmailValidation(),
            'phone' => $this->testEmployeePhoneValidation(),
            'birthDate' => $this->testEmployeeBirthDateValidation(),
            'user_id' => '1',
        ]);
        $this->tester->seeRecord('common\models\Employee', array('name' => $this->testEmployeeNameValidation()));
    }
}