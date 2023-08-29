<?php

namespace App\Helpers\salary_calculate;

use Carbon\Carbon;

class SalaryCalculatorPerHour implements SalaryCalculatorInterface
{
    public function calculateSalaryDeduction($basicSalary, $checkInTime, $checkOutTime, $expectedCheckInTime, $expectedCheckOutTime)
    {
        // Your salary deduction logic for per hour here.
        // Example implementation similar to the previous method.
        $workingHours = 0;
        if ($checkInTime >= $expectedCheckInTime && $checkOutTime <= $expectedCheckOutTime) {
            $workingHours = round(($checkOutTime - $checkInTime) / 3600, 2); // Convert seconds to hours and round to 2 decimal places.
        } elseif ($checkInTime < $expectedCheckInTime && $checkOutTime <= $expectedCheckOutTime) {
            $workingHours = round(($checkOutTime - $expectedCheckInTime) / 3600, 2);
        } elseif ($checkInTime >= $expectedCheckInTime && $checkOutTime > $expectedCheckOutTime) {
            $workingHours = round(($expectedCheckOutTime - $checkInTime) / 3600, 2);
        }

        // Calculate the total working hours in the month.
        $totalWorkingHours = $this->getTotalWorkingHoursPerMonth();

        // Calculate the hourly rate based on the basic salary and total working hours.
        $hourlyRate = $basicSalary / $totalWorkingHours;

        // Calculate the salary deduction based on the working hours and hourly rate.
        $salaryDeduction = $workingHours * $hourlyRate;

        return $salaryDeduction;
    }

    private function getTotalWorkingHoursPerMonth()
    {
        // Create an instance of the CalculateDaysInCurrentMonth class
        $workingDaysCalculator = new CalculateDaysInCurrentMonth();

        // Get the count of working days in the current month (excluding Fridays and Saturdays)
        $workingDaysCount = $workingDaysCalculator->getWorkingDaysCount();

        // Calculate the total working hours in the month based on working days and expected working hours per day.
        $workingHoursPerDay = ($this->calculateTimeDifference("14:00:00", "07:00:00")) / 3600;
        $totalWorkingHours = $workingHoursPerDay * $workingDaysCount;

        return $totalWorkingHours;
    }

    private function calculateTimeDifference($time1, $time2)
    {
        return abs(strtotime($time1) - strtotime($time2));
    }
}
