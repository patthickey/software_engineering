<?php session_start(); 
include 'sql_calls.php';

  $oldpw = $_POST['oldpass'];
  $newpw = $_POST['newpass1'];
  $user = $_COOKIE["user_id"];
  change_password($user,$oldpw,$newpw); 

?>
