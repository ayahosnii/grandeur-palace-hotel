<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingAndCustomerSeeder extends Seeder
{
    public function run()
    {
        // Define the date range
        $startDate = Carbon::create(2023, 8, 20);
        $endDate = Carbon::create(2023, 8, 30);

        for ($i = 1; $i < 6; $i++) {
            $customer = Customer::create([
                'firstname' => 'CustomerFirstName' . $i,
                'lastname' => 'CustomerLastName' . $i,
                'email' => 'customer' . $i . '@example.com',
                'phone' => '123-456-789' . $i,
            ]);

            $checkIn = $startDate->copy()->addDays(rand(0, $endDate->diffInDays($startDate) - 5));

            $maxStay = 5;
            $checkOut = $checkIn->copy()->addDays(rand(1, $maxStay));

            Booking::create([
                'room_id' => $i,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'customer_id' => $customer->id,
            ]);
        }
    }
}
