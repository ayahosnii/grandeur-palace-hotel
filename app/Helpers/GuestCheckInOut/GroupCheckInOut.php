<?php

namespace App\Helpers\GuestCheckInOut;

class GroupCheckInOut extends CheckInOut
{
    public function applyDiscount($totalCost)
    {
        return $totalCost * 0.7;
    }
}
