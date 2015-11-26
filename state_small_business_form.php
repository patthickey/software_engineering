<?php
session_start();
include 'sql_calls.php';
// Set variables from html page

$sbiz_name = $_POST['sbiz_name'];
$street = $_POST['sbiz_street'];
$aptNo = $_POST['sbiz_aptNo'];
$city = $_POST['sbiz_city'];
$state = $_POST['sbiz_state'];
$zipcode = $_POST['sbiz_zipcode'];
$owner_01_id = $_COOKIE['user_id'];
$owner_02_email = $_POST['sbiz_owner_02'];
$business_type = $_POST['sbiz_business_type'];
$income = $_POST['sbiz_income'];
$signature = $_POST['sbiz_signature'];
$date = date('Y-m-d');

	state_small_business_tax_form($sbiz_name, $street, $aptNo, $city, $state, $zipcode, $owner_01_id, $owner_02_email, $business_type, $income, $signature, $date);


	header("Location: http://project.patthickey.com");
	die();

?>

