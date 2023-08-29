<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FrontDeskEmployeeSeeder extends Seeder
{
    public function run()
    {
        // Seed employees for Front Desk Staff / Guest Services
        $employees = [
            [
                'name' => 'John Doe',
                'job_id' => 1, // 'Front Desk Agent'
                'is_active' => true,
            ],
            [
                'name' => 'Eva Williams',
                'job_id' => 1, // 'Front Desk Agent'
                'is_active' => true,
            ],
            [
                'name' => 'Jane Smith',
                'job_id' => 2, // 'Concierge'
                'is_active' => true,
            ],
            [
                'name' => 'David Johnson',
                'job_id' => 2, // 'Concierge'
                'is_active' => true,
            ],
            [
                'name' => 'Charlie Brown',
                'job_id' => 3, // 'Bellhop / Porter'
                'is_active' => true,
            ],
            [
                'name' => 'Sophia Adams',
                'job_id' => 3, // 'Bellhop / Porter'
                'is_active' => true,
            ],
        ];

        $employeeIds = DB::table('employees')->insert($employees);

        // Seed salary details for Front Desk Staff / Guest Services employees
        $salaryDetails = [
            [
                'employee_id' => $employeeIds,
                'basic_salary' => 6000,
                'effective_date' => Carbon::now(),
            ],
            [
                'employee_id' => $employeeIds + 1,
                'basic_salary' => 6500,
                'effective_date' => Carbon::now(),
            ],
            [
                'employee_id' => $employeeIds + 2,
                'basic_salary' => 5500,
                'effective_date' => Carbon::now(),
            ],
            [
                'employee_id' => $employeeIds + 3,
                'basic_salary' => 5900,
                'effective_date' => Carbon::now(),
            ],
            [
                'employee_id' => $employeeIds + 4,
                'basic_salary' => 6200,
                'effective_date' => Carbon::now(),
            ],
            [
                'employee_id' => $employeeIds + 5,
                'basic_salary' => 5800,
                'effective_date' => Carbon::now(),
            ],
            // Add more salary details for this category as needed
        ];

        DB::table('salary_details')->insert($salaryDetails);
    }
}
