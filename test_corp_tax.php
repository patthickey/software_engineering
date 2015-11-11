<?php
function corp_tax_form($id, $street, $po_box, $city, $state, $zipcode, $gross_income, $corp, $title, $refund, $signature, $date){
	if ($GLOBALS['connected'] == False)
		connect_to_db();
	$tax_rate = get_company_tax_rate($gross_income);
	$tax_rate = $tax_rate / 100;
	$amount_due = $tax_rate * $gross_income;

	$query = "INSERT INTO individual_forms VALUES ('$id', '$street', '$po_box', '$city', '$state', '$zipcode', '$gross_income', '$corp', '$title', '$refund', '$signature', '$date')";
    if (!($result = @ mysql_query ($query, $GLOBALS['$connection'])))
  		showerror();

	header("Location: http://project.patthickey.com");
	die();


}

function get_company_tax_rate($gross_income){	
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		
		    $sql = "SELECT tax_rate, income FROM scommercial_brackets";
		    $result = mysql_query($sql);
			while ($row = @ mysql_fetch_array($result)) {
				$low = $row["income_low"];					
				$high = $row["income_high"];
					
				if (($low <= $gross_income) && ($high >= $gross_income))
						return $row["tax_rate"];
				}
		        
	}
?>

<?php
function smallbiz_tax_form($id, $street, $po_box, $city, $state, $zipcode, $total_income, $small_biz, $num_of_employees, $refund, $signature, $date){
	if ($GLOBALS['connected'] == False)
		connect_to_db();
	$tax_rate = get_company_tax_rate($total_income);
	$tax_rate = $tax_rate / 100;
	$amount_due = $tax_rate * $total_income;

	$query = "INSERT INTO individual_forms VALUES ('$id', '$street', '$po_box', '$city', '$state', '$zipcode', '$total_income', '$small_biz', '$num_of_employees', '$refund', '$signature', '$date')";
    if (!($result = @ mysql_query ($query, $GLOBALS['$connection'])))
  		showerror();

	header("Location: http://project.patthickey.com");
	die();


}

function get_smallbiz_tax_rate($gross_income){	
		if ($GLOBALS['$connected'] == False) 
			connect_to_db();
		
		    $sql = "SELECT tax_rate, income FROM smallbiz_brackets";
		    $result = mysql_query($sql);
			while ($row = @ mysql_fetch_array($result)) {
				$low = $row["income_low"];					
				$high = $row["income_high"];
					
				if (($low <= $total_income) && ($high >= $total_income))
						return $row["tax_rate"];
				}
		        
	}
?>

