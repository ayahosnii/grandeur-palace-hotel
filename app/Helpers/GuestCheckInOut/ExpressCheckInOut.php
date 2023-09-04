<?php

namespace App\Helpers\GuestCheckInOut;

class ExpressCheckInOut extends CheckInOut
{
    public function checkIn()
    {
        return "Express check-in for {$this->guestName} into Room {$this->roomNumber} on {$this->checkInDate}.";
    }

    public function checkOut()
    {
        return "Express check-out for {$this->guestName} from Room {$this->roomNumber} on {$this->checkOutDate}.";
    }
}
