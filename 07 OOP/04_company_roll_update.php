<?php

/**
 * Created by PhpStorm.
 * User: apetrov
 * Date: 2/15/2017
 * Time: 9:18 AM
 */
class Employee
{

    public $name;
    public $salary;
    public $position;
    public $department;
    public $email;
    public $age;

    public function __construct(string $name, float $salary, string $position, string $department, string $email = null, int $age = null)
    {

        $this->name = $name;
        $this->salary = $salary;
        $this->position = $position;
        $this->department = $department;
        $this->email = $email;
        $this->age = $age;

    }

    public function __toString()
    {
        $age = isset($this->age) ? $this->age : '-1';
        $money = number_format($this->salary, 2);
        $email = isset($this->email) ? $this->email : 'n/a';

        return $this->name . ' ' . $money . ' ' . $email . ' ' . $age;
    }

}

$n = trim(fgets(STDIN));

$employeeArr = [];

for ($i = 0; $i < $n; $i++) {

    $inputArray = explode(' ', trim(fgets(STDIN)));

    $name = $inputArray[0];
    $salary = floatval($inputArray[1]);
    $position = $inputArray[2];
    $department = $inputArray[3];

    $email = null;
    $age = null;
    /*if (isset($inputArray[4]) && !is_numeric($inputArray[4])) {

        $email = $inputArray[4];
        $age = isset($inputArray[5]) ? intval($inputArray[5]) : null;
    } else {
        if (isset($inputArray[4]))
            $age = intval($inputArray[4]);
    }*/

    if (isset($inputArray[4])) {
        if (is_numeric($inputArray[4])) {
            $age = intval($inputArray[4]);
        } else {
            $email = $inputArray[4];
        }
    }
    if (isset($inputArray[5])) {
        if (is_numeric($inputArray[5])) {
            $age = intval($inputArray[5]);
        }
    }


    $employeeArr[] = new Employee($name, $salary, $position, $department, $email, $age);


}
//var_dump($employeeArr);

function calcBestDepartment($employeeArr)
{

    $departmentArr = [];

    foreach ($employeeArr as $employee) {

        if (isset($departmentArr[$employee->department])) {

            $departmentArr[$employee->department][0] += $employee->salary;
            $departmentArr[$employee->department][1]++;
        } else {

            $departmentArr[$employee->department] = [$employee->salary, 1];
        }

    }

    foreach ($departmentArr as $key=>$value) {

            $departmentArr[$key] = $value[0] / $value[1];
        
    }


    return $key = array_search(max($departmentArr), $departmentArr);



}

$department = calcBestDepartment($employeeArr);


$done = usort($employeeArr, function ($a, $b) {


    return $a->salary < $b->salary;
});


echo "Highest Average Salary: $department" . "\n";

foreach ($employeeArr as $employee) {

    if ($employee->department == calcBestDepartment($employeeArr)) {

        echo $employee . "\n";
    }


}