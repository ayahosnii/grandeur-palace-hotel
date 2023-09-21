<?php

namespace Database\Seeders;

use App\Helpers\salary_calculate\CalculateDaysInCurrentMonth;
use App\Helpers\salary_calculate\CalculateRemainDaysInCurrentMonth;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                $employees = [
                    [
                        'name' => 'Samuel Moore',
                        'job_id' => 6, // 'Waitstaff'
                        'is_active' => true,
                        'image' => 'samuel.jpg',
                    ],
                    [
                        'name' => 'Sarah Johnson',
                        'job_id' => 6, // 'Waitstaff'
                        'is_active' => true,
                        'image' => 'sarah.jpg',
                    ],
                    [
                        'name' => 'Olivia Anderson',
                        'job_id' => 4, // 'Housekeepers'
                        'is_active' => true,
                        'image' => 'olivia.jpg',
                    ],
                    [
                        'name' => 'Ethan Taylor',
                        'job_id' => 5, // 'Housekeeping Supervisor'
                        'is_active' => true,
                        'image' => 'ethan.jpg',
                    ],

                    [
                        'name' => 'Ava Martinez',
                        'job_id' => 5, // 'Housekeeping Supervisor'
                        'is_active' => true,
                        'image' => 'charlie.jpg',
                    ],
                    [
                        'name' => 'Noah Harris',
                        'job_id' => 5, // 'Housekeeping Supervisor'
                        'is_active' => true,
                        'image' => 'noah.jpg',
                    ],
                ];

                $employeeIds = DB::table('employees')->insert($employees);


        $effective_date = Carbon::now();
        $basic_salary = 6500;
        // Check if the day of effective_date is the first day of the month
        $effectiveDate = new \DateTime($effective_date);
        $isFirstDayOfMonth = $effectiveDate->format('d') === '01';

        if ($isFirstDayOfMonth) {
            // If it's the first day of the month, set new_salary to basic_salary
            $newSalary = $basic_salary;
        } else {
            // If it's another day of the month, calculate new_salary
            $daysInCurrentMonth = new CalculateDaysInCurrentMonth();
            $workingDaysCount = $daysInCurrentMonth->getWorkingDaysCount();

            $remainDaysInCurrentMonth = new CalculateRemainDaysInCurrentMonth();
            $daysWorked = $remainDaysInCurrentMonth->getWorkingDaysCount($effective_date);

            $dailySalary = $basic_salary / $workingDaysCount;
            $partialMonthSalary = $dailySalary * $daysWorked;

            $newSalary = $partialMonthSalary;

            $salaryDetails = [
                [
                    'employee_id' => 9,
                    'basic_salary' => $basic_salary,
                    'effective_date' => Carbon::now(),
                    'new_salary' => $newSalary,
                ],
                [
                    'employee_id' => 10,
                    'basic_salary' => $basic_salary,
                    'effective_date' => Carbon::now(),
                    'new_salary' => $newSalary,
                ],
                [
                    'employee_id' => 11,
                    'basic_salary' => $basic_salary,
                    'effective_date' => Carbon::now(),
                    'new_salary' => $newSalary,
                ],
                [
                    'employee_id' => 12,
                    'basic_salary' => $basic_salary,
                    'effective_date' => Carbon::now(),
                    'new_salary' => $newSalary,
                ],
            ];
            DB::table('salary_details')->insert($salaryDetails);
        }
    }
}
