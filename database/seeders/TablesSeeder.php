<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableData = [
            [
                'table_number' => 'Table 1',
                'number_of_people' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'Table 2',
                'number_of_people' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'Table 3',
                'number_of_people' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'Table 4',
                'number_of_people' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'Table 5',
                'number_of_people' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'table_number' => 'Table 6',
                'number_of_people' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tables')->insert($tableData);

    }
}
