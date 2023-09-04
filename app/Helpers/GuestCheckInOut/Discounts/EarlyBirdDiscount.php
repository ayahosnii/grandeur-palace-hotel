<?php

namespace App\Helpers\GuestCheckInOut\Discounts;

use App\Helpers\GuestCheckInOut\interfaces\DiscountPromotionInterface;

class EarlyBirdDiscount implements DiscountPromotionInterface
{
    public function purpose()
    {
        return 'Purpose: This discount represents a discount that guests can receive
        if they book their stay well in advance, often referred to as an "early bird" discount.';
    }

    public function applyDiscount($totalCost)
    {
        // Apply a 10% early bird discount
        return $totalCost * 0.9;
    }

}
