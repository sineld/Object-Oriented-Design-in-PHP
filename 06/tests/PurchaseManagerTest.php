<?php

require 'Product.php';
require 'Loggr.php';
require 'Loggr/EchoOut.php';
require 'PurchaseManager.php';
require 'IoC.php';

class PurchaseManagerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        IoC::register('Logger', function() {
            return $this->getMock('stdClass', ['log']);
        });

        IoC::register('Product', function($name, $price) {
            return new Product($name, $price);
        });

        $this->product = new Product('Water', 5.99);
    }

    public function testCanMakePurchase()
    {
        $pm = new PurchaseManager();

        $pm->purchase($this->product);

        $this->assertContainsOnly($this->product, $pm->purchaseHistory());
    }
}
