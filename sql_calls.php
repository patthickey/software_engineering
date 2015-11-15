<?php
session_start();
// Connect to MySQL DBMS
	
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// CONNECT TO DATABASE
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------	

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


// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// GETTERS
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------	


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
		$sql = "SELECT first_name, middle_name, last_name, email, SSN, date_of_birth FROM users WHERE id='$user_id'";
		$result = mysql_query($sql);
		$row = @ mysql_fetch_array($result);
		return $row; 

	}

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// SIGN UP / SIGN IN
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------


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
	  		sign_in($email, $password);
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

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// SENDING A MESSAGE
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------


	function get_send_email_info($message_call){
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
		$headers = 'From: irs.software.project@gmail.com' . "\r\n" .
		    'Reply-To: irs.software.project@gmail.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
	}

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// PRINT TAX BRACKETS
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------


	function print_individual_tax_brackets(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM tax_brackets ORDER BY tax_rate ASC";
		$result = mysql_query($sql);
		while ($row = @ mysql_fetch_array($result)) {
		echo"<tr>";
		echo"
		<td>{$row["tax_rate"]}</td>
		<td>{$row["single_filer_low"]} to {$row["single_filer_high"]}</td>
		<td>{$row["married_filing_together_low"]} to {$row["married_filing_together_high"]}</td>
		<td>{$row["married_filing_seperate_low"]} to {$row["married_filing_seperate_high"]}</td>
		<td>{$row["head_of_household_low"]} to {$row["head_of_household_high"]}</td>
		";
		echo"</tr>";
		}				
	}

	function print_commercial_tax_brackets(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM commercial_brackets ORDER BY tax_rate ASC";
		$result = mysql_query($sql);
		while ($row = @ mysql_fetch_array($result)) {
		echo"<tr>";
		echo"
		<td>{$row["tax_rate"]}</td>
		<td>{$row["income_low"]} to {$row["income_high"]}</td>
		";
		echo"</tr>";
		}				
	}

	function print_smallbiz_tax_brackets(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM smallbiz_brackets ORDER BY tax_rate ASC";
		$result = mysql_query($sql);
		while ($row = @ mysql_fetch_array($result)) {
		echo"<tr>";
		echo"
		<td>{$row["tax_rate"]}</td>
		<td>{$row["income_low"]} to {$row["income_high"]}</td>
		";
		echo"</tr>";
		}				
	}


// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// PRINT FAQS
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------


	function print_faqs(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM faqs";
		$result = mysql_query($sql);
		while ($row = @ mysql_fetch_array($result)) {
		echo'
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">'.$row["question"].'</h3>
          </div>
          <div class="panel-body">
            '.$row["answer"].'
          </div>
        </div>
        ';
		}
	}

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// USER FUNCTIONS
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
	
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

	function account_print_user_data($id){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM users WHERE id='$id'";
		$result = mysql_query($sql);
		echo'<form name="update_form" method="post" action=""';
		while ($row = @ mysql_fetch_array($result)) {
		echo"<tr>";
		//echo'<input type="hidden" name="user_id[]" value='.$row["id"].' readonly>';				
		echo'
		<tr>
		<td>
			<div class="form-group">
    		<input type="text" class="form-control" name = fname id="fname" placeholder='.$row["first_name"].'>
  			</div>
		</td>
		<td>
			<div class="form-group">
    		<input type="text" class="form-control" name = lname id="lname" placeholder='.$row["last_name"].'>
  			</div>
		</td>
		<td>
			<div class="form-group">
    		<input type="text" class="form-control" name = email id="email" placeholder='.$row["email"].'>
  			</div>
		</td>
		<td>
			<div class="form-group">
    		<input type="text" class="form-control" name = date_of_birth id="date_of_birth" placeholder='.$row["date_of_birth"].'>
  			</div>
  		</td>
		</tr>
		';

		
		echo"</tr>";
		}

		echo'<div class="button-box"><input type="submit" name="Submit" value="Submit" class="btn btn-success update_buttons"> 
		<input type="reset" value="Reset" type="button" class="btn btn-danger update_buttons reset_buttons"></div> 
		</form>';

		// if form has been submitted, process it
		$sql = "SELECT * FROM users WHERE id='$id'";
		$result = mysql_query($sql);
		$row = @ mysql_fetch_array($result);
		if($_POST["Submit"])
		{	
			
			if( $_POST["fname"] != NULL) {
				
				$fname = $_POST["fname"];
			} else {			
				$fname = $row["first_name"];
			  }

			if( $_POST["lname"] != NULL) {
					
				$lname = $_POST["lname"];
			} else {
				$lname = $row["last_name"];
			  }

			if( $_POST["email"] != NULL) {	
				$email = $_POST["email"];
			} else {
				$email = $row["email"];
			  }

			if( $_POST["date_of_birth"] != NULL) {	
				$date_of_birth = $_POST["date_of_birth"];
			} else {
				$date_of_birth = $row["date_of_birth"];
			  }

		    $sql1 = mysql_query("UPDATE users SET first_name = '$fname' , last_name = '$lname' , email = '$email' , date_of_birth = '$date_of_birth'  WHERE id= '$id'") or die(mysql_error());
		    
		}   
		
		// redirect user
		$_SESSION['success'] = 'Updated';
		header("location:index.php");
		
	}

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// FILING OUT TAX FORMS
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------


	function individual_tax_form($id, $street, $aptNo, $city, $state, $zipcode, $occupation, $wages, $filing_status, $sp_f_name, $sp_m_name, $sp_l_name, $sp_ssn, $signature, $sig_date){
	
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$user = get_user_data($id);
		$first_name = $user["first_name"];
		$middle_name = $user["middle_name"];
		$last_name = $user["last_name"];
		$SSN = $user["SSN"];
		$d_o_b = $user["date_of_birth"];

		$tax_rate = get_individual_tax_rate($filing_status, $wages);
		$tax_rate = $tax_rate / 100;
		$amount_due = $tax_rate * $wages;

    	$query = "INSERT INTO individual_forms VALUES ('$id', '$first_name', '$middle_name', '$last_name', '$SSN', '$d_o_b', '$street', '$aptNo', '$city', '$state', '$zipcode', '$occupation', '$wages', '$filing_status', '$sp_f_name', '$sp_m_name', '$sp_l_name', '$sp_ssn', '$signature', '$sig_date', '$amount_due')";
    	if (!($result = @ mysql_query ($query, $GLOBALS['$connection'])))
  	 		showerror();	
	}

	function individual_tax_form_dependents($id, $first_name, $last_name, $ssn, $relation){
	
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();

    	$query = "INSERT INTO individual_dependents VALUES ('$id', '$first_name', '$middle_name', '$last_name', '$ssn', '$relation')";
    	if (!($result = @ mysql_query ($query, $GLOBALS['$connection'])))
  	 		showerror();
	}

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// GET USER TAX RATES
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------

	
	function get_individual_tax_rate($filing_status, $wages){	
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		switch ($filing_status) {
			
		    case 1:
		        $sql = "SELECT tax_rate, single_filer_low, single_filer_high FROM tax_brackets";
		        $result = mysql_query($sql);
				while ($row = @ mysql_fetch_array($result)) {
					$low = $row["single_filer_low"];
					$high = $row["single_filer_high"];
					
					if (($low <= $wages) && ($high >= $wages))
						return $row["tax_rate"];
				}
		        break;
		    case 2:
		        $sql = "SELECT tax_rate, married_filing_together_low, married_filing_together_high FROM tax_brackets";
		        $result = mysql_query($sql);
				while ($row = @ mysql_fetch_array($result)) {
					$low = $row["married_filing_together_low"];
					$high = $row["married_filing_together_high"];
					
					if (($low <= $wages) && ($high >= $wages))
						return $row["tax_rate"];
				}
		        break;
		    case 3:
		        $sql = "SELECT tax_rate, married_filing_seperate_low, married_filing_seperate_high FROM tax_brackets";
		        $result = mysql_query($sql);
				while ($row = @ mysql_fetch_array($result)) {
					$low = $row["married_filing_seperate_low"];
					$high = $row["married_filing_seperate_high"];
					
					if (($low <= $wages) && ($high >= $wages))
						return $row["tax_rate"];
				}
		        break;
		    case 4:
		        $sql = "SELECT tax_rate, head_of_household_low, head_of_household_high FROM tax_brackets";
		        $result = mysql_query($sql);
				while ($row = @ mysql_fetch_array($result)) {
					$low = $row["head_of_household_low"];
					$high = $row["head_of_household_high"];
					
					if (($low <= $wages) && ($high >= $wages))
						return $row["tax_rate"];
				}
		        break;
				        
		    default:
		        echo "ERROR 01!";
		}
		return "ERROR 02!"; 
	}

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// ADMIN FUNCTIONS
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------

	function admin_update_privilege_level($email, $search_privilege_level){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM users WHERE email='$email' OR privilege='$search_privilege_level'";
		$result = mysql_query($sql);
		echo'<form name="update_form" method="post" action="">';
		while ($row = @ mysql_fetch_array($result)) {
		echo"<tr>";
		echo'<input type="hidden" name="user_id[]" value='.$row["id"].' readonly>';				
		echo"
		<td>{$row["first_name"]}</td>
		<td>{$row["last_name"]}</td>
		<td>{$row["email"]}</td>
		<td>{$row["privilege"]}</td>
		";

		echo'<td>
			<div class="form-group">
            <select class="form-control" name="update_privilege[]">
                <option value='.$row["privilege"].'>Current</option>      	
             	<option value="1">1</option>
            	<option value="2">2</option>
            	<option value="3">3</option>
            </select>
          	</div>
          	</td>';

		echo"</tr>";
		}

		echo'<div class="button-box"><input type="submit" name="Submit" value="Submit" class="btn btn-success update_buttons"> 
		<input type="reset" value="Reset" type="button" class="btn btn-danger update_buttons reset_buttons"></div> 
		</form>';

		// if form has been submitted, process it
		if($_POST["Submit"])
		{	

			$i = 0;
			foreach($_POST['user_id'] as $value)
		    {
	       		if( $_POST['update_privilege'][$i] != NULL) {
	       			$update = $_POST['update_privilege'][$i];
					$sql1 = mysql_query("UPDATE users SET privilege='$update' WHERE id='$value'") or die(mysql_error());
				}
				$i++;				
			}   
		}
		// redirect user
		$_SESSION['success'] = 'Updated';
		header("location:project.patthickey.com/search_privilege.html");
		
	}

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// UPDATE TAX BRACKETS
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------

	function update_individual_tax_brackets(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM tax_brackets ORDER BY tax_rate ASC";
		$result = mysql_query($sql);
		$ids_array = array();
		echo'<form name="update_tax_brackets" method="post" action=""';
		while ($row = @ mysql_fetch_array($result)) {	
		echo"
		<tr>";
		//echo'<input type="hidden" name="tax_id[]" value='.$row["id"].' readonly>';
		$ids_array[] = $row['id'];
		echo"<td>";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_tax_rate[]" id="update_tax_rate" placeholder='.$row["tax_rate"].'>
  			</div>';
		echo"</td>
		<td> {$row["single_filer_low"]} to ";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_single_filer_high[]" id="update_single_filer_high" placeholder='.$row["single_filer_high"].'>
  			</div>';
  		echo"
		</td>
		<td>{$row["married_filing_together_low"]} to ";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_married_filing_together_high[]" id="update_married_filing_together_high" placeholder='.$row["married_filing_together_high"].'>
  			</div>';
  		echo"		
		</td>
		<td>{$row["married_filing_seperate_low"]} to ";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_married_filing_seperate_high[]" id="update_married_filing_seperate_high" placeholder='.$row["married_filing_seperate_high"].'>
  			</div>';
  		echo"
		</td>
		<td>{$row["head_of_household_low"]} to ";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_head_of_household_high[]" id="update_head_of_household_high" placeholder='.$row["head_of_household_high"].'>
  			</div>';
  		echo"
		</td>
		</tr>";
		}	
		echo'<div class="button-box"><input type="submit" name="Submit" value="Submit" class="btn btn-success update_buttons"> 
		<input type="reset" value="Reset" type="button" class="btn btn-danger update_buttons reset_buttons"></div> 
		</form>';

		if($_POST["Submit"])
		{	

			$i = 0;
			foreach($ids_array as $value)
		    	{

				if( $_POST["update_tax_rate"][$i] != NULL) {
					$tax_rate = $_POST["update_tax_rate"][$i];
					$sql1 = mysql_query("UPDATE tax_brackets SET tax_rate='$tax_rate' WHERE id='$value'") or die(mysql_error());
				}

				if($_POST["update_single_filer_high"][$i] != NULL) {
					$update = $_POST["update_single_filer_high"][$i];
					if($value == end($ids_array))
						$test = 0;
					else
						$test = 1;				
					update_tax_brackets("tax_brackets", "single_filer_low", "single_filer_high", $update, $value, $test);
				}

				if($_POST["update_married_filing_together_high"][$i] != NULL) {
					$update = $_POST["update_married_filing_together_high"][$i];
					if($value == end($ids_array))
						$test = 0;
					else
						$test = 1;				
					update_tax_brackets("tax_brackets", "married_filing_together_low", "married_filing_together_high", $update, $value, $test);
				}

				if($_POST["update_married_filing_seperate_high"][$i] != NULL) {
					$update = $_POST["update_married_filing_seperate_high"][$i];
					if($value == end($ids_array))
						$test = 0;
					else
						$test = 1;				
					update_tax_brackets("tax_brackets", "married_filing_seperate_low", "married_filing_seperate_high", $update, $value, $test);
				}

				if($_POST["update_head_of_household_high"][$i] != NULL) {
					$update = $_POST["update_head_of_household_high"][$i];
					if($value == end($ids_array))
						$test = 0;
					else
						$test = 1;				
					update_tax_brackets("tax_brackets", "update_head_of_household_low", "update_head_of_household_high", $update, $value, $test);
				}

				$i++;
			   }   
		}

	}

	function update_commercial_tax_brackets(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM commercial_brackets ORDER BY tax_rate ASC";
		$result = mysql_query($sql);
		$ids_array = array();
		echo'<form name="update_tax_brackets" method="post" action=""';
		while ($row = @ mysql_fetch_array($result)) {	
		echo"
		<tr>";
		//echo'<input type="hidden" name="tax_id[]" value='.$row["id"].' readonly>';
		$ids_array[] = $row['id'];
		echo"<td>";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_com_tax_rate[]" id="update_com_tax_rate" placeholder='.$row["tax_rate"].'>
  			</div>';
		echo"</td>
		<td> {$row["income_low"]} to ";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_com_income_high[]" id="update_com_income_high" placeholder='.$row["income_high"].'>
  			</div>';
  		echo"
		</td>
		</tr>";
		}	
		echo'<div class="button-box"><input type="submit" name="Submit" value="Submit" class="btn btn-success update_buttons"> 
		<input type="reset" value="Reset" type="button" class="btn btn-danger update_buttons reset_buttons"></div> 
		</form>';

		if($_POST["Submit"])
		{	

			$i = 0;
			foreach($ids_array as $value)
		    	{

				if( $_POST["update_com_tax_rate"][$i] != NULL) {
					$tax_rate = $_POST["update_com_tax_rate"][$i];
					$sql1 = mysql_query("UPDATE commercial_brackets SET tax_rate='$tax_rate' WHERE id='$value'") or die(mysql_error());
				}

				if($_POST["update_com_income_high"][$i] != NULL) {
					$update = $_POST["update_com_income_high"][$i];
					if($value == end($ids_array))
						$test = 0;
					else
						$test = 1;				
					update_tax_brackets("commercial_brackets", "income_low", "income_high", $update, $value, $test);
				}

				$i++;
			   }   
		}
	}

	function update_smallbiz_tax_brackets(){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		$sql = "SELECT * FROM smallbiz_brackets ORDER BY tax_rate ASC";
		$result = mysql_query($sql);
		$ids_array = array();
		echo'<form name="update_tax_brackets" method="post" action=""';
		while ($row = @ mysql_fetch_array($result)) {	
		echo"
		<tr>";
		//echo'<input type="hidden" name="tax_id[]" value='.$row["id"].' readonly>';
		$ids_array[] = $row['id'];
		echo"<td>";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_biz_tax_rate[]" id="update_biz_tax_rate" placeholder='.$row["tax_rate"].'>
  			</div>';
		echo"</td>
		<td> {$row["income_low"]} to ";
		echo'<div class="form-group">
    			<input type="number" class="form-control" name="update_biz_income_high[]" id="update_biz_income_high" placeholder='.$row["income_high"].'>
  			</div>';
  		echo"
		</td>
		</tr>";
		}	
		echo'<div class="button-box"><input type="submit" name="Submit" value="Submit" class="btn btn-success update_buttons"> 
		<input type="reset" value="Reset" type="button" class="btn btn-danger update_buttons reset_buttons"></div> 
		</form>';

		if($_POST["Submit"])
		{	

			$i = 0;
			foreach($ids_array as $value)
		    	{

				if( $_POST["update_biz_tax_rate"][$i] != NULL) {
					$tax_rate = $_POST["update_biz_tax_rate"][$i];
					$sql1 = mysql_query("UPDATE smallbiz_brackets SET tax_rate='$tax_rate' WHERE id='$value'") or die(mysql_error());
				}

				if($_POST["update_biz_income_high"][$i] != NULL) {
					$update = $_POST["update_biz_income_high"][$i];
					if($value == end($ids_array))
						$test = 0;
					else
						$test = 1;				
					update_tax_brackets("smallbiz_brackets", "income_low", "income_high", $update, $value, $test);
				}

				$i++;
			   }   
		}
	}

	function update_tax_brackets($table, $low, $high, $update, $value, $test){
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();

		$sql1 = mysql_query("UPDATE $table SET $high='$update' WHERE id='$value'") or die(mysql_error());
		if($test == 1){
			$temp = $value + 1;
			$sql2 = "SELECT $high FROM $table WHERE id='$value'";
			$result2 = mysql_query($sql2);
			$row2 = @ mysql_fetch_array($result2);
			$low_update = $row2[$high] + 1;
			$sql3 = mysql_query("UPDATE $table SET $low='$low_update' WHERE id='$temp'") or die(mysql_error());					
		}
	}

// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// ????
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------



// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// ????
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------



// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------
// ????
// -------------------------------------------------------------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------	

?>
