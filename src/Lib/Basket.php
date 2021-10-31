<?php

namespace App\Lib;

class Basket extends DeliveryChangeRules
{
    use SpecialOffer;

    private array $productCatalog;
    private float $totalPrice = 0;
    private array $orderedProducts;

    /**
     * @param array $productCatalog
     */
    function __construct(Array $productCatalog)
    {
        $this->productCatalog = $productCatalog;
    }

    /**
     * @param $productCode
     */
    public function addProduct($productCode)
    {
        $this->orderedProducts[] = $productCode;
        $this->totalPrice += $this->getProductPrice($productCode, $this->productCatalog);
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        $this->totalPrice = $this->getSpecialOfferDiscount(
            $this->productCatalog,
            $this->orderedProducts,
            $this->totalPrice
        );
        $this->totalPrice = $this->applyDeliveryPrice($this->totalPrice);
//        return number_format((float)$this->totalPrice, 2, '.', '');
        return  $this->totalPrice;
    }

    /**
     * @param String $productCode
     * @param array $productCatalog
     * @return mixed|void
     */
    protected function getProductPrice(String $productCode, Array $productCatalog)
    {
        foreach ($productCatalog as $product) {
            if ($product["Code"] === $productCode) {
                return $product["Price"];
            }
        }
    }

    public function clearBasket()
    {
        $this->orderedProducts = [];
        $this->totalPrice = 0;
    }
}