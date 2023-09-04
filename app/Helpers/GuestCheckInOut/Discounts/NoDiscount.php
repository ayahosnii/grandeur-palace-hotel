<?php

namespace App\Helpers\GuestCheckInOut\Discounts;

use App\Helpers\GuestCheckInOut\Interfaces\DiscountPromotionInterface;

class NoDiscount implements DiscountPromotionInterface
{
    public function applyDiscount($totalCost)
    {
        // No discount is applied, so return the original total cost
        return $totalCost;
    }
}
