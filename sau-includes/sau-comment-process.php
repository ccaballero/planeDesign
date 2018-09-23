<?php
require_once '../sau-config.php';
require_once 'sau-complements.php';
require_once '../sau-admin/phpmailer/PHPMailerAutoload.php';

error_reporting(E_ALL ^ E_NOTICE);
session_start();

try {
	$conexion = new PDO('mysql:host='.HOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
}
catch (PDOException $ex) {
	exit;
}


function sanear_string($string){ 
   $string = trim($string); 
   $string = str_replace( array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string ); 
   $string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string ); 
   $string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string ); 
   $string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string ); 
   $string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string ); 
   $string = str_replace(array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string );
   $string = str_replace(array("\\", "¨", "º", "-", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">“, “< ", ";", ",", ":", ".", " "), '', $string ); 
   return $string; 
}


if (isset($_POST['process'])) {
#----------------------------------------------------------------------------------

$process = $_POST['process'];

if ($process == 1){

  $comentario = strip_tags($_POST['commentstext']);
  $fecha = date('Y-m-d h:i:s');

  $SQL = "INSERT INTO comentarios (comentario,fecha,usuario,publicacion) VALUES (:comentario,:fecha,:usuario,:publicacion)";
  $snt = $conexion -> prepare($SQL);
  $snt -> bindParam(':comentario',$comentario,PDO::PARAM_STR);
  $snt -> bindParam(':publicacion',$_POST['post'],PDO::PARAM_INT);
  $snt -> bindParam(':fecha',$fecha,PDO::PARAM_STR);
  $snt -> bindParam(':usuario',$_SESSION['idusuario'],PDO::PARAM_INT);
  $snt -> execute(); 
  $ultimoid = $conexion -> lastInsertId();

  $namer = gethename($_SESSION['idusuario'],$conexion);
  $profilepicture = getpicture($_SESSION['idusuario'],$conexion);
  $posterusercomment = getpostcomment($ultimoid,$conexion);
  $fecher = fechastring($fecha);
  $fechatitle = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($fecha)));
  $permalink = getpostpermalink($_SESSION['idusuario'],$conexion);
  getpreference($_SESSION['idusuario'],$conexion);

echo'
<div id="time-comment-'.$ultimoid.'" class="col-sm-12">
<div class="message-item" style="margin-top: 5px;margin-bottom: 5px;">
	<div class="message-inner">
		<div class="message-head clearfix">
			<div class="message-icon pull-left">';

      if ($profilepicture == 1) {
       echo '<img src="sau-content/images/profile-small.png">';
      }else{
       $finalprofile = str_replace('normal-', 'small-', $profilepicture);
       echo'<img src="'.$finalprofile.'">';
      }

 echo'</div>
			<div class="user-detail">
				<h5 class="handle"><a href="profile!'.$permalink.'">'.$namer.'</a></h5>
				<div class="post-time">
                   <p title="'.$fechatitle.'"><i class="glyphicon glyphicon-time"></i> '.$fecher.'</p>
				</div>';
   
        if ($_SESSION['ranker'] == 2){
          echo'<a data-comment="'.$ultimoid.'" class="deletecomment"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
        }elseif ($posterusercomment == $_SESSION['idusuario']){
          echo'<a data-comment="'.$ultimoid.'" class="deletecomment"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
        }

        echo'
			</div>
		  </div>
		<div class="qa-message-content">
			<p>'.$comentario.'</p>
		</div>
	</div>  
  </div>	
</div>
';



}
elseif ($process == 2){

  $Pref = 'SELECT * FROM preferiences WHERE usuario = :usuario';
  $prefstn = $conexion -> prepare($Pref);
  $prefstn -> bindParam(':usuario', $_SESSION['idusuario'], PDO::PARAM_INT);
  $prefstn -> execute();
  $totalpref = $prefstn -> fetchAll();
  if(empty($totalpref)){

    $SQL = 'INSERT INTO preferiences (theme,lang,usuario) VALUES (:theme,:lang,:usuario)';
    $sentence = $conexion -> prepare($SQL);
    $sentence -> bindParam(':lang', $_POST['lang'], PDO::PARAM_INT);
    $sentence -> bindParam(':theme', $_POST['theme'], PDO::PARAM_INT);
    $sentence -> bindParam(':usuario', $_SESSION['idusuario'], PDO::PARAM_INT);
    $sentence -> execute();

  }else{

    $SQL = "UPDATE preferiences SET lang = :lang, theme = :theme WHERE usuario = :usuario";
    $sentence = $conexion -> prepare($SQL);
    $sentence -> bindParam(':lang', $_POST['lang'], PDO::PARAM_INT);
    $sentence -> bindParam(':theme', $_POST['theme'], PDO::PARAM_INT);
    $sentence -> bindParam(':usuario', $_SESSION['idusuario'], PDO::PARAM_INT);
    $sentence -> execute();

  }

}
elseif ($process == 3){

  $nombre = strip_tags($_POST['nombre']);
  $apellido = strip_tags($_POST['apellidos']);

  $SQL = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido WHERE idusuario = :idusuario";
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':nombre', $nombre, PDO::PARAM_INT);
  $sentence -> bindParam(':apellido', $apellido, PDO::PARAM_INT);
  $sentence -> bindParam(':idusuario', $_SESSION['idusuario'], PDO::PARAM_INT);
  $sentence -> execute();


}
elseif ($process == 4){

  $crypt = sha1(SALT.$_POST['actualpass'].PEPER);

  $SQL = 'SELECT * FROM usuarios WHERE password = :password AND idusuario = :idusuario';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':password',$crypt, PDO::PARAM_STR);
  $sentence -> bindParam(':idusuario',$_SESSION['idusuario'], PDO::PARAM_INT);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if(empty($resultados)){
     echo 1;
  }else{
     $cryptupda = sha1(SALT.$_POST['newpassconf'].PEPER);
     $updatepass = 'UPDATE usuarios SET password = :password WHERE idusuario = :idusuario';
     $senteceupda = $conexion -> prepare($updatepass);
     $senteceupda -> bindParam(':password',$cryptupda, PDO::PARAM_STR);
     $senteceupda -> bindParam(':idusuario',$_SESSION['idusuario'], PDO::PARAM_INT);
     $senteceupda -> execute();
  }

}


