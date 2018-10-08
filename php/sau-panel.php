<?php
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
        <title><?php echo SITETITLE; ?></title>

        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/responsive.css" />
    </head>
    <body>
        <div id="preloader">
            <div class="mosh-preloader"></div>
        </div>

<!--FROM HERE-->
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                        <a class="navbar-brand" href="escritorio"><i class="fa fa-clone"></i> <?php echo SITETITLE; ?></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <form class="navbar-form navbar-right" role="search" method="GET" action="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="find" placeholder="<?php echo SAULANG5; ?>">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </span>
                            </div>
                        </form>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a href="escritorio"><i class="fa fa-home"></i> <?php echo SAULANG1; ?></a></li>
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
                    </div>
                </div>
            </nav>
            <div id="leftbar" class="col-sm-3">
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
                        <div class="panel-heading"><i class="fa fa-comment-o"></i> <?php echo SAULANG6; ?> <a class="collapse-block"><i class="fa fa-chevron-up"></i></a></div>
                        <div class="panel-body">
                        <form id="poster">
                            <textarea  name="posttext" class="form-control" rows="2"></textarea>
                        </form>
                        <p></p>
                        <button class="posterbtn btn btn-sm btn-default pull-right"><i class="fa fa-arrow-circle-right"></i> <?php echo SAULANG6; ?></button>
                    </div>
                </div>
                <div id="post-inner" class="col-sm-12">
                    <?php getmyposts($_SESSION['idusuario']); ?>
                </div>
            </div>
        </div>
<!--TO HERE-->
        <script src="js/jquery-2.2.4.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/active.js"></script>

        <!--<script src="sau-content/js/jquery.min.js"></script>-->
        <!--<script src="sau-content/js/bootstrap.min.js"></script>-->
        <!--script src="sau-content/js/jquery.validate.min.js"></script>-->
        <!--script src="sau-content/js/moment-with-locales.js"></script>-->
        <!--script src="sau-content/js/bootstrap-datetimepicker.js"></script>-->
        <!--<script src="sau-content/js/jquery.validate.min.js"></script>-->
        <!--<script src="sau-content/js/additional-methods.min.js"></script>-->

        <!--<script type="text/javascript">
            var messageerror1 = "<?php //echo SAULANG15;?>";
            var messageerror2 = "<?php //echo SAULANG16;?>";
        </script>
        <script src="sau-content/js/sau3.js"></script>
        <script src="sau-content/js/sau3member.js"></script>

        <?php //sau3token(); ?>-->
    </body>
</html>

