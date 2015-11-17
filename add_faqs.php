<?php
session_start();
include 'sql_calls.php';
// Set variables from html page
$add_faqs_question = $_POST['add_faqs_question'];
$add_faqs_answer = $_POST['add_faqs_answer'];

	add_faqs($add_faqs_question, $add_faqs_answer);

?>