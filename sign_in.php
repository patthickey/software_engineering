<?php
session_start();
include 'sql_calls.php';
// Set variables from html page
$email_in = $_POST['email_in'];
$password3 = $_POST['password3'];

	sign_in($email_in, $password3);

?>