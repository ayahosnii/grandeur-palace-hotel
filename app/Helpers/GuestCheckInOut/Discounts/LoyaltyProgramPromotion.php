<?php

namespace App\Helpers\GuestCheckInOut\Discounts;

use App\Helpers\GuestCheckInOut\interfaces\DiscountPromotionInterface;

class LoyaltyProgramPromotion implements DiscountPromotionInterface
{
    public function applyDiscount($totalCost)
    {
        return $totalCost * 0.8; // 20% discount
    }
}
