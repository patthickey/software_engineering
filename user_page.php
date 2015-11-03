<?php session_start(); 
include 'db.inc';
// Connect to MySQL DBMS
if (!($connection = @ mysql_connect($hostName, $username,
  $password)))
  showerror();
// Use the cars database
if (!mysql_select_db($databaseName, $connection))
  showerror();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Patt Hickey">  
    <title>fan feed +</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div id="headerfile"></div>
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
      
<h2>USER INFO</h2>
<table border=1 id="user_page_info">
<tr><th>SCREEN NAME</th><th>JOIN DATE</th><th>MESSAGE</th></tr>
<?php

if (isset($_POST['user_name'])) { 
    $SN = $_POST['user_name']; } 
    else { 
    $SN = $_GET['user_name']; 
}

$user_info = "SELECT id, app_screen_name, join_date, message FROM users a, messages b WHERE a.app_screen_name='$SN' AND a.id=b.user_id";
if (!($user_result = @ mysql_query ($user_info, $connection)))
  showerror();
$user_num_rows = mysql_num_rows($user_result);

if($user_num_rows == 0){
  echo '<script>';
  echo 'alert("User not found!");';
  echo 'location.href="main_page.html"';
  echo '</script>';
}else{
  while ($row = @ mysql_fetch_array($user_result)) {
    echo "<tr>
    <td>{$row["app_screen_name"]}</td>
    <td>{$row["join_date"]}</td>
    <td>{$row["message"]}</td>
    </tr>";
    $id = $row["id"];
}
}



?>
</table>


<h2>HAVES</h2>
<table border=1>
<tr><th>PARALLEL</th><th>FACTION</th><th>IN SET</th><th>CARD NAME</th><th>COLOR</th><th># IN SET</th><th>RARITY</th><th>SOLD OUT</th><th>SERIES</th><th>FOR TRADE</th></tr>
<?php

//$SN = $_POST['app_screen_name'];
$haves = "SELECT id, parallel, faction, in_set, card_name, color, number_in_set, rarity, sold_out, series, trading FROM have_list a, cards b WHERE a.user_id='$id' AND b.id=a.card_id";
if (!($have_result = @ mysql_query ($haves, $connection)))
  showerror();

while ($row = @ mysql_fetch_array($have_result)) {
  echo "<tr>
  <td>{$row["parallel"]}</td>
  <td>{$row["faction"]}</td>
  <td>{$row["in_set"]}</td>
  <td>{$row["card_name"]}</td>
  <td>{$row["color"]}</td>
  <td>{$row["number_in_set"]}</td>
  <td>{$row["rarity"]}</td>
  <td>{$row["sold_out"]}</td>
  <td>{$row["series"]}</td>
  <td>{$row["trading"]}</td>         
  </tr>";
}
?>
</table>

<h2>WANTS</h2>
<table border=1>
<tr><th>PARALLEL</th><th>FACTION</th><th>IN SET</th><th>CARD NAME</th><th>COLOR</th><th># IN SET</th><th>RARITY</th><th>SOLD OUT</th><th>SERIES</th></tr>
<?php

//$SN = $_POST['app_screen_name'];
$wants = "SELECT id, parallel, faction, in_set, card_name, color, number_in_set, rarity, sold_out, series FROM want_list a, cards b WHERE a.user_id='$id' AND b.id=a.card_id";
if (!($want_result = @ mysql_query ($wants, $connection)))
  showerror();

while ($row = @ mysql_fetch_array($want_result)) {
  echo "<tr>
  <td>{$row["parallel"]}</td>
  <td>{$row["faction"]}</td>
  <td>{$row["in_set"]}</td>
  <td>{$row["card_name"]}</td>
  <td>{$row["color"]}</td>
  <td>{$row["number_in_set"]}</td>
  <td>{$row["rarity"]}</td>
  <td>{$row["sold_out"]}</td>
  <td>{$row["series"]}</td>         
  </tr>";
}
?>
</table>

      </div>
    </div>
    <div id="footerfile"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/JavaScript" src="fan_feed_plus.js"></script> 
    <script> 
      $(function(){
        $("#headerfile").load("header.html"); 
        $("#footerfile").load("footer.html"); 
      });
    </script>
  </body>
</html>


