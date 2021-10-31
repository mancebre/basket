# Basket

### requirements
* PHP 7.4
* composer
* git
* basic knowledge of PHP programing

### How to set up

#### Commands below should be run from command line

Git clone project by running:

`git clone `

Navigate to project root:

`cd basket`

Run composer update:

`composer update`

Run test script:

`php index.php`


## How to modify test data.

To modify test cases edit `index.php` file.

Available commands:

`$Basket = new Basket($productCatalog)` - initialise basket class.

`$Basket->addProduct('B01')` - adds one product to basket.

`$Basket->getTotalPrice()` - calculates total price with delivery cost and special offer discount for all products in basket.

`$Basket->clearBasket()` - removes all product from basket.
