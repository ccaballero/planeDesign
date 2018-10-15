<?php
// incluimos las funciones
require_once 'sau-includes/sau-functions.php';
session_start();
if (isset($_SESSION['idusuario'])){
}else{
  header("Location: logout");
}
// permaprofile
if (empty($_GET['perma'])) {
	header('Location: escritorio');
}else{
	$permaparse = str_replace('!', '', $_GET['perma']);
    $getidprofile = getidperma($permaparse); 
    if ($getidprofile == 'error') {
    	header('Location: escritorio');
    }elseif ($getidprofile == $_SESSION['idusuario']) {
      header('Location: escritorio');
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo SITETITLE; ?></title>
    <!-- Bootstrap -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link href="style.css" rel="stylesheet">
    <?php getpreference($_SESSION['idusuario']); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


<!-- ### CONTAINER ### -->
<div class="container">
    	

<p></p>
<!-- ### MENU ### -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         <i class="fa fa-chevron-down"></i>
      </button>
      <a class="navbar-brand" href="escritorio"><i class="fa fa-clone"></i> <?php echo SITETITLE; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <form class="navbar-form navbar-right" role="search" method="GET" action="search">
        <div class="input-group">
          <input type="text" class="form-control" name="find" placeholder="<?php echo SAULANG5; ?>">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </span>
        </div><!-- /input-group -->
      </form>

      <ul class="nav navbar-nav navbar-right">

        <li><a href="escritorio"><i class="fa fa-home"></i> <?php echo SAULANG1; ?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-envelope-o"></i> <?php echo SAULANG3; ?>
            <?php messagesnoread(); ?>
          </a>
          <ul id="messagesul" class="dropdown-menu">
            <?php messagelistli(); ?>
          </ul>
        </li>
        <li><a href="config"><i class="fa fa-cog"></i> <?php echo SAULANG4; ?></a></li>
        <?php isadmin($_SESSION['ranker']); ?>
        <li><a href="logout"><i class="fa fa-sign-out"></i> <?php echo SAULANG2; ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!-- ### MENU ### -->


<!-- ### SIDEBAR ### -->
<div id="leftbar" class="col-sm-3">
  

<!-- panels -->
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-user"></i> <?php thename($getidprofile); ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div class="panel-body text-center">
     <div id="alertimg"><i class="fa fa-times"></i> <?php echo SAULANG22; ?></div>
     <?php getprofileimg($getidprofile); ?>
     <p></p>
     <?php checkmycontact($getidprofile,$_SESSION['idusuario']); ?>
     <button data-toggle="modal" data-target="#MessageModal" class="sendmessage btn btn-info btn-sm"><i class="fa fa-envelope-o"></i> <?php echo SAULANG25; ?></button>
  </div>
</div>
<!-- panels -->

<!-- panels -->
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-users"></i> <?php echo SAULANG8; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div id="contactos" class="panel-body">
    
     <?php mycontacs($getidprofile); ?>

  </div>
</div>
<!-- panels -->

<!-- panels -->
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-calendar"></i> <?php echo SAULANG9; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div class="panel-body nopadding">
    <p></p>
    <!-- calendario -->
    <div id="calendar-now"></div>
    <!-- calendario -->
  </div>
</div>
<!-- panels -->

</div>
<!-- ### SIDEBAR ### -->


<!-- ### LEFTBAR ### -->
<div id="sidebar" class="col-sm-9">
  
<div id="post-inner" class="col-sm-12">
	<!-- posts -->
     <?php getmyposts($getidprofile); ?>
    <!-- posts -->
</div>

</div>
<!-- ### LEFTBAR ### -->

</div>
<!-- ### CONTAINER ### -->

<!-- ### MODAL MESSAGE ### -->
<div class="modal fade animated zoomIn" id="MessageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope-o"></i> <?php echo SAULANG27; ?></h4>
      </div>
      <div class="modal-body">

        <form id="sendmessageprofile">
           <input placeholder="<?php echo SAULANG29; ?>" class="form-control" type="text" name="asunto">
           <p></p>
           <textarea placeholder="<?php echo SAULANG30; ?>" class="form-control" name="mensaje" rows="5"></textarea>
           <input type="hidden" name="tokenuser"  value="<?php echo base64_encode(date('Y-m-d h:i:s').$getidprofile); ?>" >
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="sendmessanow btn btn-primary"><i class="fa fa-envelope-o"></i> <?php echo SAULANG27; ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo SAULANG28; ?></button>
      </div>
    </div>
  </div>
</div>
<!-- ### MODAL MESSAGE ### -->



    <script src="js/sau/jquery.min.js"></script>
    <script src="js/sau/bootstrap.min.js"></script>
    <script src="js/sau/jquery.validate.min.js"></script>
    <script src="js/sau/moment-with-locales.js"></script>
    <script src="js/sau/bootstrap-datetimepicker.js"></script>
    <script src="js/sau/jquery.validate.min.js"></script>
    <script src="js/sau/additional-methods.min.js"></script> 
    <script type="text/javascript">
         var messageerror1 = "<?php echo SAULANG15;?>";
         var messageerror2 = "<?php echo SAULANG16;?>";
    </script>
    <script src="js/sau/sau3.js"></script>
    <script src="js/sau/sau3member.js"></script>
    <?php
       sau3tokenprofile($getidprofile);
    ?>
  </body>
</html>


