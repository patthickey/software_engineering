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
      <div class="col-md-10 col-md-offset-1">

        <div class="col-md-12 fake-well">
          <h2 class="text-center"> Change Password </h3>
            <div class="col-md-10 col-md-offset-1">


              <div class="table-responsive">
              <table border=1 class="table table-striped table-condensed">

              </table>
              </div>

              <form action="change_password.php" method="post" onsubmit="return validate_pw_change();">
                <div class="form-group">
                  <label for="email">Enter Old Password</label>
                    <input type="password" class="form-control" id="oldpass" name='oldpass' placeholder="Old Password">
                </div>

                <div class="form-group">
                  <label for="year">Enter New Password</label>
                    <input type="password" class="form-control" id="newpass1" name='newpass1' placeholder="New Password">
                </div>

                <div class="form-group">
                  <label for="year">Confirm New Password</label>
                    <input type="password" class="form-control" id="newpass2" name='newpass2' placeholder="Re-Enter New Password">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form>

              <br></br>

              <!--<button type="button" href = "auditor_form_history.php?email='email'?year='year'" class="btn btn-success">Search</button>
              <a class="btn btn-default" href="auditor_form_history.php?email='email'&year='year'" role="button">Search</a>-->

        
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