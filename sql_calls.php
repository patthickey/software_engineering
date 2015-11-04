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

	function get_ssn($ssn)
	{
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM users WHERE SSN='$ssn'";
		$result = mysql_query($sql);
		return $result;
	}	

	function get_privilege()
	{		
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$id = $_SESSION['login_user'];
		$sql = "SELECT privilege FROM users WHERE id='$id'";
		$result = mysql_query($sql);
		$row = @ mysql_fetch_array($result);
		return $row["privilege"];
	}

	function get_name()
	{
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT first_name FROM users WHERE email='$email'";
		$result = mysql_query($sql);
		$row = @ mysql_fetch_array($result);
		return $row["first_name"];
	}

	function get_user_data($user_id)
	{	
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$user_info = "SELECT first_name, middle_name, last_name, email, date_of_birth FROM users WHERE id='$user_id'";
		$info = mysql_fetch_array($user_info);
		return $info; 

	}	

	function sign_up($email, $hash, $first_name, $middle_name, $last_name, $SSN, $d_o_b, $privilege, $date)
	{

		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
	// Searching the email address in the database

		$email_result = get_email($email);
		$email_num_rows = mysql_num_rows($email_result);

		$ssn_result = get_ssn($SSN);
		$ssn_num_rows = mysql_num_rows($ssn_result);	

	// Checking if the email address and adding accordingly, might need to check how that 1 is passed. Can't remember how to pass var
		if(($email_num_rows == 0)&&($ssn_num_rows == 0)){
	    	$query = "INSERT INTO users (email, password, first_name, middle_name, last_name, SSN, date_of_birth, privilege, join_date) VALUES ('$email', '$hash', '$first_name', '$middle_name', '$last_name', '$SSN', '$d_o_b','$privilege', '$date')";
	    	if (!($result = @ mysql_query ($query, $GLOBALS['$connection'])))
	  	 	showerror();
	  		send_email($email, "sign_up");
		} else {
			echo '<script>';
			echo 'alert("Email or SNN is already registered");';
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

			$privilege = get_privilege();
			setcookie("user_id", $id);
			setcookie("user_priv", $privilege);
			
			//session_id('$id');
			session_start();
			header('Location:index.html');
		} else {
			echo '<script>';
			echo 'alert("Password is invalid");';
			echo 'location.href="index.html"';
			echo '</script>';
		}
	}

	function get_email_info($message_call){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM Messages WHERE message_call='$message_call'";
		$result = mysql_query($sql);
		$row = @ mysql_fetch_array($result);
		return $row;		
	}

	function send_email($email, $message_call)
	{
		$to      = $email;
		$email_info = get_email_info($message_call);
		$subject = $email_info["subject"];
		$message = $email_info["message"];
		$headers = 'From: patthickey@gmail.com' . "\r\n" .
		    'Reply-To: patthickey@gmail.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
	}

	function get_tax_brackets(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM tax_brackets ORDER BY tax_rate ASC";
		$result = mysql_query($sql);
		while ($row = @ mysql_fetch_array($result)) {
		echo"<tr>";
		echo"
		<td>{$row["tax_rate"]}</td>
		<td>{$row["single_filer_low"]}</td>
		<td>{$row["single_filer_high"]}</td>
		<td>{$row["married_filing_together_low"]}</td>
		<td>{$row["married_filing_together_high"]}</td>
		<td>{$row["married_filing_seperate_low"]}</td>
		<td>{$row["married_filing_seperate_high"]}</td>
		<td>{$row["head_of_household_low"]}</td>
		<td>{$row["head_of_household_high"]}</td>
		";
		echo"</tr>";
		}				
	}

	function get_commercial_tax_brackets(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM commercial_brackets ORDER BY tax_rate ASC";
		$result = mysql_query($sql);
		while ($row = @ mysql_fetch_array($result)) {
		echo"<tr>";
		echo"
		<td>{$row["tax_rate"]}</td>
		<td>{$row["income_low"] to $row["income_high"]}</td>
		";
		echo"</tr>";
		}				
	}

	function print_user_data($user_id){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT first_name, middle_name, last_name, email, date_of_birth FROM users WHERE id='$user_id'";
		$result = mysql_query($sql);
		while ($row = @ mysql_fetch_array($result)) {
		echo"<tr>";
		echo"
		<td>{$row["first_name"]}</td>
		<td>{$row["middle_name"]}</td>
		<td>{$row["last_name"]}</td>
		<td>{$row["email"]}</td>
		<td>{$row["date_of_birth"]}</td>
		";
		echo"</tr>";
		}
	}


?>
