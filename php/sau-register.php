<?php
require_once'sau-admin/sau-login.php';
require_once'sau-includes/sau-functions.php';
saulanger(SAULANGDEF);

if (isset($_POST['nombre'])) {
    $what = register($_POST['nombre'],$_POST['apellido'],$_POST['mail'],$_POST['password']);
    if ($what == 1) {
      header('Location: registro?mailuse');
    }else{
      header('Location: registro?success');
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
    <title><?php echo SITETITLE.' - '.SAULANG59; ?></title>

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
  <div class="panel-heading"><i class="fa fa-angle-double-right"></i> <?php echo SAULANG59; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div class="panel-body">
    

    <?php
    $active = registeractive();
    if ($active == 1){
      echo'

    <form id="register" method="POST" action="">
      
      <div class="input-group input-group-sm">
        <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" class="form-control" placeholder="'.SAULANG46.'" name="nombre">
      </div>
      <p></p> 

      <div class="input-group input-group-sm">
        <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
        <input type="text" class="form-control" placeholder="'.SAULANG47.'" name="apellido">
      </div>
      <p></p> 

      <div class="input-group input-group-sm">
        <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-envelope-o"></i></i></span>
        <input type="text" class="form-control" placeholder="'.SAULANG18.'" name="mail">
      </div>
      <p></p>                
      
      <div class="input-group input-group-sm">
        <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-cog"></i></span>
        <input type="password" class="form-control" placeholder="'.SAULANG19.'" name="password">
      </div>
      <p></p>

      <button type="submit" class="btn btn-default btn-block"><i class="fa fa-plus"></i> '.SAULANG60.'</button>            
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
        <a href="recuperar"><?php echo SAULANG21; ?></a>
      </div> 


  </div>
</div>
<!-- ## LOGIN ## --> 

<?php
  if (isset($_GET['success'])) {
     echo '
       <div class="alert alert-success alert-dismissible fade in animated bounce" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>'.SAULANG61.'</strong></div>
     ';
  }
  if (isset($_GET['mailuse'])) {
     echo '
       <div class="alert alert-danger alert-dismissible fade in animated bounce" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>'.SAULANG62.'</strong></div>
     ';
  }
?>

</div>



        
</div>
<!-- ## CONTAINER ## -->


    <script src="js/sau/jquery.min.js"></script>
    <script src="js/sau/bootstrap.min.js"></script>
    <script src="js/sau/jquery.validate.min.js"></script>
    <script src="js/sau/moment-with-locales.js"></script>
    <script src="js/sau/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
         var messageerror1 = "<?php echo SAULANG15;?>";
         var messageerror2 = "<?php echo SAULANG16;?>";
    </script> 
    <script src="js/sau/sau3.js"></script>   
  </body>
</html>
