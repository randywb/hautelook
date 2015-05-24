<?php

Namespace Hautelook;

	session_start();

  	$_SESSION['cart'] = array();

	require_once("Cart.php");

	$cart = new Cart();

	// Scenario2: Add a 10 dollar item to an empty cart

	if ($cart->quantity == 0) {
		echo "Scenario 2: $".$cart->addItem("shirt");
	}

	?><br><?

	// Scenario3: Add an item twice

	array_push($_SESSION['cart'],$cart->addItem("tee"));
	array_push($_SESSION['cart'],$cart->addItem("tee"));

	echo "Scenario 3 - Quantity: ".$cart->checkQuantity($_SESSION['cart'], "tee");

	?><br><?

	// Scenario4: Add a 10 dollar item to a cart with a 5 dollar item

	$_SESSION['cart'] = array();

	array_push($_SESSION['cart'],$cart->addItem("tee"));
	array_push($_SESSION['cart'],$cart->addItem("shirt"));

	echo "Scenario 4 - Subtotal: $".$cart->setSubtotal($_SESSION['cart']);

	?><br><?

	// Scenario5: Apply a 10 percent coupon code to a cart with 10 dollars of items

	echo "Scenario 5 - 10% Coupon: $".$cart->applyTenPercent("shirt");

	?><br><?

	// Scenario6: Add a 2nd item to a cart after applying a discount

	$_SESSION['cart'] = array();

	echo "Scenario 6: $".$cart->addItem("tank");
	echo ", apply 10% coupon: $".$cart->applyTenPercent("tank");
	?><br><?

	// Scenario7: When order is under $100, and all items under 10 lb, then shipping is $5 flat

	$_SESSION['cart'] = array();

	array_push($_SESSION['cart'],$cart->addItem("dress-large"));
	array_push($_SESSION['cart'],$cart->addItem("skirt"));
	$subTotal = $cart->setSubtotal($_SESSION['cart']);
	echo "Scenario 7 - Subtotal: $".$subTotal;
	array_push($_SESSION['cart'],array("products" => array("dress-large", "skirt")));
	echo ", Total: $".($subTotal + $cart->applyShipping($subTotal,$_SESSION['cart']))." ($5 flat rate shipping)";
	?><br><?

	// Scenario8: When order is $100 or more, and each individual item is under 10 lb, then shipping is free

	$_SESSION['cart'] = array();

	array_push($_SESSION['cart'],$cart->addItem("dress-small"));
	array_push($_SESSION['cart'],$cart->addItem("skirt"));
	array_push($_SESSION['cart'],$cart->addItem("skirt"));
	$subTotal = $cart->setSubtotal($_SESSION['cart']);
	echo "Scenario 8 - Subtotal: $".$subTotal;
	array_push($_SESSION['cart'],array("products" => array("dress-small", "skirt")));
	echo ", Total: $".($subTotal + $cart->applyShipping($subTotal,$_SESSION['cart'])). " (Free shipping!)";
	?><br><?

	// Scenario9: Items over 10 lb always cost $20 each to ship
	
	$_SESSION['cart'] = array();

	array_push($_SESSION['cart'],$cart->addItem("dress-xlarge"));
	array_push($_SESSION['cart'],$cart->addItem("tee-large"));
	array_push($_SESSION['cart'],$cart->addItem("couch"));
	$subTotal = $cart->setSubtotal($_SESSION['cart']);
	echo "Scenario 9 - Subtotal: $".$subTotal;
	array_push($_SESSION['cart'],array("products" => array("dress-xlarge", "tee-large", "couch")));
	echo ", Total: $".($subTotal + $cart->applyShipping($subTotal,$_SESSION['cart']));
	
	?><br><?

	// Scenario10: Scenario10: Orders under $100 with 2 items over 10 lb should be $45 in shipping
	
	$_SESSION['cart'] = array();

	array_push($_SESSION['cart'],$cart->addItem("tee-large"));
	array_push($_SESSION['cart'],$cart->addItem("lamp"));
	array_push($_SESSION['cart'],$cart->addItem("end table"));
	$subTotal = $cart->setSubtotal($_SESSION['cart']);
	echo "Scenario 10 - Subtotal: $".$subTotal;
	array_push($_SESSION['cart'],array("products" => array("tee-large", "lamp", "end table")));
	echo ", Total: $".($subTotal + $cart->applyShipping($subTotal,$_SESSION['cart']));
	


?> 
