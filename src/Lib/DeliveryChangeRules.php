<?php

namespace App\Lib;

class DeliveryChangeRules
{
    /**
     * @param Float $totalPrice
     * @return float
     */
    private function getDeliveryPrice(Float $totalPrice): float
    {
        if ($totalPrice > 90) {
            return 0;
        } elseif ($totalPrice > 50 && $totalPrice < 90) {
            return 2.95;
        } elseif ($totalPrice < 50) {
            return 4.95;
        } else {
            return 4.95;
        }
    }

    /**
     * @param Float $totalPrice
     * @return float
     */
    public function applyDeliveryPrice(Float $totalPrice): float
    {
        $deliveryPrice = $this->getDeliveryPrice($totalPrice);
        $totalPrice += $deliveryPrice;

        return $totalPrice;
    }
}