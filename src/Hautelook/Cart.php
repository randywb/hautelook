<?php
namespace Hautelook;

class Cart
{

   public function __construct()
   {

	$this->products = array("tee" => array("price" => 5, "weight" => 0),
				   "tee-large" => array("price" => 10, "weight" => 1),
				   "shirt" => array("price" => 10, "weight" => 0),
			    	   "tank" => array("price" => 10, "weight" => 0),
				   "dress-small" => array("price" => 68, "weight" => 2),
				   "dress-large" => array("price" => 78, "weight" => 2),
				   "dress-xlarge" => array("price" => 80, "weight" => 2),
				   "skirt" => array("price" => 20, "weight" => 1),
				   "couch" => array("price" => 50, "weight" => 100),
				   "lamp" => array("price" => 25, "weight" => 15),
				   "end table" => array("price" => 50, "weight" => 25));

   }

    public function addItem($item)
    {
       return $this->checkSubtotal($this->products[$item]);
    }

    public function checkQuantity(array $cart, $product)
    {
       $this->result = array_count_values($cart);
	$this->price = $this->products[$product]["price"];
	
	return $this->result[$this->price];
    }
    private function checkSubtotal(array $subtotal)
    {
        return $subtotal["price"];
    }
    public function setSubtotal(array $cart)
    {
	$this->subTotal = 0;

	foreach ($cart as $item) {
    		$this->subTotal += $item;
	}
      
	return $this->subTotal;
    }

    public function applyTenPercent($item)
    {
       return ($this->checkSubtotal($this->products[$item]) * .9);
    }
    public function applyShipping($subTotal,array $cart)
    {
	$this->shippingRate = 0;

	// add total weight of cart

	foreach ($cart as $item) {
		if (isset($item['products'])) { 
			foreach ($item['products'] as $myProduct) {
			   if ($this->products[$myProduct]['weight'] > 10) {
				$this->shippingRateItem += 20;
			   } else { 	   
			   	$this->shippingWeight += $this->products[$myProduct]['weight'];
			   }			  
			}
		}
 	}
	
	if ($subTotal < 100) {
		if ($this->shippingWeight < 10) {
			$this->shippingRate = 5;
		} else {
			$this->shippingRate = 45;
			$this->shippingRateItem = 0;
		}
	} else {
		if ($this->shippingWeight < 10) {
			$this->shippingRate = 0;
		}
	}
	return $this->shippingRate + $this->shippingRateItem;
    }

} 
