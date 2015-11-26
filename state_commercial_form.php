<?php
session_start();
include 'sql_calls.php';
// Set variables from html page

$comm_name = $_POST['comm_name'];
$street = $_POST['comm_street'];
$aptNo = $_POST['comm_aptNo'];
$city = $_POST['comm_city'];
$state = $_POST['comm_state'];
$zipcode = $_POST['comm_zipcode'];
$owner_01_id = $_COOKIE['user_id'];
$owner_02_email = $_POST['comm_owner_02'];
$business_type = $_POST['comm_business_type'];
$income = $_POST['comm_income'];
$signature = $_POST['comm_signature'];
$date = date('Y-m-d');

	state_commercial_tax_form($comm_name, $street, $aptNo, $city, $state, $zipcode, $owner_01_id, $owner_02_email, $business_type, $income, $signature, $date);

	header("Location: http://project.patthickey.com");
	die();

?>

