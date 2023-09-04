<?php

namespace App\Helpers\GuestCheckInOut;

use Carbon\Carbon;

class VIPCheckInOut extends CheckInOut
{
    public function applyDiscount($totalCost)
    {
        return $totalCost *   0.8;
    }
}

