<?php

namespace App\Lib;

use App\Contracts\Discount;

class SpecialOffer implements Discount
{
    private string $specialOfferProductCode = 'R01';
    private int $repeatingProductsCount;
    public array $productCatalog;
    public array $orderedProducts;
    public Float $totalPrice;

    /**
     * __construct
     *
     * @param  mixed $productCatalog
     * @param  mixed $orderedProducts
     * @param  mixed $totalPrice
     * @return void
     */
    function __construct(array $productCatalog, array $orderedProducts, Float $totalPrice)
    {
        $this->productCatalog = $productCatalog;
        $this->orderedProducts = $orderedProducts;
        $this->totalPrice = $totalPrice;
    }

    /**
     * apply
     *
     * @return float
     */
    public function apply(): float
    {
        $this->getRepeatingProducts($this->orderedProducts);
        return $this->applyDiscount($this->totalPrice, $this->productCatalog);
    }

    /**
     * applyDiscount
     *
     * @return float
     */
    private function applyDiscount(): float
    {
        $discountPerEach = $this->getProductDiscount($this->productCatalog);
        $discountTimes = floor($this->repeatingProductsCount / 2);

        return $this->totalPrice - ($discountPerEach * $discountTimes);
    }

    /**
     * getProductDiscount
     *
     * @param  mixed $productCatalog
     * @return float
     */
    protected function getProductDiscount(array $productCatalog): float
    {
        foreach ($productCatalog as $product) {
            if ($product["Code"] === $this->specialOfferProductCode) {
                return $product["Price"] / 2;
            }
        }
        return 0;
    }

    /**
     * getRepeatingProducts
     *
     * @param  mixed $orderedProducts
     * @return void
     */
    private function getRepeatingProducts(array $orderedProducts)
    {
        $allRepeatingProducts = array_count_values($orderedProducts);
        $this->repeatingProductsCount = $allRepeatingProducts[$this->specialOfferProductCode] ?? 0;
    }
}
