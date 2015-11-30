<?php session_start(); 
include 'sql_calls.php';
$user = $_COOKIE['login_user'];
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

          <div class="table-responsive">
          <table border=1 class="table table-striped table-condensed">
          <tr>
          <th>FIRST NAME</th><th>MIDDLE NAME</th><th>LAST NAME</th>
          <th>EMAIL</th><th>DATE OF BIRTH</th>
          </tr>

          <?php
          $user = $_COOKIE["user_id"];
          print_user_data($user); 
          ?>

          </table>
          </div>

          <a class="btn btn-default" href="change_account_info.php" role="button">Click here to update account information</a>

          <br></br>

          <a class="btn btn-default" href="new_password.php" role="button">Click here to change password</a>

          <br></br>

          <a class="btn btn-default" href="make_payment.php" role="button">Make payment</a>


          <form action="make_payment.php" method="post" onsubmit="">
            <!-- Title of the Form document-->
            <h1>Make Payments</h1>

            <div class="form-group">
              <select class="form-control" name="form_type" id="form_type">       
                <option>---</option>
                <option value="state">State</option>
                <option value="federal">Federal</option>
              </select>
            </div>

            <div class="form-group">
              <select class="form-control" name="user_type" id="user_type">
                <option>---</option>        
                <option value="individual">Individual</option>
                <option value="commercial">Commercial</option>
                <option value="small_biz">Small business</option>
              </select>
            </div>

            <div class="button-box">
              <input type="submit" name="Submit" value="Submit"class="btn btn-success"> 
              <input type="reset" value="Reset" type="button" class="btn btn-danger" style="right:0px">
            </div>

          </form>
          <br></br>          

          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Select year to view past form history
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a href="form_history.php?year=2015">2015</a></li>
              <li><a href="form_history.php?year=2014">2014</a></li>
              <li><a href="form_history.php?year=2013">2013</a></li>
              <li><a href="form_history.php?year=2012">2012</a></li>
             </ul>
          </div>
          
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