<?php

require 'Product.php';
require 'Loggr.php';
require 'Loggr/EchoOut.php';
require 'PurchaseManager.php';

class PurchaseManagerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->product = new Product('Water', 5.99);
    }

    public function testCanMakePurchase()
    {
        $mockLogger = $this->getMock('stdClass', ['log']);
        $pm = new PurchaseManager();
        $pm->setLogger($mockLogger);

        $pm->purchase($this->product);

        $this->assertContainsOnly($this->product, $pm->purchaseHistory());
    }
}
