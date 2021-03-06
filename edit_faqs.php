<?php session_start(); 
include 'sql_calls.php';
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


  <body class="admin_privilege" onload="on_page_load();">
    <div id="headerfile"></div>   
    <div class="container-fluid"> 
    <div class="row">
      <div class="col-md-10 col-md-offset-1 fake-well">

        <fieldset class="add_faqs">
        <form action="add_faqs.php" method="post" onsubmit="return validate_add_faqs();">
          <legend class="text-center header col-md-10 col-md-offset-1">Add a Frequently Asked Question</legend>
          
            <div class="form-group text-center col-md-10 col-md-offset-1">
              <label for="add_faqs_question">QUESTION</label>
              <input type="text" class="form-control" name="add_faqs_question" id="add_faqs_question" placeholder="Why did the chicken go online?">
            </div>

            <div class="form-group text-center col-md-10 col-md-offset-1">
              <label for="add_faqs_answer">ANSWER</label>
              <input type="text" class="form-control" name="add_faqs_answer" id="add_faqs_answer" placeholder="To fill out his taxes on the IRS site!">
            </div>

         <div class="button-box text-center col-md-10 col-md-offset-1">
          <button type="submit" class="btn btn-success-lg">Submit</button>
         </div>
        </form>
        </fieldset>
        </br>

          <div class="col-md-10 col-md-offset-1">
            <form action="delete_faqs.php" method="post">
              <div class="form-group">
                <select class="form-control" name="delete_faq">          
                  <?php delete_faqs_list(); ?>
                </select>
              </div>                  
              <div class="button-box"><input type="submit" name="Submit" value="Submit" class="btn btn-success"></div> 
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