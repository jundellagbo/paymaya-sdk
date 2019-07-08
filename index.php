<?php

require 'vendor/autoload.php';

use PayMaya\PayMayaSDK;
use PayMaya\API\Checkout;
use PayMaya\Model\Checkout\Item;
use PayMaya\Model\Checkout\ItemAmount;
use PayMaya\Model\Checkout\ItemAmountDetails;
use PayMaya\Model\Checkout\User;
use PayMaya\Model\Checkout\Address;
use PayMaya\Model\Checkout\Contact;
use PayMaya\API\Customization;

PayMayaSDK::getInstance()
->initCheckout(
    "pk-NCLk7JeDbX1m22ZRMDYO9bEPowNWT5J4aNIKIbcTy2a", 
    "sk-8MqXdZYWV9UJB92Mc0i149CtzTWT7BYBQeiarM27iAi", 
    "SANDBOX"
);

$shopCustomization = new Customization();
$shopCustomization->logoUrl = "https://payments-web-sandbox.paymaya.com/images/payMayaLogo.svg";
$shopCustomization->iconUrl = "https://payments-web-sandbox.paymaya.com/images/payMayaLogo.svg";
$shopCustomization->appleTouchIconUrl = "https://payments-web-sandbox.paymaya.com/images/payMayaLogo.svg";
$shopCustomization->customTitle = "Paymaya Payment Testing";
$shopCustomization->colorScheme = "#79bd55";
$shopCustomization->set();

// Item
$itemAmountDetails = new ItemAmountDetails();
$itemAmountDetails->shippingFee = "14.00";
$itemAmountDetails->tax = "5.00";
$itemAmountDetails->subtotal = "50.00";
$itemAmount = new ItemAmount();
$itemAmount->currency = "PHP";
$itemAmount->value = "69.00";
$itemAmount->details = $itemAmountDetails;
$item = new Item();
$item->name = "Leather Belt";
$item->code = "pm_belt";
$item->description = "Medium-sized belt made from authentic leather";
$item->quantity = "1";
$item->amount = $itemAmount;
$item->totalAmount = $itemAmount;

// User
$user = new User();
$user->firstName = "John";
$user->middleName = "Michaels";
$user->lastName = "Doe";
$user->contact = "+63(2)1234567890";
$user->shippingAddress = "paymayabuyer1@gmail.com";
$user->billingAddress;

// Contact
$contact = new Contact();
$contact->phone = "+63(2)1234567890";
$contact->email = "paymayabuyer1@gmail.com";
$user->contact = $contact;

// Address
$address = new Address();
$address->line1 = "9F Robinsons Cybergate 3";
$address->line2 = "Pioneer Street";
$address->city = "Mandaluyong City";
$address->state = "Metro Manila";
$address->zipCode = "12345";
$address->countryCode = "PH";
$user->shippingAddress = $address;
$user->billingAddress = $address;

// Checkout
$itemCheckout = new Checkout();
$itemCheckout->buyer = $user->buyerInfo();
$itemCheckout->items = array($item);
$itemCheckout->totalAmount = $itemAmount;
$itemCheckout->requestReferenceNumber = "123456789";
$itemCheckout->redirectUrl = array(
	"success" => "http://localhost/paymaya/success.php",
	"failure" => "http://localhost/paymaya/failure.php",
	"cancel" => "http://localhost/paymaya/cancel.php"
	);

$itemCheckout->execute();

echo "Checkout ID: " . $itemCheckout->id . "\n";
echo "Checkout URL: " . $itemCheckout->url . "\n";