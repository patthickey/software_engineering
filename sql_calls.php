<?php
session_start();
// Connect to MySQL DBMS
	
	$connection;
	$connected = False;

	function connect_to_db(){
		include 'db.inc';
		if (!($GLOBALS['$connection'] = @ mysql_connect($hostName, $username,
		  $password)))
		  showerror();
		// Use the cars database
		if (!mysql_select_db($databaseName, $GLOBALS['$connection']))
		  showerror();
		$GLOBALS['$connected'] = True;
	}
 
	function get_email($email)
	{
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysql_query($sql);
		return $result;
	}
	
	function sign_up($email_up, $hash, $first_name, $middle_name, $last_name, $SSN, $d_o_b, $privilege, $date)
	{

		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
	// Searching the email address in the database
		
		$result = get_email($email_up);
		$num_rows = mysql_num_rows($result);

	// Checking if the email address and adding accordingly, might need to check how that 1 is passed. Can't remember how to pass var
		if($num_rows == 0){
	    	$query = "INSERT INTO users (email, password, first_name, middle_name, last_name, SSN, date_of_birth, privilege, join_date) VALUES ('$email_up', '$hash', '$first_name', '$middle_name', '$last_name', '$SSN', '$d_o_b','$privilege', '$date')";
	    	if (!($result = @ mysql_query ($query, $GLOBALS['$connection'])))
	  	 	showerror();
		} else {
			echo '<script>';
			echo 'alert("Email is already registered");';
			echo 'location.href="index.html"';
			echo '</script>';
		}
		header('Location:index.html');
	}

	function sign_in($email, $password)
	{
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
	// Searching the email address in the database
		
		$result = get_email($email);
		$row = mysql_fetch_array($result);
		$hash = $row["password"];  

		//Unhashing the password to see if it matches what was entered.
		if (password_verify($password, $hash)) {
			$id = $row["id"];
			$_SESSION['login_user'] = "$id"; // Initializing Session
			header('Location:index.html');
		} else {
			echo '<script>';
			echo 'alert("Password is invalid");';
			echo 'location.href="index.html"';
			echo '</script>';
		}
	}

	

?>
