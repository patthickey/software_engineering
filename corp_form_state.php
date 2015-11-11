<?php
session_start();
include 'sql_calls.php';

$id = $_COOKIE['user_id'];
$corp = $_POST['corp'];
$street = $_POST['street'];
$city = $_POST['city'];
$po_box = $_POST['po_box'];
$state = $_POST['post'];
$zipcode = $_POST['zipcode'];
$gross_income = $_POST['gross_income'];
$refund = $_POST['refund'];
$title = $_POST['title'];

$signature = $_POST['comp_signature'];
$date = date(Y-m-d);


corp_tax_form($id, $street, $po_box, $city, $state, $zipcode, $gross_income, $corp, $title, $refund, $signature, $date);



?>