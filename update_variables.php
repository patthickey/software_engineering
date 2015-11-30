<?php session_start(); 
include 'sql_calls.php';?>
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
          <h2 class="text-center"> STATE </h3>
          <h3> Individual </h3>
          <div class="table-responsive">
          <table border=1 class="table table-striped table-condensed">
          <tr>
          <th>TAX RATE by %</th>
          <th>SINGLE FILER</th>
          <th>MARRIED FILING TOGETHER</th>
          <th>MARRIED FILING SEPERATE</th>
          <th>HEAD OF HOUSEHOLD</th>
          </tr>

          <?php update_state_individual_tax_brackets(); ?>

          </table>
          </div>

          <h3> Commercial </h3>
          <div class="table-responsive">
          <table border=1 class="table table-striped table-condensed">
          <tr>
          <th>TAX RATE by %</th>
          <th>Income</th>
          
          </tr>

          <?php update_state_commercial_tax_brackets(); ?>

          </table>
          </div>

          <h3> Small Business </h3>
          <div class="table-responsive">
          <table border=1 class="table table-striped table-condensed">
          <tr>
          <th>TAX RATE by %</th>
          <th>Income</th>
          
          </tr>

          <?php update_state_smallbiz_tax_brackets(); ?>

          </table>
          </div>
        </div>



        <div class="col-md-12 fake-well">
          <h2 class="text-center"> FEDERAL </h3>
          <h3> Individual </h3>
          <div class="table-responsive">
          <table border=1 class="table table-striped table-condensed">
          <tr>
          <th>TAX RATE by %</th>
          <th>SINGLE FILER</th>
          <th>MARRIED FILING TOGETHER</th>
          <th>MARRIED FILING SEPERATE</th>
          <th>HEAD OF HOUSEHOLD</th>
          </tr>

          <?php update_federal_individual_tax_brackets(); ?>

          </table>
          </div>

          <h3> Commercial </h3>
          <div class="table-responsive">
          <table border=1 class="table table-striped table-condensed">
          <tr>
          <th>TAX RATE by %</th>
          <th>Income</th>
          
          </tr>

          <?php update_federal_commercial_tax_brackets(); ?>

          </table>
          </div>

          <h3> Small Business </h3>
          <div class="table-responsive">
          <table border=1 class="table table-striped table-condensed">
          <tr>
          <th>TAX RATE by %</th>
          <th>Income</th>
          
          </tr>

          <?php update_federal_smallbiz_tax_brackets(); ?>

          </table>
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