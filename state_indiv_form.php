<?php
session_start();
include 'sql_calls.php';
// Set variables from html page

$id = $_COOKIE['user_id'];
$street = $_POST['indiv_street'];
$aptNo = $_POST['indiv_aptNo'];
$city = $_POST['indiv_city'];
$state = $_POST['indiv_state'];
$zipcode = $_POST['indiv_zipcode'];
$occupation = $_POST['indiv_occupation'];
$wages = $_POST['indiv_wages'];
$filing_status = $_POST['indiv_filing_status'];

$sp_f_name = $_POST['indiv_sp_f_name'];
$sp_m_name = $_POST['indiv_sp_m_name'];
$sp_l_name = $_POST['indiv_sp_l_name'];
$sp_ssn = $_POST['indiv_sp_ssn'];

$dep_f_name = $_POST['indiv_dep_f_name'];
$dep_l_name = $_POST['indiv_dep_l_name'];
$dep_ssn = $_POST['indiv_dep_ssn'];
$dep_relation = $_POST['indiv_dep_relation'];

$signature = $_POST['indiv_signature'];
$date = date('Y-m-d');

	individual_tax_form($id, $street, $aptNo, $city, $state, $zipcode, $occupation, $wages, $filing_status, $sp_f_name, $sp_m_name, $sp_l_name, $sp_ssn, $signature, $sig_date);
	if ($filing_status == 4)
		individual_tax_form_dependents($id, $dep_f_name, $dep_l_name, $dep_ssn, $dep_relation);

	header("Location: http://project.patthickey.com");
	die();

?>