elseif ($process == 5){

$stripemail = strip_tags($_POST['email']);

if ($stripemail == $_SESSION['email']){
  echo 777;
}else{

// verificamos correo electronico
$SQL = 'SELECT * FROM usuarios WHERE email = :email';
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':email', $stripemail, PDO::PARAM_STR);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
if (empty($resultados)){
#------------------------------------------------------------------
     // Verficamos el nuevo correo   

     $NewMail = 'UPDATE usuarios SET email = :email, activo = 1 WHERE idusuario = :idusuario';
     $newstn = $conexion -> prepare($NewMail);
     $newstn -> bindParam(':email', $stripemail, PDO::PARAM_STR);
     $newstn -> bindParam(':idusuario', $_SESSION['idusuario'], PDO::PARAM_INT);
     $newstn -> execute();

     // Insertar para Verificar
     $regdate = date('Y-m-d');
     $mailtoken = sha1($stripemail.TOKENMAIL.$regdate);
     $ver = 'INSERT INTO verify (token,email,fecha) VALUES (:token,:email,:fecha)';
     $versentence = $conexion -> prepare($ver);
     $versentence -> bindParam(':token',$mailtoken,PDO::PARAM_STR);
     $versentence -> bindParam(':email',$stripemail,PDO::PARAM_STR);
     $versentence -> bindParam(':fecha',$regdate,PDO::PARAM_STR);
     $versentence -> execute();

     $dataexplode = congifurationmail($conexion);
     $parsedata = explode("|", $dataexplode);

     $htmlhead = '<!DOCTYPE html><html><body>';
     $htmlfooter = '</body></html>';
     $messageone = '<p>'.$parsedata[6].'</p><p></p>';
     $activationlink = '<p><label>'.SAULANG69.'</label><p></p><a href="'.$parsedata[5].'sauactive?token='.$mailtoken.'&email='.$stripemail.'">'.$parsedata[5].'activate?token='.$mailtoken.'&email='.$stripemail.'</a>';


     // Envio de Correo 
     $mail = new PHPMailer;
     $mail->isSMTP();                                      
     $mail->Host = $parsedata[0];   // especiificar el servidor smtp
     $mail->SMTPAuth = true;                           
     $mail->Username = $parsedata[3];   // correo desde el que se enviara
     $mail->Password = $parsedata[4];  // password del correo
     $mail->Port = $parsedata[1];     // el puerto por defecto para SMTP es 587 pero puede ser otro
     $mail->setFrom($parsedata[3], $parsedata[2]);  // remitente, el segundo paramtero es el nombre
     $mail->addAddress($stripemail);   // destino
     $mail->isHTML(true);    
     $mail->Subject = SAULANG68.' - '.SITETITLE;   // Asunto
     $mail->Body    = $htmlhead.$messageone.$activationlink.$htmlfooter;
     $mail->send(); 


#------------------------------------------------------------------
}else{
  echo 666;
}

}


}

elseif ($process == 6){

$sanizado = sanear_string($_POST['permalink']);
$SE = 'SELECT * FROM usuarios WHERE permalink = :permalink';
$sen = $conexion -> prepare($SE);
$sen -> bindParam(':permalink', $sanizado, PDO::PARAM_STR);
$sen -> execute();
$checkout = $sen -> fetchAll();
if (empty($checkout)){
     $SQL = 'UPDATE usuarios SET permalink = :permalink WHERE idusuario = :idusuario';
     $sentence = $conexion -> prepare($SQL);
     $sentence -> bindParam(':permalink',$sanizado, PDO::PARAM_STR);
     $sentence -> bindParam(':idusuario',$_SESSION['idusuario'], PDO::PARAM_STR);
     $sentence -> execute();

}else{
     echo 1;
}

}
elseif ($process == 7){
	# code...
}
elseif ($process == 8){
	# code...
}
elseif ($process == 9){
	# code...
}
elseif ($process == 10){
	# code...
}

#----------------------------------------------------------------------------------	
}
