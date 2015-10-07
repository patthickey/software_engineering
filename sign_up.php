<?php
session_start();
include 'db.inc';
// Connect to MySQL DBMS
if (!($connection = @ mysql_connect($hostName, $username,
  $password)))
  showerror();
// Use the cars database
if (!mysql_select_db($databaseName, $connection))
  showerror();
 
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

// Searching the email address in the database
	$sql = "SELECT * FROM users WHERE email='$email_up'";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);

// Checking if the email address and adding accordingly, might need to check how that 1 is passed. Can't remember how to pass var
	if($num_rows == 0){
    	$query = "INSERT INTO users (email, password, first_name, middle_name, last_name, SSN, date_of_birth, privilege, join_date) VALUES ('$email_up', '$hash', '$first_name', '$middle_name', '$last_name', '$SSN', '$d_o_b','$privilege', '$date')";
    	if (!($result = @ mysql_query ($query, $connection)))
  	 	showerror();
	} else {
		echo '<script>';
		echo 'alert("Email is already registered");';
		echo 'location.href="index.html"';
		echo '</script>';
	}
	header('Location:index.html');
//echo('<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index.html">');
?>
