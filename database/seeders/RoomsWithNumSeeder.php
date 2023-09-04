<?php

namespace Database\Seeders;

use App\Models\admin\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsWithNumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roomIds = Room::pluck('id');

        foreach ($roomIds as $roomId) {
            for ($i = 1; $i <= 3; $i++) {
                $roomNumber = ($roomId - 1) * 3 + $i + 100;
                DB::table('rooms_with_number')->insert([
                    'room_id' => $roomId,
                    'number' => $roomNumber,
                    'available' => true,
                ]);
            }
        }
    }}
