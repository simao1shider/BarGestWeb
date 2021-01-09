<?php namespace backend\tests;

use common\models\Employee;
use common\fixtures\UserFixture as UserFixture;

class EmployeeTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
        ]);
    }

    /*public function _fixture(){
        return[
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ],
        ];
    }*/

    // comment
    public function testEmployeeNameValidation()
    {
        $employee = new Employee();

        $employee->name = "orfkreofefoerpfkerpofwlkwefwefmwoijwoeroigreogreigwekjweijdosijgojgoerireoingeroigeorigeorihgddddddroehgeoriheroheoo";
        $this->assertFalse($employee->validate(['name']));
        $employee->name = 32423432423423;
        $this->assertFalse($employee->validate(['name']));
        $employee->name = "";
        $this->assertFalse($employee->validate(['name']));
        $employee->name = "Simão Marques";
        $this->assertTrue($employee->validate(['name']));

        return $employee->name;
    }

    //Falta o unique
    public function testEmployeeEmailValidation()
    {
        $employee = new Employee();

        $employee->email = "orfkreofefoerpfkerpofwlkwefwefmwoijwoeroigrfffffffffffffffffffffffffffffffffffffeogreigwekjweijdosijgojgoerireorrrrrrrrrrrrrrrrringeroigeorigeorihgroehgeoriheroheoo@fifj.pt";
        $this->assertFalse($employee->validate(['email']));
        $employee->email = "";
        $this->assertFalse($employee->validate(['email']));
        $employee->email = "dwwqdwqd";
        $this->assertFalse($employee->validate(['email']));
        $employee->email = "1";
        $this->assertFalse($employee->validate(['email']));
        $employee->email = "simado@bargest.pt";
        $this->assertTrue($employee->validate(['email']));

        return $employee->email;
    }

    public function testEmployeePhoneValidation()
    {
        $employee = new Employee();

        $employee->phone = "oeeggfdgfdgfdgfdgregergfdgr";
        $this->assertFalse($employee->validate(['phone']));
        $employee->phone = "918323453";
        $this->assertTrue($employee->validate(['phone']));

        return $employee->phone;
    }

    public function testEmployeeBirthDateValidation(){
        $employee = new Employee();

        $employee->birthDate = "ewfijwo+ifjwe+ifjweifjweifjweifjwepfjwepifj";
        $this->assertFalse($employee->validate(['birthDate']));
        $employee->birthDate = date("01-07-2000");
        $this->assertFalse($employee->validate(['birthDate']));
        $employee->birthDate = 9999999999999999999;
        $this->assertFalse($employee->validate(['birthDate']));
        $employee->birthDate = date("2000-07-24");
        $this->assertTrue($employee->validate(['birthDate']));

        return $employee->birthDate;
    }

    public function testEmployeeInputTrueValidation()
    {
        $this->tester->haveRecord('common\models\Employee',[
            'name' => $this->testEmployeeNameValidation(),
            'email' => $this->testEmployeeEmailValidation(),
            'phone' => $this->testEmployeePhoneValidation(),
            'birthDate' => $this->testEmployeeBirthDateValidation(),
            'user_id' => 2,
        ]);
        $this->tester->seeRecord('common\models\Employee', array('name' => $this->testEmployeeNameValidation()));
    }
}