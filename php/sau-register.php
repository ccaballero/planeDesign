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
        <title><?php echo SITETITLE.' - '.SAULANG59; ?></title>
        <base href="<?php echo BASE; ?>"/>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" />
        <link rel="stylesheet" href="css/sau.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/responsive.css" />
        <?php getstyle(SAUSTYLE); ?>
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
        <div id="sau-container" class="container">
            <div id="loginbox">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-angle-double-right"></i> <?php echo SAULANG59; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
                    <div class="panel-body">
                    <?php $active = registeractive(); ?>
                    <?php if ($active == 1){ ?>
                        <form id="register" method="POST" action="">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="<?php echo SAULANG46; ?>" name="nombre">
                            </div>
                            <p></p> 
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="<?php echo SAULANG47; ?>" name="apellido">
                            </div>
                            <p></p> 
                            <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="<?php echo SAULANG18; ?>" name="mail">
                            </div>
                            <p></p>                
                            <div class="input-group input-group-sm">
                            <input type="password" class="form-control" placeholder="<?php echo SAULANG19; ?>" name="password">
                            </div>
                            <p></p>
                            <button type="submit" class="btn btn-default btn-block"><i class="fa fa-plus"></i><?php echo SAULANG60; ?></button>
                        </form>
                    <?php }else{ ?>
                        <div class="avisodisable col-sm-12"><i class="fa fa-ban fa-4x animated infinite flash" aria-hidden="true"></i><?php echo SAULANG79; ?></div>
                    <?php } ?>
                        <div class="col-sm-12 login-link-content">
                            <a href="index.php"><?php echo SAULANG17; ?></a>
                            <a href="recuperar"><?php echo SAULANG21; ?></a>
                        </div> 
                    </div>
                </div>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade in animated bounce" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong><?php echo SAULANG61; ?></strong></div>
            <?php } ?>
            <?php if (isset($_GET['mailuse'])) { ?>
                <div class="alert alert-danger alert-dismissible fade in animated bounce" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong><?php echo SAULANG62; ?></strong></div>
            <?php } ?>
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
    </body>
</html>

