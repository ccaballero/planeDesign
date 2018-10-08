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
            <li class="active"><a href="index.php"><i class="fa fa-tasks"></i> Inicio</a></li>
            <li><a href="usuarios"><i class="fa fa-user"></i> Usuarios</a></li>
            <li><a href="publicaciones"><i class="fa fa-files-o"></i> Publicaciones</a></li>
            <li><a href="mensajes"><i class="fa fa-envelope-o"></i> Mensajes</a></li>
            <li><a href="configuracion"><i class="fa fa-cog"></i> Configuración</a></li>
          </ul>


        </div>

        <!-- ### CONTENT ### -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">


            <div class="col-sm-3 col-xs-6 paddingone">
              <div class="data-cubes data-cubes-1">
                 <div class="col-sm-6"><i class="fa fa-users fa-4x"></i></div>
                 <div class="col-sm-6"><h1><?php cuantosusers(); ?></h1><small>Usuarios Registrados</small></div>
              </div>
             </div>


            <div class="col-sm-3 col-xs-6 paddingone">
              <div class="data-cubes data-cubes-2">
                 <div class="col-sm-6"><i class="fa fa-files-o fa-4x"></i></div>
                 <div class="col-sm-6"><h1><?php cuantospublic(); ?></h1><small>Publicaciones Totales</small></div>
              </div>
             </div>


             <div class="col-sm-3 col-xs-6 paddingone">
              <div class="data-cubes data-cubes-3">
                 <div class="col-sm-6"><i class="fa fa-commenting fa-4x"></i></div>
                 <div class="col-sm-6"><h1><?php cuantoscomment(); ?></h1><small>Comentarios Totales</small></div>
              </div>
             </div>


             <div class="col-sm-3 col-xs-6 paddingone">
              <div class="data-cubes data-cubes-4">
                 <div class="col-sm-6"><i class="fa fa-comments-o fa-4x"></i></div>
                 <div class="col-sm-6"><h1><?php cuantoscontact(); ?></h1><small>Registros Seguidores</small></div>
              </div>
             </div>

             
<div class="col-sm-12 nopadding" style="margin-top: 15px;">   

<div class="col-sm-6 nopadding" style=" padding-right: 15px;">
  <div class="panel panel-primary">
    <div class="panel-heading">Estadisticas</div>
    <div class="panel-body minimalpadding">
      <div id="donut-example"></div>
    </div>
  </div>  
</div>


<div class="col-sm-6 nopadding" style=" padding-left: 15px;">
  <div class="panel panel-primary">
    <div class="panel-heading">Estadisticas</div>
    <div class="panel-body minimalpadding">
      <div id="bar-example"></div>
    </div>
  </div>  
</div>

</div>

<div class="col-sm-6">
  <div class="panel panel-success">
    <div class="panel-heading"><i class="fa fa-users"></i> Ultimos Registrados</div>
    <div class="panel-body nopadding">
      
      <table class="table">
         <thead class="blackthead">
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Email</th>
         </thead>
         <tbody>
           <?php seisultimosactivos(); ?>
         </tbody>
      </table>


    </div>
  </div>  
</div>


<div class="col-sm-6">
  <div class="panel panel-info">
    <div class="panel-heading"><i class="fa fa-comment-o"></i> Ultimas Publicaciones</div>
    <div class="panel-body nopadding">
      
      <table class="table">
         <thead class="blackthead">
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Pulicación</th>
         </thead>
         <tbody>
           <?php seisultimaspublicaciones(); ?>
         </tbody>
      </table>


    </div>
  </div>  
</div>


<div class="col-sm-6">
  <div class="panel panel-warning">
    <div class="panel-heading"><i class="fa fa-comments-o"></i> Ultimos Comentarios</div>
    <div class="panel-body nopadding">
      
      <table class="table">
         <thead class="blackthead">
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Comentario</th>
         </thead>
         <tbody>
           <?php seisultimoscomentarios(); ?>
         </tbody>
      </table>


    </div>
  </div>  
</div>



<div class="col-sm-6">
  <div class="panel panel-danger">
    <div class="panel-heading"><i class="fa fa-database" aria-hidden="true"></i> Base de Datos</div>
    <div class="panel-body minimalpadding">
      
          <label class="text-center" style="display: block; width: 100%;">Función para borrar los usuarios que no se han activado</label>
          <button class="deleteusuariosnoactivos btn btn-block btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Usuarios No Activados</button>

    </div>
  </div>  
</div>


        </div>
        <!-- ### CONTENT ### -->
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../sau-content/js/jquery.min.js"></script>
    <script src="../sau-content/js/bootstrap.min.js"></script>
    <script src="../sau-content/js/raphael-min.js"></script>
    <script src="../sau-content/js/morris.min.js"></script>
    <script src="js/sau3adm.js"></script>    
    <script type="text/javascript">
       Morris.Donut({
         element: 'donut-example',
         data: [
           {label: "Total Usuarios Registrados", value: <?php cuantosusers(); ?>},
           {label: "Total Publicaciones", value: <?php cuantospublic(); ?>},
           {label: "Total Comentarios", value: <?php cuantoscomment(); ?>},
           {label: "Total Seguidores", value: <?php cuantoscontact(); ?>}
         ]
       });
    </script>
    <script type="text/javascript">
        Morris.Bar({
          element: 'bar-example',
          data: [
            { y: 'Registrados', a: <?php cuantosusers(); ?>},
            { y: 'Publicaciones', a: <?php cuantospublic(); ?>},
            { y: 'Comentarios', a: <?php cuantoscomment(); ?>},
            { y: 'Seguidores', a: <?php cuantoscontact(); ?>}
          ],
          xkey: 'y',
          ykeys: ['a'],
          labels: ['Cantidad']
        });      
    </script>
  </body>
</html>
