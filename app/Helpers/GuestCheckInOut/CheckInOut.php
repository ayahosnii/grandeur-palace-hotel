<?php

namespace App\Helpers\GuestCheckInOut;

use App\Helpers\GuestCheckInOut\Discounts\EarlyBirdDiscount;
use App\Helpers\GuestCheckInOut\interfaces\CheckInOutInterface;
use App\Helpers\GuestCheckInOut\interfaces\DiscountPromotionInterface;
use Carbon\Carbon;

class CheckInOut implements CheckInOutInterface
{

    protected $checkInDate;
    protected $checkOutDate;
    protected $totalPrice;
    protected $discountPromotion;

    public function __construct($checkInDate, $checkOutDate, $totalPrice, DiscountPromotionInterface $discountPromotion)
    {
        $this->checkInDate = $checkInDate;
        $this->checkOutDate = $checkOutDate;
        $this->totalPrice = $totalPrice;
        $this->discountPromotion = $discountPromotion;
    }


    public function totalCost()
    {

        $checkInDateTime = Carbon::parse($this->checkInDate);
        $checkOutDateTime = Carbon::parse($this->checkOutDate);

        // Calculate stay duration in days
        $stayDuration = $checkInDateTime->diffInDays($checkOutDateTime);

        $totalCost = $this->totalPrice * $stayDuration;


        $totalCostAfterDiscount = $this->discountPromotion->applyDiscount($totalCost);

        return $totalCostAfterDiscount;
    }

}
