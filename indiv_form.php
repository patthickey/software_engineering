<?php
session_start();
include 'sql_calls.php';
// Set variables from html page

$id = $_COOKIE['login_user'];
$steet = $_POST['indiv_steet'];
$aptNo = $_POST['indiv_aptNo'];
$city = $_POST['indiv_city'];
$state = $_POST['indiv_state'];
$zipcode = $_POST['indiv_zipcode'];
$sp_f_name = $_POST['indiv_sp_f_name'];
$sp_m_name = $_POST['indiv_sp_m_name'];
$sp_l_name = $_POST['indiv_sp_l_name'];
$sp_ssn = $_POST['indiv_sp_ssn'];
$filing_status = $_POST['indiv_filing_status'];

$dep_f_name = $_POST['indiv_dep_f_name'];
$dep_l_name = $_POST['indiv_dep_l_name'];
$dep_ssn = $_POST['indiv_dep_ssn'];
$dep_relation = $_POST['indiv_dep_relation'];

$wages = $_POST['indiv_wages'];
$signature = $_POST['indiv_signature'];
$date = date('Y-m-d');
$occupation = $_POST['indiv_occupation'];


	individual_tax_form($id, $street, $aptNo, $city, $state, $zipcode, $sp_f_name, $sp_m_name, $sp_snn, $filing_status, $wages, $signature, $date, $occupation);
	if ($filing_status == 4)
		individual_tax_form_dependents($id, $dep_f_name, $dep_l_name, $dep_ssn, $dep_relation);


?>
