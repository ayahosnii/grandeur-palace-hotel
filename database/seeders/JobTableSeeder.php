<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class JobTableSeeder extends Seeder
{
    public function run()
    {
        // Seed job categories
        $jobCategories = [
            ['name' => 'Front Desk Staff / Guest Services'],
            ['name' => 'Housekeeping'],
            ['name' => 'Food and Beverage'],
            ['name' => 'Maintenance and Facilities'],
            ['name' => 'Management and Administration'],
            ['name' => 'Security'],
            ['name' => 'Spa and Fitness Center'],
            ['name' => 'Event Planning'],
            ['name' => 'Accounting and Finance'],
            ['name' => 'Valet Parking'],
            ['name' => 'Shuttle Drivers'],
            ['name' => 'Customer Service'],
        ];

        DB::table('job_categories')->insert($jobCategories);

        // Seed jobs and associate them with categories
        $jobs = [
            // Front Desk Staff / Guest Services
            [
                'title' => 'Front Desk Agent',
                'is_active' => true,
                'category_id' => 1,
            ],
            [
                'title' => 'Concierge',
                'is_active' => true,
                'category_id' => 1,
            ],
            [
                'title' => 'Bellhop / Porter',
                'is_active' => true,
                'category_id' => 1,
            ],
            // Housekeeping
            [
                'title' => 'Housekeepers',
                'is_active' => true,
                'category_id' => 2,
            ],
            [
                'title' => 'Housekeeping Supervisor',
                'is_active' => true,
                'category_id' => 2,
            ],
            // Food and Beverage
            [
                'title' => 'Waitstaff',
                'is_active' => true,
                'category_id' => 3,
            ],
            [
                'title' => 'Bartender',
                'is_active' => true,
                'category_id' => 3,
            ],
            [
                'title' => 'Chef / Cook',
                'is_active' => true,
                'category_id' => 3,
            ],
            [
                'title' => 'Restaurant Manager',
                'is_active' => true,
                'category_id' => 3,
            ],
            // Add more jobs and descriptions as needed
        ];

        DB::table('jobs')->insert($jobs);
    }
}
