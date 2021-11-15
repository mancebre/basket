<?php

namespace App\Lib;

use App\Contracts\Discount;

class DeliveryChangeRules implements Discount
{
    public float $totalPrice;

    /**
     * __construct
     *
     * @param  float $totalPrice
     * @return void
     */
    function __construct(Float $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * getDeliveryPrice
     *
     * @return float
     */
    private function getDeliveryPrice(): float
    {
        if ($this->totalPrice > 90) {
            return 0;
        } elseif ($this->totalPrice > 50 && $this->totalPrice < 90) {
            return 2.95;
        } elseif ($this->totalPrice < 50) {
            return 4.95;
        } else {
            return 4.95;
        }
    }

    /**
     * apply
     *
     * @return float
     */
    public function apply(): float
    {
        $deliveryPrice = $this->getDeliveryPrice();
        $this->totalPrice += $deliveryPrice;

        return $this->totalPrice;
    }
}
