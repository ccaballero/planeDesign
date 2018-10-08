<?php
// incluimos las funciones
require_once 'sau-includes/sau-functions.php';
session_start();
if (isset($_SESSION['idusuario'])){
}else{
  header("Location: logout");
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

        <li><a href=""><i class="fa fa-home"></i> <?php echo SAULANG1; ?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-envelope-o"></i> <?php echo SAULANG3; ?>
            <?php messagesnoread(); ?>
          </a>

          <ul id="messagesul" class="dropdown-menu">
            <?php messagelistli(); ?>
          </ul>
        </li>
        <li class="active"><a href="config"><i class="fa fa-cog"></i> <?php echo SAULANG4; ?></a></li>
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
  <div class="panel-heading"><i class="fa fa-user"></i> <?php thename($_SESSION['idusuario']); ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div class="panel-body text-center">
     <div id="alertimg"><i class="fa fa-times"></i> <?php echo SAULANG22; ?></div>
     <?php getprofileimg($_SESSION['idusuario']); ?>
     <p></p>
     <button class="changenowimg btn btn-default btn-sm"><i class="fa fa-picture-o"></i> <?php echo SAULANG7; ?></button>
     <p></p>
     <div class="hideform">
       <form id="profileserialize">
         <input type="hidden" name="process" value="1" >
         <input id="changeprofile" type="file" name="imageprofile">
       </form>
     </div>
  </div>
</div>
<!-- panels -->

<!-- panels -->
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-users"></i> <?php echo SAULANG8; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div id="contactos" class="panel-body">
    
     <?php mycontacs($_SESSION['idusuario']); ?>

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
  


<div class="col-sm-6">
<!-- panels -->
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-cog"></i> <?php echo SAULANG4; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div class="panel-body">

     <?php getmypreferences(); ?>

  </div>
</div>
<!-- panels -->  
</div>


<div class="col-sm-6">
<!-- panels -->
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-user"></i> <?php echo SAULANG40; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div class="panel-body">

    <?php getmypreferences2(); ?>

  </div>
</div>
<!-- panels -->  


<!-- panels -->
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-user"></i> <?php echo SAULANG41; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
  <div class="panel-body">

  <button data-toggle="modal" data-target="#myModalPassword" class="btn btn-block btn-default"><i class="fa fa-unlock"></i> <?php echo SAULANG42; ?></button>
  <p></p>
  <button data-toggle="modal" data-target="#myModalEmail" class="btn btn-block btn-success"><i class="fa fa-envelope-o"></i> <?php echo SAULANG43; ?></button>
  <p></p>
  <button data-toggle="modal" data-target="#myModalPerma" class="btn btn-block btn-danger"><i class="fa fa-codepen"></i> <?php echo SAULANG44; ?></button>


  </div>
</div>
<!-- panels -->  



</div>




</div>
<!-- ### LEFTBAR ### -->
</div>
<!-- ### CONTAINER ### -->

<!-- ### MODALS ### -->
<!-- Modal -->
<div class="modal fade" id="myModalPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-unlock"></i> <?php echo SAULANG42; ?></h4>
      </div>
      <div class="modal-body">
        
        <!-- alert -->
        <div id="notactualpass" class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button> <strong><?php echo SAULANG58; ?></strong></div>
        <!-- alert -->

        <form id="newchangepass">
            <label><?php echo SAULANG49; ?></label>
            <input class="form-control" type="password" name="actualpass" >
            <label><?php echo SAULANG50; ?></label>
            <input class="form-control" type="password" id="newpassequal" name="newpass" >
            <label><?php echo SAULANG51; ?></label>
            <input class="form-control" type="password" name="newpassconf" >                                   
        </form>

      </div>
      <div class="modal-footer">

        <button type="button" class="changemypass btn btn-primary"><i class="fa fa-floppy-o"></i> <?php echo SAULANG39; ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo SAULANG28; ?></button>
      
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope-o"></i> <?php echo SAULANG43; ?></h4>
      </div>
      <div class="modal-body">
         
        <!-- alert -->
        <div id="notactualemail" class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button> <strong><?php echo SAULANG71; ?></strong></div>
        <!-- alert -->
        <!-- alert -->
        <div id="notactualusemail" class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button> <strong><?php echo SAULANG72; ?></strong></div>
        <!-- alert -->


         <?php changeemail(); ?>
         <p></p>
         
         <form id="emailform">
           <label><?php echo SAULANG53; ?></label>
           <input class="form-control" type="text" name="email" value="">
         </form>

      </div>
      <div class="modal-footer">

        <button type="button" class="savenewemail btn btn-primary"><i class="fa fa-floppy-o"></i> <?php echo SAULANG39; ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo SAULANG28; ?></button>
      
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalPerma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-codepen"></i> <?php echo SAULANG44; ?></h4>
      </div>
      <div class="modal-body">
         
        <!-- alert -->
        <div id="notactualperma" class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button> <strong><?php echo SAULANG67; ?></strong></div>
        <!-- alert -->

         <?php changepermalink(); ?>
         <p></p>

         <form id="permaform">
           <label><?php echo SAULANG53; ?></label>
           <input class="form-control" type="text" name="permalink" id="permainput" value="">
         </form>


      </div>
      <div class="modal-footer">

        <button type="button" class="savenewpermalink btn btn-primary"><i class="fa fa-floppy-o"></i> <?php echo SAULANG39; ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo SAULANG28; ?></button>
      
      </div>
    </div>
  </div>
</div>
<!-- ### MODALS ### -->





<!-- ### Datos actualizados ### -->
<div id="updasuccess">
  <i class="fa fa-check"></i>  <?php echo SAULANG45; ?>
</div>
<!-- ### Datos actualizados ### -->



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="sau-content/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="sau-content/js/bootstrap.min.js"></script>
    <!-- Validation -->
    <script src="sau-content/js/jquery.validate.min.js"></script>
    <!-- DateTimePicker -->
    <script src="sau-content/js/moment-with-locales.js"></script>
    <script src="sau-content/js/bootstrap-datetimepicker.js"></script>
    <!-- validate -->
    <script src="sau-content/js/jquery.validate.min.js"></script>
    <script src="sau-content/js/additional-methods.min.js"></script>
    <!-- Script Mesagges -->
    <script type="text/javascript">
         var messageerror1 = "<?php echo SAULANG15; ?>";
         var messageerror2 = "<?php echo SAULANG16; ?>";
         var messageerror3 = "<?php echo SAULANG55; ?>";
         var messageerror4 = "<?php echo SAULANG56; ?>";
         var messageerror5 = "<?php echo SAULANG57; ?>";
         var messageerror6 = "<?php echo SAULANG65; ?>";
         var messageerror7 = "<?php echo SAULANG66; ?>";
    </script>
    <!-- SAU 3 -->
    <script src="sau-content/js/sau3.js"></script>
    <script src="sau-content/js/sau3member.js"></script>
  </body>
</html>

