<?php
require_once 'adm.functions.php';

$conexion = Conexion::singleton_conexion();

if (isset($_POST['process'])) {
    $process = $_POST['process'];
    if ($process == 1) {
        checkranker();

        $id = $_POST['usuario'];
        $SQL = 'SELECT * FROM usuarios WHERE idusuario = :id LIMIT 1';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':id', $id , PDO::PARAM_INT);
        $sentence -> execute();
        $resultados = $sentence -> fetchAll();

        if (empty($resultados)) {
        } else {
            foreach ($resultados as $key) {
                if ($key['profile'] == 1) {
                    $imageprofile = '<img id="imageprofilechange" src="img/profile-normal.png" >';
                } else {
                    $imageprofile = '<img id="imageprofilechange" src="'.$key['profile'].'" >';
                }

                if ($key['ranker'] == 1) {
                    $rango = 'Usuario';
                } else {
                    $rango = 'Administrador';
                }

                if ($key['activo'] == 1) {
                    $activo = 'No';
                } else {
                    $activo = 'Si';
                }

                echo '
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i>&nbsp;'.$key['nombre'].' '.$key['apellido'].'</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul id="tabsnav" class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#basicosu" aria-controls="basicosu" role="tab" data-toggle="tab">
                                            <i class="glyphicon glyphicon-chevron-right"></i>&nbsp;Datos Básicos
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#imgprofile" aria-controls="imgprofile" role="tab" data-toggle="tab">
                                            <i class="glyphicon glyphicon-chevron-right"></i>&nbsp;Imagen
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#emailu" aria-controls="emailu" role="tab" data-toggle="tab">
                                            <i class="glyphicon glyphicon-chevron-right"></i>&nbsp;Email
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#passwordu" aria-controls="passwordu" role="tab" data-toggle="tab">
                                            <i class="glyphicon glyphicon-chevron-right"></i>&nbsp;Contraseña
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="basicosu">
                                        <form id="frmeditusr">
                                            <p></p>
                                            <label>Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" value="'.$key['nombre'].'" >
                                            <p></p>
                                            <label>Apellido:</label>
                                            <input type="text" class="form-control" name="apellido" value="'.$key['apellido'].'" >
                                            <p></p>
                                            <label>Permalink:</label>
                                            <input type="text" class="form-control" name="permalink" value="'.$key['permalink'].'" >
                                            <p></p>
                                            <label>Activo:</label>
                                            <select class="form-control" name="activo">
                                                <optgroup label="Actual">
                                                    <option value="'.$key['activo'].'">'.$activo.'</option>
                                                </optgroup>
                                                <optgroup label="Valores">
                                                    <option value="2">Si</option>
                                                    <option value="1">No</option>
                                                </optgroup>
                                            </select>
                                            <p></p>
                                            <label>Rango:</label>
                                            <select class="form-control" name="rango">
                                                <optgroup label="Actual">
                                                    <option value="'.$key['ranker'].'">'.$rango.'</option>
                                                </optgroup>
                                                <optgroup label="Valores">
                                                    <option value="1">Usuario</option>
                                                    <option value="2">Administrador</option>
                                                </optgroup>
                                            </select>
                                            <input type="hidden" name="idusuario" value="'.$key['idusuario'].'" >
                                        </form>
                                        <p></p>
                                        <button class="cambiardatosuser btn btn-primary">
                                            <i class="fa fa-floppy-o"></i>&nbsp;Guardar Cambios
                                        </button>
                                    </div>
                                    <div role="tabpanel" class="tab-pane text-center" id="imgprofile">
                                        <div class="hideform">
                                            <form id="profileserialize">
                                                <input type="hidden" name="process" value="4">
                                                <input type="hidden" name="idusuario" value="'.$key['idusuario'].'">
                                                <input id="changeprofile" type="file" name="imageprofile">
                                            </form>
                                        </div>
                                        <p></p>
                                        '.$imageprofile.'
                                        <p></p>
                                        <button data-user="'.$key['idusuario'].'" class="changeimguser btn btn-primary">
                                            <i class="glyphicon glyphicon-picture"></i>&nbsp;Cambiar Imagen
                                        </button>
                                        <button data-user="'.$key['idusuario'].'" class="deleteimguser btn btn-danger">
                                            <i class="fa fa-times"></i>&nbsp;Eliminar Imagen
                                        </button>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="emailu">
                                        <form id="changeemailadm">
                                            <p></p>
                                            <label>Email:</label>
                                            <input type="text" name="email" class="form-control" value="'.$key['email'].'" >
                                            <p></p>
                                            <input type="hidden" name="idusuario" value="'.$key['idusuario'].'" />
                                        </form>
                                        <p></p>
                                        <button class="cambiaremailadmbutton btn btn-primary">
                                            <i class="glyphicon glyphicon-envelope"></i>&nbsp;Cambiar Email
                                        </button>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="passwordu">
                                        <form id="userchangepass">
                                            <p></p>
                                            <label>Nueva Contraseña:</label>
                                            <input type="password" name="newpassword" id="newpassequal" class="form-control" />
                                            <p></p>
                                            <label>Repita Nueva Contraseña:</label>
                                            <input type="password" name="passtwo"  class="form-control" />
                                            <p></p>
                                            <input type="hidden" name="idusuario" value="'.$key['idusuario'].'" />
                                        </form>
                                        <p></p>
                                        <button class="changeuserpassadm btn btn-primary">
                                            <i class="fa fa-floppy-o"></i>&nbsp;Cambiar Contraseña
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }

        echo $id;
    }elseif ($process == 2){
        checkranker();

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $permalink = $_POST['permalink'];
        $activo = $_POST['activo'];
        $ranker = $_POST['rango'];
        $idusuario = $_POST['idusuario'];

        $SQL = 'UPDATE usuarios SET nombre = ?,
                       apellido = ?,
                       permalink = ?,
                       activo = ?,
                       ranker = ?
                WHERE idusuario = ?';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(1, $nombre ,PDO::PARAM_STR);
        $sentence -> bindParam(2, $apellido ,PDO::PARAM_STR);
        $sentence -> bindParam(3, $permalink ,PDO::PARAM_STR);
        $sentence -> bindParam(4, $activo ,PDO::PARAM_INT);
        $sentence -> bindParam(5, $ranker ,PDO::PARAM_INT);
        $sentence -> bindParam(6, $idusuario ,PDO::PARAM_INT);
        $sentence -> execute();
    } elseif ($process == 3) {
        checkranker();

        $idusuario = $_POST['usuario'];
        $SQL = 'SELECT * FROM usuarios WHERE idusuario = :idusuario LIMIT 1';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
        $sentence -> execute();
        $resultados = $sentence -> fetchAll();

        if (empty($resultados)) {
        } else {
            foreach ($resultados as $key) {
                $perfil = $key['profile'];
            }
            if ($perfil == 1) {
            } else {
                // parseamos los datos
                $normal = '../'.$perfil; 
                $small =  '../'.str_replace('normal', 'small', $perfil);
                // borrar imagen
                unlink($normal);
                unlink($small);
                // actualizar
                $UD = 'UPDATE usuarios SET profile = 1 WHERE idusuario = :idusuario';
                $actua = $conexion -> prepare($UD);
                $actua -> bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
                $actua -> execute();
            }
        }
    } elseif ($process == 4) {
        checkranker();

        if (!is_dir("../img/members/")) {
            mkdir("../img/members/", 0777);
        }

        //obtenemos el archivo a subir
        $file = $_FILES['imageprofile']['name'];

        // Obtenemos la extension
        $fileext = new SplFileInfo($file);
        $getextension = $fileext->getExtension();

        // convertimos extension a minusculas
        $extension = strtolower($getextension);

        // Verificamos si el archivo que se sube es valido
        if (strcmp($extension, 'jpg') == 0) {
            processfile($file,$_POST['idusuario']);
            return;
        } else if (strcmp($extension, 'jpeg') == 0) {
            processfile($file,$_POST['idusuario']);
            return;
        } else if (strcmp($extension, 'png') == 0) {
            processfile($file,$_POST['idusuario']);
            return;
        } else if (strcmp($extension, 'gif') == 0) {
            processfile($file,$_POST['idusuario']);
            return;
        } else {
            echo 1;
        }
    } elseif ($process == 5) {
        checkranker();

        $idusuario = $_POST['idusuario'];
        $passone = $_POST['newpassword'];
        $datos = changeuserpassword($idusuario,$passone);
        echo $datos;
    } elseif ($process == 6) {
        checkranker();

        $nombre = $_POST['nombre'];
        $apellido  = $_POST['apellido'];
        $email  = $_POST['email'];
        $password  = $_POST['contrasena'];
        $activo  = $_POST['activo'];
        $rango  = $_POST['rango'];

        $resultado = newuserfunction($nombre,$apellido,$email,$password,$activo,$rango);
        echo $resultado;
    } elseif ($process == 7) {
        checkranker();

        $SQL = 'DELETE FROM usuarios WHERE idusuario = :idusuario';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':idusuario', $_POST['usuario'], PDO::PARAM_INT);
        $sentence -> execute();
    } elseif ($process == 8) {
        checkranker();

        $SQL = 'SELECT * FROM publicaciones WHERE idpublicacion = :idpublicacion LIMIT 1';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':idpublicacion', $_POST['publicacion'], PDO::PARAM_INT);
        $sentence -> execute();
        $resultados = $sentence -> fetchAll();

        if (empty($resultados)) {
             exit();
        } else {
            foreach ($resultados as $key) {
                echo '
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i>&nbsp;Editar Publicación</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form id="publicacioneditfrm">
                                    <label>Publicación:</label>
                                    <textarea class="form-control" rows="5" name="publicacion">'.$key['publicacion'].'</textarea>
                                    <input type="hidden" name="idpublicacion" value="'.$key['idpublicacion'].'">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="savepublicacion btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar Publicacion</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    } elseif ($process == 9) {
        checkranker();

        if (empty($_POST['publicacion'])) {
            exit();
        }
        if (ctype_space($_POST['publicacion'])) {
            exit();
        }

        $SQL = 'UPDATE publicaciones SET publicacion = :publicacion WHERE idpublicacion = :idpublicacion';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':publicacion', $_POST['publicacion'] ,PDO::PARAM_STR);
        $sentence -> bindParam(':idpublicacion', $_POST['idpublicacion'] ,PDO::PARAM_INT);
        $sentence -> execute();
    } elseif ($process == 10) {
        checkranker();

        $SQL = 'DELETE FROM publicaciones WHERE idpublicacion = :idpublicacion';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':idpublicacion', $_POST['publicacion'] , PDO::PARAM_INT);
        $sentence -> execute();

        $Comments = 'DELETE FROM comentarios WHERE publicacion = :publicacion';
        $stncomment = $conexion -> prepare($Comments);
        $stncomment -> bindParam(':publicacion', $_POST['publicacion'] ,PDO::PARAM_INT);
        $stncomment -> execute();
    } elseif ($process == 11) {
        checkranker();

        $fecha = date('Y-m-d h:i:s');
        $leido = 1;
        $mensaje = $_POST['mensaje'];
        $asunto = $_POST['asunto'];

        if (empty($_POST['mensaje']) || empty($_POST['asunto'])) {
            exit();
        }
        if (ctype_space($_POST['mensaje']) || ctype_space($_POST['asunto'])) {
            exit();
        }

        $GETUSR = 'SELECT * FROM usuarios';
        $sentencia = $conexion -> prepare($GETUSR);
        $sentencia -> execute();
        $resultadosusuarios = $sentencia -> fetchAll();

        if (empty($resultadosusuarios)) {
        } else {
            foreach ($resultadosusuarios as $key) {
                $SQL = 'INSERT INTO messages (fecha, de, para, asunto, mensaje, leido) VALUES (:fecha, :de, :para, :asunto, :mensaje, :leido)';
                $sentence = $conexion -> prepare($SQL);
                $sentence -> bindParam(':fecha', $fecha ,PDO::PARAM_STR);
                $sentence -> bindParam(':de', $_SESSION['idusuario'] ,PDO::PARAM_INT);
                $sentence -> bindParam(':para', $key['idusuario'] ,PDO::PARAM_INT);
                $sentence -> bindParam(':asunto', $asunto ,PDO::PARAM_STR);
                $sentence -> bindParam(':mensaje', $mensaje ,PDO::PARAM_STR);
                $sentence -> bindParam(':leido', $leido ,PDO::PARAM_INT);
                $sentence -> execute();
            }
        }
    } elseif ($process == 12) {
        checkranker();

        if (empty($_POST['mensaje']) || empty($_POST['asunto'])) {
            exit();
        }
        if (ctype_space($_POST['mensaje']) || ctype_space($_POST['asunto'])) {
            exit();
        }

        $fecha = date('Y-m-d h:i:s');
        $leido = 1;
        $mensaje = $_POST['mensaje'];
        $asunto = $_POST['asunto'];
        $para = $_POST['usuario'];

        $SQL = 'INSERT INTO messages (fecha, de, para, asunto, mensaje, leido) VALUES (:fecha, :de, :para, :asunto, :mensaje, :leido)';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':fecha', $fecha ,PDO::PARAM_STR);
        $sentence -> bindParam(':de', $_SESSION['idusuario'] ,PDO::PARAM_INT);
        $sentence -> bindParam(':para', $para ,PDO::PARAM_INT);
        $sentence -> bindParam(':asunto', $asunto ,PDO::PARAM_STR);
        $sentence -> bindParam(':mensaje', $mensaje ,PDO::PARAM_STR);
        $sentence -> bindParam(':leido', $leido ,PDO::PARAM_INT);
        $sentence -> execute();
    } elseif ($process == 13) {
        checkranker();

        $SQL = 'UPDATE config
                SET login = ?,
                    register = ?,
                    forgot = ?,
                    smtp = ?,
                    port = ?,
                    fromname = ?,
                    mail = ?,
                    password = ?,
                    url = ?,
                    messagemail = ?,
                    renewmessage = ?,
                    messagechange = ? 
                WHERE idconfig = 1';

        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(1,$_POST['login'],PDO::PARAM_INT);
        $sentence -> bindParam(2,$_POST['register'],PDO::PARAM_INT);
        $sentence -> bindParam(3,$_POST['forgot'],PDO::PARAM_INT);
        $sentence -> bindParam(4,$_POST['smtp'],PDO::PARAM_STR);
        $sentence -> bindParam(5,$_POST['port'],PDO::PARAM_STR);
        $sentence -> bindParam(6,$_POST['fromname'],PDO::PARAM_STR);
        $sentence -> bindParam(7,$_POST['mail'],PDO::PARAM_STR);
        $sentence -> bindParam(8,$_POST['password'],PDO::PARAM_STR);
        $sentence -> bindParam(9,$_POST['url'],PDO::PARAM_STR);
        $sentence -> bindParam(10,$_POST['messagemail'],PDO::PARAM_STR);
        $sentence -> bindParam(11,$_POST['renewmessage'],PDO::PARAM_STR);
        $sentence -> bindParam(12,$_POST['messagechange'],PDO::PARAM_STR);
        $sentence -> execute();
    } elseif ($process == 14) {
        checkranker();

        $SQL = 'SELECT * FROM comentarios WHERE publicacion = :publicacion LIMIT 1';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':publicacion', $_POST['publicacion'], PDO::PARAM_INT);
        $sentence -> execute();
        $resultados = $sentence -> fetchAll();

        if (empty($resultados)) {
             exit();
        } else {
            foreach ($resultados as $key) {
                echo '
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-comments-o"></i> Comentarios</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <thead>
                                            <tr>
                                            <th>Usuario</th>
                                            <th>Fecha</th>
                                            <th>Comentario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                comments($_POST['publicacion']);

                echo '
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    } elseif ($process == 15) {
        checkranker();

        $deletecomment = 'DELETE FROM comentarios WHERE idcomentario = :idcomentario';
        $deletesnt = $conexion -> prepare($deletecomment);
        $deletesnt -> bindParam(':idcomentario',$_POST['delete'],PDO::PARAM_INT);
        $deletesnt -> execute();
    } elseif ($process == 16) {
        checkranker();

        $email = $_POST['email'];
        $stripemail = strip_tags($email);
        $idusuariodata = $_POST['idusuario'];

        $SQL = 'SELECT * FROM usuarios WHERE email = :email LIMIT 1';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':email', $stripemail, PDO::PARAM_STR);
        $sentence -> execute();
        $resultados = $sentence -> fetchAll();

        if (!empty($resultados)) {
            return 1;
        } else {
            $NewPassSQL = 'UPDATE usuarios SET email = :email,
                                activo = 1
                            WHERE idusuario = :idusuario';
            $stnpass = $conexion -> prepare($NewPassSQL);
            $stnpass -> bindParam(':idusuario', $idusuariodata, PDO::PARAM_STR);
            $stnpass -> bindParam(':email', $stripemail, PDO::PARAM_STR);
            $res10=$stnpass -> execute();

            $fecha = date('Y-m-d');

            // Insertar para Verificar
            $mailtoken = sha1($email.TOKENMAIL);
            $ver = 'INSERT INTO verify (token,email,fecha) VALUES (:token,:email,:fecha)';
            $versentence = $conexion -> prepare($ver);
            $versentence -> bindParam(':token',$mailtoken,PDO::PARAM_STR);
            $versentence -> bindParam(':email',$email,PDO::PARAM_STR);
            $versentence -> bindParam(':fecha',$fecha,PDO::PARAM_STR);
            $versentence -> execute();

            // Email
            $dataexplode = configurationmail();
            $parsedata = explode('|', $dataexplode);

            $htmlhead = '<!DOCTYPE html><html><body>';
            $htmlfooter = '</body></html>';
            $activationlink = '<p><label>Reactivar Mi Cuenta: </label><p></p><a href="'.$parsedata[5].'active?token='.$mailtoken.'&email='.$email.'">'.$parsedata[5].'activate?token='.$mailtoken.'&email='.$email.'</a></p>';;

            // Envio de Correo 
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $parsedata[0];   // especiificar el servidor smtp
            $mail->SMTPAuth = true;                           
            $mail->Username = $parsedata[3];   // correo desde el que se enviara
            $mail->Password = $parsedata[4];  // password del correo
            $mail->Port = $parsedata[1];     // el puerto por defecto para SMTP es 587 pero puede ser otro
            $mail->setFrom($parsedata[3], $parsedata[2]);  // remitente, el segundo paramtero es el nombre
            $mail->addAddress($email);   // destino
            $mail->isHTML(true);    
            $mail->Subject = 'Cambio de Correo y Reactivacion de Cuenta - '.SITETITLE;   // Asunto
            $mail->Body    = $htmlhead.$activationlink.$htmlfooter;
            $mail->send();
        }

        echo $idusuariodata;
    } elseif ($process == 17) {
        checkranker();

        $SQL = 'SELECT * FROM usuarios WHERE activo = 1';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> execute();
        $resultados = $sentence -> fetchAll();

        if (empty($resultados)) {
        } else {
            foreach ($resultados as $key) {
                $DELVE = 'DELETE FROM verify WHERE email = :email';
                $sntver = $conexion -> prepare($DELVE);
                $sntver -> bindParam(':email', $key['email'] ,PDO::PARAM_STR);
                $sntver -> execute();

                $DELUSER = 'DELETE FROM usuarios WHERE idusuario = :idusuario';
                $stnuser = $conexion -> prepare($DELUSER);
                $stnuser -> bindParam(':idusuario', $key['idusuario'], PDO::PARAM_INT);
                $stnuser -> execute();
            }
        }
    } elseif ($process == 18) {
    } elseif ($process == 19) {
    } elseif ($process == 20) {
    } elseif ($process == 21) {
    }
}

