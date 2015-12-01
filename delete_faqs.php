<?php
session_start();
include 'sql_calls.php';
// Set variables from html page
$delete_faq = $_POST['delete_faq'];

	delete_faqs($delete_faq);

?>