<?php
require_once'sau-admin/sau-login.php';
require_once'sau-includes/sau-functions.php';
saulanger(SAULANGDEF);

if (isset($_POST['saumail'])) {
 
    $order = recoverypass($_POST['saumail']);
    if ($order == 1){
      
      header('Location: recuperar?mailno');

    }else{
      
      header('Location: recuperar?success');

    }

}

if (isset($_SESSION['idusuario'])){header("Location: escritorio");}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo SITETITLE.' - '.SAULANG75; ?></title>

    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link href="style.css" rel="stylesheet">
    <?php getstyle(SAUSTYLE); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


<!-- ## CONTAINER ## -->
<div id="sau-container" class="container">


<div id="loginbox">

<div class="text-center">
  <img src="sau-content/images/sauv3-logo.png">
</div>

<!-- ## LOGIN ## -->
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-angle-double-right"></i> <?php echo SAULANG75; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div class="panel-body">
    

    <?php
    $active = forgotactive();
    if ($active == 1){
      echo'
    <form id="loginform" method="POST" action="">
      
      <div class="input-group input-group-sm">
        <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" class="form-control" placeholder="'.SAULANG18.'" name="saumail">
      </div>
      <p></p>    
      
      <button type="submit" class="btn btn-default btn-block"><i class="fa fa-chevron-right"></i> '.SAULANG75.'</button>            
    </form>   
       ';
    }else{
      echo'
        <div class="avisodisable col-sm-12"><i class="fa fa-ban fa-4x animated infinite flash" aria-hidden="true"></i>'.SAULANG79.'</div>
      ';
    }
    ?>

      <div class="col-sm-12 login-link-content">
        <a href="index.php"><?php echo SAULANG17; ?></a>
        <a href="registro"><?php echo SAULANG20; ?></a>
      </div> 

  </div>
</div>
<!-- ## LOGIN ## --> 

<?php
  if (isset($_GET['success'])) {
     echo '
       <div class="alert alert-success alert-dismissible fade in animated bounce" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>'.SAULANG78.'</strong></div>
     ';
  }
  if (isset($_GET['mailno'])) {
     echo '
       <div class="alert alert-danger alert-dismissible fade in animated bounce" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>'.SAULANG77.'</strong></div>
     ';
  }
?>

</div>
</div>
<!-- ## CONTAINER ## -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="sau-content/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="sau-content/js/bootstrap.min.js"></script>
    <!-- Validation -->
    <script src="sau-content/js/jquery.validate.min.js"></script>
    <!-- DateTimePicker -->
    <script src="sau-content/js/moment-with-locales.js"></script>
    <script src="sau-content/js/bootstrap-datetimepicker.js"></script>
    <!-- Script Mesagges -->
    <script type="text/javascript">
         var messageerror1 = "<?php echo SAULANG15;?>";
         var messageerror2 = "<?php echo SAULANG16;?>";
    </script> 
    <!-- SAU 3 -->
    <script src="sau-content/js/sau3.js"></script>   
  </body>
</html>