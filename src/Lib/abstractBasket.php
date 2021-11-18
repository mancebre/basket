<?php

namespace App\Lib;

abstract class AbstractBasket
{
    protected array $productCatalog;
    public float $totalPrice = 0;
    protected array $orderedProducts;

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

    /**
     * getTotalPrice
     *
     * @return float
     */
    abstract public function getTotalPrice(): float;
}
