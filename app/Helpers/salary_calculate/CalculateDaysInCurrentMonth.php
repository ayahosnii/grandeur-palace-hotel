<?php
namespace App\Helpers\salary_calculate;

use Carbon\Carbon;

class CalculateDaysInCurrentMonth
{
    public function getWorkingDaysCount()
    {
        // Get the first day of the current month
        $firstDayOfMonth = Carbon::now()->startOfMonth();

        // Get the last day of the current month
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        // Initialize the working days count
        $workingDays = 0;

        // Loop through each day from the first day to the last day of the month
        for ($currentDay = $firstDayOfMonth; $currentDay <= $lastDayOfMonth; $currentDay->addDay()) {
            // Check if the current day is a Friday (5) or Saturday (6)
            // If it's not Friday or Saturday, increment the working days count
            if ($currentDay->dayOfWeek !== Carbon::FRIDAY && $currentDay->dayOfWeek !== Carbon::SATURDAY) {
                $workingDays++;
            }
        }

        return $workingDays;
    }
}
