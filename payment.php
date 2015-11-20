<?php

include("lib/paypal_checkout/paypal.php");
$pp = new paypalcheckout();
$pp -> addMultipleItems($itemss);

public funtion_construct($config = ""){


$settings = array(
'business' => 'Cool1@cool.com',
'currency' => 'USD'
'cursymbol' => '$'
'returnurl' => 'http://project.patthickey.com'
'returntxt' => 'Go Home weezy'
'cancelurl' => ''
);

if(!empty($config)){
	foreach ($config as $key => $val){
		if (!empty($val)){
		$settings[$key] = $val;
		}
	}
}


$this -> business = $settings['business'];
$this -> currency = $settings['currency'];
$this -> cursymbol = $settings['cursymbol'];
$this -> returnurl = $settings['returnurl'];
$this -> returntxt = $settings['business'];
$this -> pay = array();





}

$pay = array(
1 => array (

	"name" => "Taxes",
	"price" => "compute from tax bracket"
);

public function addTaxPayment($pay){
	$pay = $this -> pay;
	$pay[] = $pay;
	$this -> pay = $pay;
	}
}
echo getCartContentAsHtml();
echo $pp-> getCheckOutForm();


/*<ul id = "cart">
	<li class = "cartitem"> Refund </li>
</ul>

<form id = "paypal_checkout" action = "https://www.paypal.com/cgi-bin/webscr" method = "post">
	<input name = "cmd" value = "_cart" type = "hidden">
	<input name = "upload" value = "1" type = "hidden">
	<input name = "no_note" value = "0" type = "hidden">
	<input name = "bn" value = "PP-BuyNowBF" type = "hidden">
	<input name = "tax" value = "0" type = "hidden">
	<input name = "business" value = "Cool1@hotmail.com" type = "hidden">
	<input name = "handling_cart" value = "0" type = "hidden">
	<input name = "currency_code" value = "USD" type = "hidden">
	<input name = "lc" value = "$" type = "hidden">
	<input name = "return" value = "http://project.patthickey.com" type = "hidden">
	<input name = "cbt" value = "Return to Site" type = "hidden">
	<input name = "custom" value = " " type = "hidden">


	<div id = "pay" class = "itemwrap">
		<input name = "pay" value = "Amount Due" type = "hidden">
	</div>
</form>
*/

?>
