<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
include __DIR__ . "/cart.php";


$cart = new Cart;

$cart->addProduct(1);
//debugging
$cart->addProduct(2);
$cart->addProduct(3, 5);
$cart->addProduct(1);
// $cart->removeProduct(3);
echo "Final cart items";
echo "<pre>";
print_r($cart->items);
echo "</pre>";

echo "Total Prices";
echo "<pre>";
echo $cart->getTotalPrice();
echo "</pre>";

echo "Total Items";
echo "<pre>";
echo $cart->getTotalItems();
echo "</pre>";

echo "Print Cart";
echo $cart->printCart();

