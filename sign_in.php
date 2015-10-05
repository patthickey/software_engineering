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
$email_in = $_POST['email_in'];
$password3 = $_POST['password3'];

// Searching for the email and password
$query = mysql_query("SELECT * FROM users WHERE email = '$email_in'");
$row = mysql_fetch_array($query);
$hash = $row["password"];  

//Unhashing the password to see if it matches what was entered.
if (password_verify($password3, $hash)) {
	$id = $row["id"];
	$_SESSION['login_user'] = "$id"; // Initializing Session
	header('Location:main_page.html');
} else {
	echo '<script>';
	echo 'alert("Password is invalid");';
	echo 'location.href="index.html"';
	echo '</script>';
}

?>