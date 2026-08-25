<?php
require 'vendor/autoload.php';
require_once 'Librerias/class.Cart.php';
$cart = new Cart();
$cart->add(1, 1, ['price' => 15, 'nombre' => 'ACEITE OLIVA']);
echo "Total: " . $cart->getAttributeTotal('price') . "\n";
$items = $cart->getItems();
var_dump($items);
