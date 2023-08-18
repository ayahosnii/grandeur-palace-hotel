<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomServiceSeeder extends Seeder
{
    public function run()
    {
        // Define room-service associations
        $roomServiceAssociations = [
            // Premium King Room
            1 => [1, 2, 3, 4, 5],
            // Deluxe Queen Room
            2 => [2, 4, 6],
            // Standard Double Room
            3 => [1, 2, 3],
            // Family Suite
            4 => [2, 4, 5],
            // Twin Room
            5 => [1, 2, 6],
            // Economy Single Room
            6 => [1, 6],
        ];

        foreach ($roomServiceAssociations as $roomId => $serviceIds) {
            foreach ($serviceIds as $serviceId) {
                DB::table('room_service')->insert([
                    'room_id' => $roomId,
                    'service_id' => $serviceId,
                ]);
            }
        }
    }
}
