<?php

namespace App\Helpers\salary_calculate;

class SalaryCalculatorPerMinute implements SalaryCalculatorInterface
{
    public function calculateSalaryDeduction($basicSalary, $checkInTime, $checkOutTime, $expectedCheckInTime, $expectedCheckoutTime)
    {
        // Instantiate the WorkingHoursCalculator
        $workingHoursCalculator = new WorkingHoursCalculator();

        // Calculate the late minutes based on actual check-in and expected check-in time.
        $lateMinutes = max(0, round(($checkInTime - $expectedCheckInTime) / 60)); // Late minutes cannot be negative.

        // Calculate the early leave minutes based on actual check-out and expected check-out time.
        $earlyLeaveMinutes = max(0, round(($expectedCheckoutTime - $checkOutTime) / 60)); // Early leave minutes cannot be negative.

        // Calculate the total working minutes for the day based on actual check-in and check-out time.
        $workingMinutes = max(0, round(($checkOutTime - $checkInTime) / 60)); // Working minutes cannot be negative.

        // Calculate the total working days in the month.
        $totalWorkingDays = $workingHoursCalculator->getTotalWorkingHoursPerMonth() / ($workingMinutes / 60);

        // Calculate the salary deduction per minute.
        $deductionPerMinute = $basicSalary / ($workingMinutes * $totalWorkingDays);

        // Calculate the salary deduction for being late and leaving early.
        $salaryDeduction = ($lateMinutes + $earlyLeaveMinutes) * $deductionPerMinute;

        return $salaryDeduction;
    }
}
