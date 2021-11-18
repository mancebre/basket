<?php

namespace App\Lib;

use App\Lib\SpecialOffer;
use App\Lib\DeliveryChangeRules;
use App\Services\DiscountService;
use App\Lib\AbstractBasket;

class Basket extends AbstractBasket
{

    /**
     * getTotalPrice
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        $specialOffer = new SpecialOffer(
            $this->productCatalog,
            $this->orderedProducts,
            $this->totalPrice
        );
        $this->totalPrice = DiscountService::make($specialOffer)->applyDiscount();

        $deliveryChangeRules = new DeliveryChangeRules($this->totalPrice);
        $this->totalPrice = DiscountService::make($deliveryChangeRules)->applyDiscount();

        return  $this->totalPrice;
    }
}
