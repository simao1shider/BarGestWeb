<?php namespace backend\tests;

use common\models\Employee;

class EmployeeTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    // comment
    public function testEmployeeNameValidation()
    {
        $employee = new Employee();

        $employee->name = "orfkreofefoerpfkerpofwlkwefwefmwoijwoeroigreogreigwekjweijdosijgojgoerireoingeroigeorigeorihgroehgeoriheroheoo";
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

        $employee->email = "orfkreofefoerpfkerpofwlkwefwefmwoijwoeroigreogreigwekjweijdosijgojgoerireoingeroigeorigeorihgroehgeoriheroheoo@fifj.pt";
        $this->assertFalse($employee->validate(['email']));
        $employee->email = "";
        $this->assertFalse($employee->validate(['email']));
        $employee->email = "simao@bargest.pt";
        $this->assertTrue($employee->validate(['email']));

        return $employee->email;
    }

    public function testEmployeePhoneValidation()
    {
        $employee = new Employee();

        $employee->phone = "oeeggfdgfdgfdgfdgregergfdgr";
        $this->assertFalse($employee->validate(['phone']));
        $employee->phone = "918323456";
        $this->assertTrue($employee->validate(['phone']));

        return $employee->phone;
    }

    public function testEmployeeBirthDateValidation(){
        $employee = new Employee();

        $employee->birthDate = "ewfijwo+ifjwe+ifjweifjweifjweifjwepfjwepifj";
        $this->assertFalse($employee->validate(['birthDate']));
        $employee->birthDate = "2000/07/24";
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
            'user_id' => '2',
        ]);
        $this->tester->seeRecord('common\models\Employee', array('title' => $this->testEmployeeNameValidation()));
    }
}