<?php

namespace App\Services;

use App\Contracts\Discount;

class DiscountService
{
    public Discount $discount;

    /**
     * applyDiscount
     *
     * @return void
     */
    public function applyDiscount()
    {
        return $this->discount->apply();
    }

    /**
     * __construct
     *
     * @param  mixed $discount
     * @return void
     */
    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * make
     *
     * @param  mixed $discount
     * @return object
     */
    public static function make(Discount $discount)
    {
        return new static($discount);
    }
}
