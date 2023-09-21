<?php

namespace App\Helpers\GuestCheckInOut\Discounts;

use App\Helpers\GuestCheckInOut\interfaces\DiscountPromotionInterface;

class NoDiscount implements DiscountPromotionInterface
{
    public function applyDiscount($totalCost)
    {
        return $totalCost * 1;
    }
}
