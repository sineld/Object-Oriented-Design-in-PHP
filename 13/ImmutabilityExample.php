<?php

class Product
{
    protected $name;
    protected $price;

    public function __construct($name, $price)
    {
        $this->name    = $name;
        $this->price   = $price;
    }

    public function getName() { return $this->name; }
    public function getPrice() { return money_format('%.2n', $this->price); }
}

class PurchaseManager
{
    protected $purchases;

    public function purchaseDiscountedProduct($product, $discountPercentage)
    {
        $origPrice = $product->getPrice();
        $newPrice = $origPrice - (($discountPercentage / 100) * $origPrice);

        $discountedProduct = new Product($product->getName(), $newPrice);
        $this->purchase($discountedProduct);
    }

    public function purchase($product)
    {
        $this->purchases[] = $product;
    }

    public function purchaseHistory()
    {
        return $this->purchases;
    }
}
