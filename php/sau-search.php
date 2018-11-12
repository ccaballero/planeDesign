<?php
require_once __DIR__.'/sau-includes/sau-functions.php';

if (!isset($_SESSION['idusuario'])){
    header("Location: logout");
}

if(isset($_GET['search'])){
    $finder = $_GET['search'];

    if (empty($_GET['search'])) {
        header('Location: escritorio');
    }
}else{
    header('Location: escritorio');
}
?>
<!DOCTYPE html>
<html lang="es">
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
    </head>
    <body>
        <header class="header_area">
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
                                        <li class="nav-item active"><a class="nav-link" href="escritorio"><?php echo SAULANG1; ?></a></li>
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
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle"
                                               href="sau-admin"
                                               role="button"
                                               data-toggle="dropdown"
                                               aria-haspopup="true"
                                               aria-expanded="false"><?php echo SAULANGA; ?></a>
                                            <div class="dropdown-menu" aria-labelledby="moshDropdown">
                                                <a class="dropdown-item" href="admin/reportes">Reportes</a>
                                                <a class="dropdown-item" href="admin/usuarios">Usuarios</a>
                                                <a class="dropdown-item" href="admin/publicaciones">Publicaciones</a>
                                                <a class="dropdown-item" href="admin/mensajes">Mensajes</a>
                                                <a class="dropdown-item" href="admin/configuracion">Configuración</a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                        <li class="nav-item"><a class="nav-link" href="config"><?php echo SAULANG4; ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="plane">Graficar Plano</a></li>
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
        <div class="mosh-breadcumb-area" style="background-image: url(img/core-img/breadcrumb.svg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                </div>
            </div>
        </div>
        <div class="container">
            <div id="leftbar" class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i>
                        <?php thename($_SESSION['idusuario']); ?>
                        <a class="collapse-block"><i class="fa fa-chevron-up"></i></a>
                    </div>
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
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-users"></i> <?php echo SAULANG8; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
                    <div id="contactos" class="panel-body">
                        <?php mycontacs($_SESSION['idusuario']); ?>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-calendar"></i> <?php echo SAULANG9; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
                    <div class="panel-body nopadding">
                        <p></p>
                        <div id="calendar-now"></div>
                    </div>
                </div>
            </div>
            <div id="sidebar" class="col-sm-9">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-comment-o"></i>
                        <?php echo SAULANG63.' '.'<strong>'.$finder.'</strong>'; ?>
                        <a class="collapse-block"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    <div class="panel-body busqueda">
                    <?php
                    if (isset($_GET['page'])) {
                        finder($finder,$_GET['page']);
                    }else{
                        finder($finder,1);
                    } ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery-2.2.4.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/active.js"></script>
        <script src="js/sau/jquery.validate.min.js"></script>
        <script src="js/sau/moment-with-locales.js"></script>
        <script src="js/sau/bootstrap-datetimepicker.js"></script>
        <script src="js/sau/additional-methods.min.js"></script>

        <script type="text/javascript">
            var messageerror1 = "<?php echo SAULANG15;?>";
            var messageerror2 = "<?php echo SAULANG16;?>";
        </script>
        <script src="js/sau/sau3.js"></script>
        <script src="js/sau/sau3member.js"></script>

        <?php sau3token(); ?>
    </body>
</html>

