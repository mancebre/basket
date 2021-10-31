<?php

use App\Lib\Basket;

require 'vendor/autoload.php';

$productCatalog = [
    [
        "Product" => "Red Widget",
        "Code" => "R01",
        "Price" => 32.95
    ],
    [
        "Product" => "Green Widget",
        "Code" => "G01",
        "Price" => 24.95
    ],
    [
        "Product" => "Blue Widget",
        "Code" => "B01",
        "Price" => 7.95
    ]
];

$Basket = new Basket($productCatalog);

// Test case 1
$Basket->addProduct('B01');
$Basket->addProduct('G01');
echo "Test case 1:" . PHP_EOL;
echo "Products: B01, G01. ". PHP_EOL;
echo "Price: $" . $Basket->getTotalPrice() . PHP_EOL . PHP_EOL;
$Basket->clearBasket();

// Test case 2
$Basket->addProduct('R01');
$Basket->addProduct('R01');
echo "Test case 2:" . PHP_EOL;
echo "Products: R01, R01. " . PHP_EOL;
echo "Price: $". $Basket->getTotalPrice() . PHP_EOL . PHP_EOL;
$Basket->clearBasket();

// Test case 3
$Basket->addProduct('R01');
$Basket->addProduct('G01');
echo "Test case 3:" . PHP_EOL;
echo "Products: R01, G01. " . PHP_EOL;
echo "Price: $". $Basket->getTotalPrice() . PHP_EOL . PHP_EOL;
$Basket->clearBasket();

// Test case 4
$Basket->addProduct('B01');
$Basket->addProduct('B01');
$Basket->addProduct('R01');
$Basket->addProduct('R01');
$Basket->addProduct('R01');
echo "Test case 4:" . PHP_EOL;
echo "Products: B01, B01, R01, R01, R01. " . PHP_EOL;
echo "Price: $". $Basket->getTotalPrice() . PHP_EOL . PHP_EOL;
$Basket->clearBasket();

