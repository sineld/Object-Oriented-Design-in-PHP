<?php

require '../TablePrinter.php';
require 'Loggr.php';
require 'Loggr/EchoOut.php';
require 'Product.php';
require 'PurchaseManager.php';

$logger = new Loggr(new Loggr\EchoOut);
$pm = new PurchaseManager();
$pm->setLogger($logger);

$store = [
    new Product('Juice', '1.99'),
    new Product('Milk', '3.99'),
    new Product('Water', '0.99')
];

$pm->purchase($store[0]);
$pm->purchase($store[1]);
$pm->purchaseDiscountedProduct($store[2], 50);

$tp = new TablePrinter(['Product', 'Price']);

echo "You've purchased:\n";
foreach ($pm->purchaseHistory() as $purchase) {
    $tp->addRow($purchase->getName(), '$'.$purchase->getPrice());
}

$tp->output();
