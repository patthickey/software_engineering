<?php session_start(); 
include 'sql_calls.php';
$user = $_COOKIE["user_id"];
$form_type = $_POST["form_type"];
$user_type = $_POST["user_type"];

$balance = get_balance($user, $form_type, $user_type);
$half_balance = $balance / 2;
$quarter_balance = $balance / 4;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Patt Hickey, Victor Adesanmi, Austin Layne, Zachary Kombet">  
    <title>IRS (mock site)</title>

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
    <div class="container-fluid"> 
    <div class="row">
      <div class="col-md-10 col-md-offset-1 fake-well">
        <div class="col-md-10 col-md-offset-1">
          <h2 class="text-center"> MAKE PAYMENTS </h3>  

          <h3> BALANCE DUE : <?php echo $balance; ?> for <?php echo $form_type; ?> <?php echo $user_type; ?></h3>    

<!--
          <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="hosted_button_id" value="YGLE2BSTEHZPU">
          <table>
          <tr><td><input type="hidden" name="on0" value="OPTIONS"><h5>Payment Options</h5></td></tr><tr><td><select name="os0">
            <option value="FULL">FULL $<?php echo $balance; ?> USD</option>
            <option value="HALF">HALF $<?php echo $half_balance; ?> USD</option>
            <option value="QUARTER">QUARTER $<?php echo $quarter_balance; ?> USD</option>
          </select> </td></tr>
          </table>
          <input type="hidden" name="currency_code" value="USD">
          <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
          <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
          </form>
          


          <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="hosted_button_id" value="CCBWX98RLZ9HU">
          <table>
          <tr><td><input type="hidden" name="amount" value="amount"><h5>Payment Options</h5></td></tr><tr><td><select name="amount">
            <option value="<?php echo $balance; ?>">FULL $<?php echo $balance; ?> USD</option>
            <option value="<?php echo $half_balance; ?>">HALF $<?php echo $half_balance; ?> USD</option>
            <option value="<?php echo $quarter_balance; ?>">QUARTER $<?php echo $quarter_balance; ?> USD</option>
          </select> </td></tr>
          </table>          
          <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
          <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
          </form>
-->

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
  <table>
  <tr><td><input type="hidden" name="amount" value="amount"><h5>Payment Options</h5></td></tr><tr><td>
  <select name="amount">
    <option value="<?php echo $balance; ?>">FULL $<?php echo $balance; ?> USD</option>
    <option value="<?php echo $half_balance; ?>">HALF $<?php echo $half_balance; ?> USD</option>
    <option value="<?php echo $quarter_balance; ?>">QUARTER $<?php echo $quarter_balance; ?> USD</option>
  </select> </td></tr>
  </table>          
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


        </div>
      </div>
    </div>
    </div>
    <div id="footerfile"></div>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-68434893-1', 'auto');
      ga('send', 'pageview');

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/JavaScript" src="IRS_mock_site.js"></script> 
    <script> 
      $(function(){
        $("#headerfile").load("header.html"); 
        $("#footerfile").load("footer.html"); 
      });
    </script>
  </body>
</html>