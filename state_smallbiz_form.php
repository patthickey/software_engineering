<?php
session_start();
include 'sql_calls.php';

$id = $_COOKIE['user_id'];
$small_biz = $_POST['small_biz'];
$street = $_POST['street'];
$city = $_POST['city'];
$po_box = $_POST['po_box'];
$state = $_POST['post'];
$zipcode = $_POST['zipcode'];
$total_income = $_POST['total_income'];
$refund = $_POST['refund'];
$num_of_employees = $_POST['num_of_employees'];

$signature = $_POST['biz_signature'];
$date = date(Y-m-d);


smallbiz_tax_form($id, $street, $po_box, $city, $state, $zipcode, $total_income, $small_biz, $num_of_employees, $refund, $signature, $date);



?>