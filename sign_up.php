<?php
session_start();
include 'sql_calls.php';
// Set variables from html page
$email_up = $_POST['email_up'];
$password1 = $_POST['password1'];
$hash = password_hash($password1, PASSWORD_DEFAULT);
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$SSN = $_POST['SSN'];
$d_o_b = $_POST['d_o_b'];
$date = date('Y-m-d');
$privilege = 1; 
	
	sign_up($email_up, $hash, $first_name, $middle_name, $last_name, $SSN, $d_o_b, $privilege, $date);

?>
