<?php

namespace App\Helpers;

use App\Models\admin\BookingRoomPivot;
use App\Models\admin\Room;
use App\Models\admin\RoomsWithNumber;
use Carbon\Carbon;

class RoomAvailabilityChecker
{
    public function getAvailableRoomsWithCounts($formCheckIn, $formCheckOut)
    {
        $checkInDate = Carbon::parse($formCheckIn);
        $checkOutDate = Carbon::parse($formCheckOut);

        // Get All Rooms with their room types
        $roomsWithNumbers = RoomsWithNumber::where('available', 1)->pluck('room_id');

        $bookedRoomIds = BookingRoomPivot::whereHas('booking', function ($query) use ($checkInDate, $checkOutDate) {
            $query->whereBetween('check_in', [$checkInDate, $checkOutDate])
                ->orWhereBetween('check_out', [$checkInDate, $checkOutDate]);
        })->pluck('room_id');

        // Filter rooms based on availability and not being booked
        $availableRoomIds = $roomsWithNumbers->diff($bookedRoomIds)->toArray();

        $availableRooms = Room::whereIn('id', $availableRoomIds)->get();

        // Count each room separately
        $availableRoomCounts = array_count_values($availableRoomIds);

        // Format rooms data
        $formattedRooms = $availableRooms->map(function ($room) {
            return [
                'id' => $room->id,
                'room_type' => $room->room_type,
                'image' => $room->image,
                'price_per_night' => $room->price_per_night,
                'size' => $room->size,
                'capacity' => $room->capacity,
                'bed_type' => $room->bed_type,
                'adults' => $room->adults,
                'created_at' => $room->created_at,
                'updated_at' => $room->updated_at,
            ];
        });

        return response()->json([
            'rooms' => $formattedRooms,
            'availableRoomCounts' => $availableRoomCounts,
        ]);
    }


    public static function isRoomAvailable($roomId, $formCheckIn, $formCheckOut)
    {
        $checkInDate = Carbon::parse($formCheckIn);
        $checkOutDate = Carbon::parse($formCheckOut);

        $bookedRoomIds = BookingRoomPivot::whereHas('booking', function ($query) use ($checkInDate, $checkOutDate) {
            $query->whereBetween('check_in', [$checkInDate, $checkOutDate])
                ->orWhereBetween('check_out', [$checkInDate, $checkOutDate]);
        })->pluck('room_id');

        return !in_array($roomId, $bookedRoomIds->toArray());
    }
}
