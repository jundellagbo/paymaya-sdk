<?php

namespace PayMaya\Model\Checkout;

use PayMaya\Model\Checkout\Buyer;
use PayMaya\Model\Checkout\Address;
use PayMaya\Model\Checkout\Contact;

class User
{
	public $firstName;
	public $middleName;
	public $lastName;
	public $contact;
	public $shippingAddress;
	public $billingAddress;
	
	public function buyerInfo()
	{
		$buyer = new Buyer();
		$buyer->firstName = $this->firstName;
		$buyer->middleName = $this->middleName;
		$buyer->lastName = $this->lastName;
		$buyer->contact = $this->contact;
		$buyer->shippingAddress = $this->shippingAddress;
		$buyer->billingAddress = $this->billingAddress;
		return $buyer;
	}
}
