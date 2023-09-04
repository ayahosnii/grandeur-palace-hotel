<?php

namespace App\Booking;

use App\Models\admin\Room;
use App\Models\admin\RoomsWithNumber;

class CalculateAvailableRooms
{
    public function calculateAvailableRooms($roomIds, $quantities, $checkInDate, $checkOutDate)
    {
        $availableRooms = [];

        // Iterate through roomIds and quantities together
        foreach (array_combine($roomIds, $quantities) as $roomId => $quantity) {
            // Retrieve the room
            $room = Room::find($roomId);

            if (!$room) {
                return "Invalid room ID";
            }

            $allRoomCount = RoomsWithNumber::where('room_id', $room->id)->count();

            // Retrieve the number of booked rooms within the date range
            $bookedRoomCount = $this->bookedRoomCount($room, $checkInDate, $checkOutDate);

            $bookedRoomIds = RoomsWithNumber::with('room')->where('room_id', $room->id)
                ->whereHas('bookings', function ($query) use ($checkInDate, $checkOutDate) {
                    // Check if the room is booked for the specified date range
                    $query->whereBetween('check_in', [$checkInDate, $checkOutDate])
                        ->orWhereBetween('check_out', [$checkInDate, $checkOutDate]);
                })
                ->pluck('id')
                ->toArray();

            // Calculate the available room count
            $availableRoomCount = $allRoomCount - $bookedRoomCount;

            return [
                'room' => $room,
                'availableRoomCount' => $availableRoomCount,
                'bookedRoomIds' => $bookedRoomIds,
                'quantity' => $quantity,
                'roomId' => $roomId,
                'availableRooms' => $availableRooms,
            ];
        }
    }

    public function bookedRoomCount($room, $checkInDate, $checkOutDate)
    {
        return RoomsWithNumber::with('room')->where('room_id', $room->id)
            ->whereHas('bookings', function ($query) use ($checkInDate, $checkOutDate) {
                // Check if the room is booked for the specified date range
                $query->whereBetween('check_in', [$checkInDate, $checkOutDate])
                    ->orWhereBetween('check_out', [$checkInDate, $checkOutDate]);
            })
            ->count();
    }
}
