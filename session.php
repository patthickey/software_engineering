<?php session_start(); ?>
<html><head><title>session</title></head>
<body>
<?php
include 'db.inc';
// Connect to MySQL DBMS
if (!($connection = @ mysql_connect($hostName, $username,
  $password)))
  showerror();
// Use the cars database
if (!mysql_select_db($databaseName, $connection))
  showerror();
 
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("SELECT id FROM login WHERE id='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session=$row['id'];

if(!isset($login_session)){
	mysql_close($connection); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}

?>
</body>
</html>