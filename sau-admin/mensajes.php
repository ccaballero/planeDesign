<?php

require_once 'adm.functions.php';

if(isset($_SESSION['ranker'])){
  if($_SESSION['ranker'] == 2){
  }else{
    header('Location: logout');
  }
}else{
  header('Location: logout');
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo SITETITLE; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="../sau-content/admin.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><?php echo SITETITLE; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout"><i class="fa fa-power-off"></i> Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          
          <ul class="nav nav-sidebar">
            <li><a href="index.php"><i class="fa fa-tasks"></i> Inicio</a></li>
            <li><a href="usuarios"><i class="fa fa-user"></i> Usuarios</a></li>
            <li><a href="publicaciones"><i class="fa fa-files-o"></i> Publicaciones</a></li>
            <li class="active"><a href="mensajes"><i class="fa fa-envelope-o"></i> Mensajes</a></li>
            <li><a href="configuracion"><i class="fa fa-cog"></i> Configuración</a></li>
          </ul>


        </div>

        <!-- ### CONTENT ### -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">


   <!-- modulo -->
          <div class="col-sm-6">
              <!-- admin messages -->
              <div class="panel panel-default panel-primary">
                <div class="panel-heading"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mensajes a todos los usuarios</div>
                <div class="panel-body">

                   <form id="messagesfrmall">

                      <label>Asunto:</label>
                      <input type="text" name="asunto" class="form-control">
                      <p></p>
                      <label>Mensaje:</label>
                      <textarea class="form-control" name="mensaje" rows="9"></textarea>
                  
                   </form>
                   <p></p>
                   <button class="enviarmensajetodosbtn btn btn-block btn-success"><i class="fa fa-comments-o" aria-hidden="true"></i> Enviar Mensaje</button>

                </div>
              </div>
              <!-- admin messages -->            
          </div>
          <!-- modulo -->


          <!-- modulo -->
          <div class="col-sm-6">
              <!-- admin messages -->
              <div class="panel panel-default panel-primary">
                <div class="panel-heading"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mensaje a usaario </div>
                <div class="panel-body">
                  
                     <form id="messagesfrmone">

                      <label>Asunto:</label>
                      <input type="text" name="asunto" class="form-control">
                      <p></p>
                      <label>Usuario:</label>
                      <select class="form-control" name="usuario">
                        <?php getusuariosoptionmessage(); ?>
                      </select>
                      <p></p>
                      <label>Mensaje:</label>
                      <textarea class="form-control" name="mensaje" rows="5"></textarea>
                  
                   </form>
                   <p></p>
                   <button class="enviarmensajeaunusuario btn btn-block btn-success"><i class="fa fa-comment-o" aria-hidden="true"></i> Enviar Mensaje</button>

                </div>
              </div>
              <!-- admin messages -->            
          </div>
          <!-- modulo -->          




        </div>
        <!-- ### CONTENT ### -->


      </div>
    </div>


    <div id="data-append"></div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../sau-content/js/jquery.min.js"></script>
    <script src="../sau-content/js/bootstrap.min.js"></script>
    <!-- validate -->
    <script src="../sau-content/js/jquery.validate.min.js"></script>
    <script src="../sau-content/js/additional-methods.min.js"></script>    
    <script src="js/sau3adm.js"></script>
  </body>
</html>



