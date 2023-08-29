<?php

namespace App\Helpers\salary_calculate;

class WorkingHoursCalculator
{
    public function getTotalWorkingHoursPerMonth()
    {
        // Calculate the total working hours in the current month excluding Fridays and Saturdays.

        $currentDate = date('Y-m-d'); // Get the current date.

        // Calculate the number of days in the current month.
        $totalDaysInMonth = date('t', strtotime($currentDate));

        $workingDays = 0;
        for ($day = 1; $day <= $totalDaysInMonth; $day++) {
            $date = date('Y-m-d', strtotime("$currentDate-$day"));
            $dayOfWeek = date('N', strtotime($date)); // Get the day of the week (1 = Monday, 7 = Sunday).

            // Exclude Fridays (5) and Saturdays (6) from working days.
            if ($dayOfWeek != 5 && $dayOfWeek != 6) {
                $workingDays++;
            }
        }

        // Calculate the total working hours in the month.
        $workingHoursPerDay = ($this->calculateTimeDifference("14:00:00", "07:00:00")) / 3600;
        $totalWorkingHours = $workingHoursPerDay * $workingDays;

        return $totalWorkingHours;
    }

    private function calculateTimeDifference($time1, $time2)
    {
        return abs(strtotime($time1) - strtotime($time2));
    }
}

