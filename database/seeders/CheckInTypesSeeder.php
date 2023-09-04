<?php

namespace Database\Seeders;

use App\Models\admin\CheckInType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CheckInTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define the check-in types and seed them
        $types = [
            'Standard',
            'Group',
            'VIP',
        ];

        foreach ($types as $type) {
            CheckInType::create(['name' => $type]);
        }
    }
}
