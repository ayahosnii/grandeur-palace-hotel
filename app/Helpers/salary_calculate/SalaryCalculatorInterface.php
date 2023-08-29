<?php

namespace App\Helpers\salary_calculate;

interface SalaryCalculatorInterface
{
    public function calculateSalaryDeduction($basicSalary, $checkInTime, $checkOutTime, $expectedCheckInTime, $expectedCheckoutTime);
}
