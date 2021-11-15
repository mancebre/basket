<?php

namespace App\Lib;

use App\Lib\SpecialOffer;
use App\Lib\DeliveryChangeRules;

class Basket extends DeliveryChangeRules
{
    private array $productCatalog;
    public float $totalPrice = 0;
    private array $orderedProducts;

    /**
     * __construct
     *
     * @param  mixed $productCatalog
     * @return void
     */
    function __construct(array $productCatalog)
    {
        $this->productCatalog = $productCatalog;
    }

    /**
     * addProduct
     *
     * @param  mixed $productCode
     * @return void
     */
    public function addProduct($productCode)
    {
        $this->orderedProducts[] = $productCode;
        $this->totalPrice += $this->getProductPrice($productCode, $this->productCatalog);
    }

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
        $this->totalPrice = $specialOffer->apply();

        $deliveryChangeRules = new DeliveryChangeRules($this->totalPrice);
        $this->totalPrice = $deliveryChangeRules->apply();

        return  $this->totalPrice;
    }

    /**
     * getProductPrice
     *
     * @param  mixed $productCode
     * @param  mixed $productCatalog
     * @return float
     */
    protected function getProductPrice(String $productCode, array $productCatalog)
    {
        foreach ($productCatalog as $product) {
            if ($product["Code"] === $productCode) {
                return $product["Price"];
            }
        }

        return 0;
    }

    /**
     * clearBasket
     *
     * @return void
     */
    public function clearBasket()
    {
        $this->orderedProducts = [];
        $this->totalPrice = 0;
    }
}
