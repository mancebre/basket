<?php

namespace App\Lib;

trait SpecialOffer
{
    private string $specialOfferProductCode = 'R01';
    private int $repeatingProductsCount;

    /**
     * @param array $productCatalog
     * @param array $orderedProducts
     * @param Float $totalPrice
     * @return float
     */
    public function getSpecialOfferDiscount(Array $productCatalog, Array $orderedProducts, Float $totalPrice): float
    {
        $this->getRepeatingProducts($orderedProducts);
        return $this->applyDiscount($totalPrice, $productCatalog);
    }

    /**
     * @param Float $totalPrice
     * @param array $productCatalog
     * @return float
     */
    private function applyDiscount(Float $totalPrice, Array $productCatalog): float
    {
        $discountPerEach = $this->getProductDiscount($productCatalog);
        $discountTimes = floor($this->repeatingProductsCount / 2);

        return $totalPrice - ($discountPerEach * $discountTimes);
    }

    /**
     * @param array $productCatalog
     * @return float
     */
    protected function getProductDiscount(Array $productCatalog): float
    {
        foreach ($productCatalog as $product) {
            if ($product["Code"] === $this->specialOfferProductCode) {
                return $product["Price"] / 2;
            }
        }
        return 0;
    }

    /**
     * @param array $orderedProducts
     */
    private function getRepeatingProducts(Array $orderedProducts)
    {
        $allRepeatingProducts = array_count_values($orderedProducts);
        $this->repeatingProductsCount = $allRepeatingProducts[$this->specialOfferProductCode] ?? 0;
    }
}