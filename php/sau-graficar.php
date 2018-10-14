<?php
require_once __DIR__.'/sau-includes/sau-functions.php';

if (!isset($_SESSION['idusuario'])) {
    header('Location: logout');
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SITETITLE; ?></title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" />
        <link rel="stylesheet" href="/css/sau.css" />
        <link rel="stylesheet" href="/css/style.css" />
        <link rel="stylesheet" href="/css/responsive.css" />
        <?php getpreference($_SESSION['idusuario']); ?>
    </head>
    <body>
        <header class="header_area">
            <div class="container-fluid h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        <div class="menu_area h-100">
                            <nav class="navbar h-100 navbar-expand-lg align-items-center">
                                <a class="navbar-brand" href="/"><img src="/img/core-img/logo.png"></a>
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
                                        <li class="nav-item active"><a class="nav-link" href="/escritorio"><?php echo SAULANG1; ?></a></li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle"
                                               href="#"
                                               role="button"
                                               data-toggle="dropdown"
                                               aria-haspopup="true"
                                               aria-expanded="false"><?php echo SAULANG3; ?><?php messagesnoread(); ?></a>
                                            <div class="dropdown-menu" aria-labelledby="moshDropdown">
                                                <?php messagelistli(); ?>
                                            </div>
                                        </li>
                                        <?php isadmin($_SESSION['ranker']); ?>
                                        <li class="nav-item"><a class="nav-link" href="/config"><?php echo SAULANG4; ?></a></li>
                                        <li class="nav-item"><a class="nav-link" href="/plane">Graficar Plano</a></li>
                                    </ul>
                                    <div class="search-form-area animated">
                                        <form role="search" action="search" method="get">
                                            <input type="search" name="search" id="search" placeholder="<?php echo SAULANG5; ?>">
                                            <button type="submit" class="d-none"><img src="/img/core-img/search-icon.png" alt="Search"></button>
                                        </form>
                                    </div>
                                    <div class="search-button">
                                        <a href="#" id="search-btn"><img src="/img/core-img/search-icon.png" alt="Search"></a>
                                    </div>
                                    <div class="login-register-btn">
                                        <a href="/logout"><?php echo SAULANG2; ?></a>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="mosh-breadcumb-area" style="background-image: url(/img/core-img/breadcumb.png);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <div class="container">

        </div>
        <script src="/js/jquery-2.2.4.min.js"></script>
        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/plugins.js"></script>
        <script src="/js/active.js"></script>
        <script src="/sau-content/js/jquery.validate.min.js"></script>
        <script src="/sau-content/js/moment-with-locales.js"></script>
        <script src="/sau-content/js/bootstrap-datetimepicker.js"></script>
        <script src="/sau-content/js/additional-methods.min.js"></script>

        <script type="text/javascript">
            var messageerror1 = "<?php echo SAULANG15;?>";
            var messageerror2 = "<?php echo SAULANG16;?>";
        </script>
        <script src="/sau-content/js/sau3.js"></script>
        <script src="/sau-content/js/sau3member.js"></script>

        <?php sau3token(); ?>
    </body>
</html>

