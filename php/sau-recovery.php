<?php
require_once 'sau-admin/sau-login.php';
require_once 'sau-includes/sau-functions.php';

saulanger(SAULANGDEF);

if (isset($_POST['saumail'])) {
    $order = recoverypass($_POST['saumail']);
    if ($order == 1){
        header('Location: recuperar?mailno');
    }else{
        header('Location: recuperar?success');
    }
}

if (isset($_SESSION['idusuario'])){header('Location: escritorio');}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SITETITLE.' - '.SAULANG75; ?></title>
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
        <section class="contact-area section_padding_100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-4 col-md-6">
                    <?php $active = forgotactive(); ?>
                    <?php if ($active == 1) { ?>
                        <div class="contact-form-area">
                            <h2><?php echo SAULANG21; ?></h2>
                            <?php if (isset($_GET['success'])) { ?>
                                <div class="alert alert-success alert-dismissible fade in animated bounce" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <strong><?php echo SAULANG78; ?></strong>
                                </div>
                            <?php } ?>
                            <?php if (isset($_GET['mailno'])) { ?>
                                <div class="alert alert-danger alert-dismissible fade in animated bounce" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <strong><?php echo SAULANG77; ?></strong>
                                </div>
                            <?php } ?>
                            <form id="loginform" action="" method="post">
                                <div class="row">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="<?php echo SAULANG18; ?>" name="saumail" />
                                    </div>
                                    <button class="btn mosh-btn mt-50" type="submit"><?php echo SAULANG75; ?></button>
                                </div>
                                <div class="btn-group-vertical col-sm-6 offset-md-6 login-link-content" role="group">
                                    <a class="btn" href="index.php"><?php echo SAULANG17; ?></a>
                                    <a class="btn" href="registro"><?php echo SAULANG20; ?></a>
                                </div>
                            </form>
                        </div>
                    <?php }else{ ?>
                        <div class="avisodisable col-sm-12">
                            <i class="fa fa-ban fa-4x animated infinite flash" aria-hidden="true"></i>
                            <?php echo SAULANG79; ?>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </section>

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
        </script>
        <script src="js/sau/sau3.js"></script>
    </body>
</html>

