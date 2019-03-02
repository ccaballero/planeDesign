<?php
require_once __DIR__.'/adm.functions.php';

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
        <base href="<?php echo BASE; ?>"/>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" />
        <link rel="stylesheet" href="css/sau.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/responsive.css" />
        <?php getpreference($_SESSION['idusuario']); ?>
        <link rel="stylesheet" href="css/custom/admin.css" />
    </head>
    <body>
        <header class="header_area no-print">
            <div class="container-fluid h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        <div class="menu_area h-100">
                            <nav class="navbar h-100 navbar-expand-lg align-items-center">
                                <a class="navbar-brand" href="escritorio"><img src="img/core-img/logo.svg"></a>
                                <button class="navbar-toggler" type="button"
                                        data-toggle="collapse"
                                        data-target="#mosh-navbar"
                                        aria-controls="mosh-navbar"
                                        aria-expanded="false"
                                        aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse justify-content-end" id="mosh-navbar">
                                    <ul class="navbar-nav animated" id="nav">
                                        <li class="nav-item"><a class="nav-link" href="escritorio"><?php echo SAULANG1; ?></a></li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle"
                                               href="#"
                                               role="button"
                                               data-toggle="dropdown"
                                               aria-haspopup="true"
                                               aria-expanded="false"><?php echo SAULANG3; ?><?php messagesnoread(); ?></a>
                                            <?php messagelistli(); ?>
                                        </li>
                                    <?php if($_SESSION['ranker']<>1){ ?>
                                        <li class="nav-item active dropdown">
                                            <a class="nav-link dropdown-toggle"
                                               href="sau-admin"
                                               role="button"
                                               data-toggle="dropdown"
                                               aria-haspopup="true"
                                               aria-expanded="false"><?php echo SAULANGA; ?></a>
                                            <div class="dropdown-menu" aria-labelledby="moshDropdown">
                                                <a class="dropdown-item active" href="admin/reportes">Reportes</a>
                                                <a class="dropdown-item" href="admin/usuarios">Usuarios</a>
                                                <a class="dropdown-item" href="admin/publicaciones">Publicaciones</a>
                                                <a class="dropdown-item" href="admin/mensajes">Mensajes</a>
                                                <a class="dropdown-item" href="admin/configuracion">Configuración</a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                        <li class="nav-item"><a class="nav-link" href="config"><?php echo SAULANG4; ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="plane">Planos</a></li>
                                    </ul>
                                    <div class="search-form-area animated">
                                        <form role="search" action="search" method="get">
                                            <input type="search" name="search" id="search" placeholder="<?php echo SAULANG5; ?>">
                                            <button type="submit" class="d-none"><img src="img/core-img/search-icon.png" alt="Search"></button>
                                        </form>
                                    </div>
                                    <div class="search-button">
                                        <a href="#" id="search-btn"><img src="img/core-img/search-icon.png" alt="Search"></a>
                                    </div>
                                    <div class="login-register-btn">
                                        <a href="logout"><?php echo SAULANG2; ?></a>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="mosh-breadcumb-area no-print" style="background-image: url(img/core-img/breadcrumb.svg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-3 col-xs-6 paddingone">
                        <div class="data-cubes data-cubes-1">
                            <div class="col-sm-6"><i class="fa fa-users fa-4x"></i></div>
                            <div class="col-sm-6"><h1 style="color:white"><?php cuantosusers(); ?></h1><small>Usuarios Registrados</small></div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 paddingone">
                        <div class="data-cubes data-cubes-2">
                            <div class="col-sm-6"><i class="fa fa-files-o fa-4x"></i></div>
                            <div class="col-sm-6"><h1 style="color:white"><?php cuantospublic(); ?></h1><small>Publicaciones Totales</small></div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 paddingone">
                        <div class="data-cubes data-cubes-3">
                            <div class="col-sm-6"><i class="fa fa-commenting fa-4x"></i></div>
                            <div class="col-sm-6"><h1 style="color:white"><?php cuantoscomment(); ?></h1><small>Comentarios Totales&nbsp;</small></div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-xs-6 paddingone">
                        <div class="data-cubes data-cubes-4">
                            <div class="col-sm-6"><i class="fa fa-comments-o fa-4x"></i></div>
                            <div class="col-sm-6"><h1 style="color:white"><?php cuantoscontact(); ?></h1><small>Registros Seguidores</small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-print">
                <div class="col-sm-12">
                    <button class="btn btn-primary" onclick="window.print()">Imprimir PDF</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 nopadding" style="margin-top: 15px;">
                    <div class="col-sm-6 nopadding" style=" padding-left: 15px;">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Planos</div>
                            <div class="panel-body minimalpadding">
                                <div id="planes"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 nopadding" style=" padding-left: 15px;">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Registros</div>
                            <div class="panel-body minimalpadding">
                                <div id="registered"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 nopadding" style="margin-top: 15px;">
                    <div class="col-sm-6">
                        <div class="panel panel-success">
                            <div class="panel-heading"><i class="fa fa-users"></i> Ultimos Registrados</div>
                            <div class="panel-body nopadding">
                                <table class="table">
                                    <thead class="blackthead">
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Email</th>
                                        <th>Planos</th>
                                    </thead>
                                    <tbody>
                                        <?php seisultimosactivos(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <i class="fa fa-comment-o"></i> Ultimas Publicaciones
                            </div>
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
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <i class="fa fa-comments-o"></i> Ultimos Comentarios
                            </div>
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
                    <div class="col-sm-6 nopadding" style=" padding-right: 15px;">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Usuarios del Sistema</div>
                            <div class="panel-body minimalpadding">
                                <div id="users"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-print">
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
        </div>
        <script src="js/sau/jquery.min.js"></script>
        <script src="js/sau/bootstrap.min.js"></script>
        <script src="js/sau/raphael-min.js"></script>
        <script src="js/sau/morris.min.js"></script>
        <script src="js/sau3adm.js"></script>    
        <script type="text/javascript">
            var colors=['FireBrick','Gold','Navy','DarkGreen','DarkMagenta','Indigo'];

            Morris.Donut({
                element:'users'
              , data:[{
                    label:'Total Usuarios Registrados',value:<?php cuantosusers(); ?>
                },{
                    label:'Total Publicaciones',value:<?php cuantospublic(); ?>
                },{
                    label:'Total Comentarios',value:<?php cuantoscomment(); ?>
                },{
                    label:'Total Seguidores',value:<?php cuantoscontact(); ?>
                }]
            });
        </script>
        <script type="text/javascript">
            Morris.Bar({
                element:'registered'
              , data:[{
                    y:'Registrados'
                  , a:<?php cuantosusers(); ?>
                },{
                    y:'Publicaciones'
                  , a:<?php cuantospublic(); ?>
                },{
                    y:'Comentarios'
                  , a:<?php cuantoscomment(); ?>
                },{
                    y:'Seguidores'
                  , a:<?php cuantoscontact(); ?>
                }]
              , xkey:'y'
              , ykeys:['a']
              , labels:['Cantidad']
              , xLabelAngle: 30
              , barColors:function(row,series,type){
                    return colors[row.x];
                }
            });
        </script>
        <script type="text/javascript">
            Morris.Bar({
                element:'planes'
              , data:<?php seisMaxUsers(); ?>
              , xkey:'y'
              , ykeys:['a']
              , labels:['Cantidad']
              , xLabelAngle: 30
              , barColors:function(row,series,type){
                    return colors[row.x];
                }
            });
        </script>
    </body>
</html>

