<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelRoomSeeder extends Seeder
{
    public function run()
    {
        $roomTypes = [
            [
                'room_type' => 'Premium King Room',
                'price_per_night' => 159.00,
                'size' => '30 ft',
                'capacity' => 5,
                'bed_type' => 'King Beds',
                'services' => 'TV, Free Wifi, Air Condition, Heater, Phone',
                'tv' => true,
                'wifi' => true,
                'air_condition' => true,
                'heater' => true,
                'phone' => true,
                'laundry' => false,
                'adults' => 2,
                'image' => 'room-8.jpeg',
            ],
            [
                'room_type' => 'Deluxe Queen Room',
                'price_per_night' => 129.00,
                'size' => '28 ft',
                'capacity' => 4,
                'bed_type' => 'Queen Beds',
                'services' => 'TV, Free Wifi, Air Condition, Heater, Phone, Laundry',
                'tv' => true,
                'wifi' => true,
                'air_condition' => true,
                'heater' => true,
                'phone' => true,
                'laundry' => true,
                'adults' => 2,
                'image' => 'room-b2.jpg',
            ],
            [
                'room_type' => 'Standard Double Room',
                'price_per_night' => 99.00,
                'size' => '25 ft',
                'capacity' => 3,
                'bed_type' => 'Double Beds',
                'services' => 'TV, Free Wifi, Air Condition, Heater, Phone',
                'tv' => true,
                'wifi' => true,
                'air_condition' => true,
                'heater' => true,
                'phone' => true,
                'laundry' => false,
                'adults' => 2,
                'image' => 'room-b3.jpg',
            ],
            [
                'room_type' => 'Family Suite',
                'price_per_night' => 199.00,
                'size' => '40 ft',
                'capacity' => 6,
                'bed_type' => 'King and Queen Beds',
                'services' => 'TV, Free Wifi, Air Condition, Heater, Phone, Laundry',
                'tv' => true,
                'wifi' => true,
                'air_condition' => true,
                'heater' => true,
                'phone' => true,
                'laundry' => true,
                'adults' => 4,
                'image' => 'double-room.jpeg',
            ],
            [
                'room_type' => 'Twin Room',
                'price_per_night' => 89.00,
                'size' => '22 ft',
                'capacity' => 2,
                'bed_type' => 'Twin Beds',
                'services' => 'TV, Free Wifi, Air Condition, Heater, Phone',
                'tv' => true,
                'wifi' => true,
                'air_condition' => true,
                'heater' => true,
                'phone' => true,
                'laundry' => false,
                'adults' => 2,
                'image' => 'room-8.jpeg',
            ],
            [
                'room_type' => 'Economy Single Room',
                'price_per_night' => 69.00,
                'size' => '18 ft',
                'capacity' => 1,
                'bed_type' => 'Single Bed',
                'services' => 'TV, Free Wifi, Air Condition, Heater, Phone',
                'tv' => true,
                'wifi' => true,
                'air_condition' => true,
                'heater' => true,
                'phone' => true,
                'laundry' => false,
                'adults' => 1,
                'image' => 'room-7.jpeg',
            ],
        ];

        foreach ($roomTypes as $roomType) {
            DB::table('rooms')->insert($roomType);
        }
    }
}
