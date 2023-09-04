<?php

namespace App\Helpers;

use App\Booking\CalculateAvailableRooms;
use App\Helpers\GuestCheckInOut\CheckInOut;
use App\Helpers\GuestCheckInOut\Discounts\EarlyBirdDiscount;
use App\Helpers\GuestCheckInOut\Discounts\NoDiscount;
use App\Models\admin\Room;
use App\Models\admin\RoomsWithNumber;
use Carbon\Carbon;

class BookingService
{
    public function shouldApplyEarlyBirdDiscount($checkIn, $paymentDate)
    {
        $checkInTime = Carbon::parse($checkIn);
        $paymentDate = Carbon::parse($paymentDate);
        return $checkInTime->diffInDays($paymentDate) >= 30;
    }

    private function checkInGuest($customer, $booking)
    {
        $firstName = $customer->firstname;
        $roomNumber = 100;
        $paymentDate = now();
        $checkInDate = $booking->check_in;
        $checkOutDate = $booking->check_out;
        $totalPrice = $booking->total_price;

        // Determine which discount to apply based on the check-in date
        if ($this->shouldApplyEarlyBirdDiscount($paymentDate, $checkInDate)) {
            $discountPromotion = new EarlyBirdDiscount();
        } else {
            $discountPromotion = new NoDiscount();
        }

        $checkInOut = new CheckInOut($firstName, $roomNumber, $paymentDate, $checkInDate, $checkOutDate, $totalPrice, $discountPromotion);

        return response()->json(['message' => 'success']);
    }


    // This is a public function that allows booking multiple rooms with different quantities.
    public function bookRooms(array $roomIds, array $quantities, $booking, $checkInDate, $checkOutDate)
    {
        // Initialize the total price to 0.
        $totalPrice = 0;

        // Loop through the quantities array and book rooms for each quantity.
            $this->bookRoomsForQuantity($roomIds, $quantities, $totalPrice, $booking, $checkInDate, $checkOutDate);

        // Return the total price of the booked rooms.
        return $totalPrice;
    }

    // This is a private function used to book rooms for a specific quantity.
    public function bookRoomsForQuantity(array $roomIds, $quantities, float &$totalPrice, $booking, $checkInDate, $checkOutDate)
    {
        // Initialize an array to store available rooms.
        $availableRooms = [];

        // Loop through the room IDs to find available rooms for the specified quantity.

            // Get the available rooms for the current room ID and quantity.
            $availableRooms = $this->getAvailableRoomsForQuantity($roomIds, $quantities, $checkInDate, $checkOutDate);


        if (!empty($availableRooms)) {
            foreach ($availableRooms as $availableRoom) {
                $this->bookRoom($availableRooms, $booking);
                $this->updateTotalPrice($availableRoom, $totalPrice);
            }
        }else {
            // If no available rooms were found for a particular room ID, throw an exception.
            return 'error';
        }

        }


    private function getAvailableRoomsForQuantity($roomIds, $quantities, $checkInDate, $checkOutDate)
    {
        $calAvailableRooms = new CalculateAvailableRooms();
        $roomInfo = $calAvailableRooms->calculateAvailableRooms($roomIds, $quantities, $checkInDate, $checkOutDate);


        $availableRoomCount = $roomInfo['availableRoomCount'];
        $quantity = $roomInfo['quantity'];
        $bookedRoomIds = $roomInfo['bookedRoomIds'];
        $roomId = $roomInfo['roomId'];

            if ($availableRoomCount >= $quantity) {
                // Retrieve available rooms within the specified date range
                $availableRoomsForCurrentRoom = RoomsWithNumber::with('room')->where('room_id', $roomId)
                    ->whereNotIn('id', $bookedRoomIds)
                    ->limit($quantity)
                    ->get();


                // Add the available rooms for this room to the overall list
                $availableRooms[] = $availableRoomsForCurrentRoom;
            } else {
                throw new \InvalidArgumentException("Not enough available rooms for room ID $roomId in this date range.");
            }

        return $availableRooms;
    }


    private function bookRoom($availableRooms, $booking)
    {
        // Create an array to store the IDs of all available rooms
        $roomIdsToBook = [];

        foreach ($availableRooms as $roomData) {
            foreach ($roomData as $room) {
                $roomIdsToBook[] = $room->id;
            }
        }


        // Attach all available room IDs to the booking with the same booking ID
        $booking->rooms()->attach($roomIdsToBook);

        return $booking;
    }


    private function updateTotalPrice($availableRooms, float &$totalPrice)
    {
        foreach ($availableRooms as $roomData) {
            $roomPrice = $roomData->room->price_per_night;
            $subtotal = $roomPrice * 1;
            $totalPrice += $subtotal;
        }
    }
}
