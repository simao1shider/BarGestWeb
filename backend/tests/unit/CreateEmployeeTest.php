<?php namespace backend\tests;

use common\models\Employee;

class CreateEmployeeTest extends \Codeception\Test\Unit
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

        $employee->phone = "oee";
        $this->assertFalse($employee->validate(['phone']));
        $employee->phone = "";
        $this->assertFalse($employee->validate(['phone']));

        return $employee->phone;
    }
}