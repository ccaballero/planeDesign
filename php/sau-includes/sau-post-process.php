<?php
require_once '../sau-config.php';
require_once 'sau-complements.php';

error_reporting(E_ALL ^ E_NOTICE);
session_start();

try {
	$conexion = new PDO('mysql:host='.HOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
}
catch (PDOException $ex) {
	exit;
}


function saulanger2($lang){
    if ($lang == 1){
      include 'langs/spanish.lang.php';
    }elseif ($lang == 2){
      include 'langs/english.lang.php';
    }
}


function getpreference1(){

try {
  $conexion = new PDO('mysql:host='.HOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
}
catch (PDOException $ex) {
  exit;
}

$SQL = "SELECT * FROM preferiences WHERE usuario = :usuario LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':usuario',$_SESSION['idusuario'], PDO::PARAM_STR);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
    // Idioma por defecto
    saulanger2(SAULANGDEF);
}else{
  foreach ($results as $key){
    // Idioma por usuario
    saulanger2($key['lang']);
  }
 }
}


function checklike($post,$user){

try {
  $conexion = new PDO('mysql:host='.HOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
}
catch (PDOException $ex) {
  exit;
}

$SQL = 'SELECT * FROM likepost WHERE post = :post AND user = :user LIMIT 1';
$stn = $conexion -> prepare($SQL);
$stn -> bindParam(':post', $post, PDO::PARAM_INT);
$stn -> bindParam(':user', $user, PDO::PARAM_INT);
$stn -> execute();
$results = $stn -> fetchAll();
if(empty($results)){
#--------------------------------------------------------------------
  echo'<a data-like="'.$post.'" class="likethis"><i class="fa fa-thumbs-o-up"></i> '.SAULANG10.'</a><a data-like="'.$post.'" class="dontlikethis hidelike"><i class="fa fa-thumbs-o-down"></i> '.SAULANG12.'</a>';
#--------------------------------------------------------------------
}else{
  foreach ($results as $key){
#--------------------------------------------------------------------
    echo'<a data-like="'.$post.'" class="likethis hidelike"><i class="fa fa-thumbs-o-up"></i> '.SAULANG10.'</a><a data-like="'.$post.'" class="dontlikethis"><i class="fa fa-thumbs-o-down"></i> '.SAULANG12.'</a>';
#--------------------------------------------------------------------
  }
 }
}



function getthelikes($post){

try {
  $conexion = new PDO('mysql:host='.HOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
}
catch (PDOException $ex) {
  exit;
}

  $SQL = 'SELECT * FROM likepost WHERE post = :post';
  $stn = $conexion -> prepare($SQL);
  $stn -> bindParam(':post', $post, PDO::PARAM_INT);
  $stn -> execute();   
  $counter = $stn -> rowCount();
  $data = '<a id="like-count-'.$post.'"class="pull-right">'.$counter.' Me gusta</a>';
  return $data; 
}



function comments($post){

try {
  $conexion = new PDO('mysql:host='.HOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
}
catch (PDOException $ex) {
  exit;
}

$SQL = "SELECT usuarios.permalink, publicaciones.usuario AS posteruser,comentarios.idcomentario,comentarios.fecha,comentarios.comentario, usuarios.idusuario, usuarios.nombre AS nombre, usuarios.apellido AS apellido,usuarios.profile AS picture FROM comentarios INNER JOIN usuarios ON usuarios.idusuario = comentarios.usuario INNER JOIN publicaciones ON publicaciones.idpublicacion = comentarios.publicacion WHERE comentarios.publicacion = :post ORDER BY comentarios.idcomentario DESC";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':post',$post, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
  
}else{
  foreach ($results as $key){
echo'
<div id="time-comment-'.$key['idcomentario'].'" class="col-sm-12">
<div class="message-item" style="margin-top: 5px;margin-bottom: 5px;">
  <div class="message-inner">
    <div class="message-head clearfix">
      <div class="message-icon pull-left">';

      if ($key['picture'] == 1) {
       echo '<img src="sau-content/images/profile-small.png">';
      }else{
       $finalprofile = str_replace('normal-', 'small-', $key['picture']);
       echo'<img src="'.$finalprofile.'">';
      }

  echo'</div>
      <div class="user-detail">
        <h5 class="handle"><a href="profile!'.$key['permalink'].'">'.$key['nombre'].' '.$key['apellido'].'</a></h5>
        <div class="post-time">
          '.fechastring($key['fecha']).'
        </div>
         ';
        
        if ($_SESSION['ranker'] == 2){
          echo'<a data-comment="'.$key['idcomentario'].'" class="deletecomment"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
        }elseif($key['idusuario'] == $_SESSION['idusuario']) {
          echo'<a data-comment="'.$key['idcomentario'].'" class="deletecomment"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
        }elseif ($key['posteruser'] == $_SESSION['idusuario']){
          echo'<a data-comment="'.$key['idcomentario'].'" class="deletecomment"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
        }

      echo'
      </div>
    </div>
    <div class="qa-message-content">
      <p>'.utf8_decode($key['comentario']).'</p>
    </div>
  </div>  
  </div>  
</div>

';
  }
}

}



if (isset($_POST['process'])) {
#----------------------------------------------------------------------------------

$process = $_POST['process'];

if ($process == 1){
	
  $publicacion = strip_tags($_POST['posttext']);
  $fecha = date('Y-m-d h:i:s');

  $SQL = "INSERT INTO publicaciones (publicacion,fecha,usuario) VALUES (:publicacion,:fecha,:usuario)";
  $snt = $conexion -> prepare($SQL);
  $snt -> bindParam(':publicacion',$publicacion);
  $snt -> bindParam(':fecha',$fecha);
  $snt -> bindParam(':usuario',$_SESSION['idusuario']);
  $snt -> execute();
  $ultimoid = $conexion -> lastInsertId(); 

  $namer = gethename($_SESSION['idusuario'],$conexion);
  $profilepicture = getpicture($_SESSION['idusuario'],$conexion);
  $fecher = fechastring($fecha);
  $fechatitle = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($fecha)));
  $userpost = getuserpost($ultimoid,$conexion);
  $permalink = getpostpermalink($_SESSION['idusuario'],$conexion);
  getpreference($_SESSION['idusuario'],$conexion);


  echo'
  <div id="time-post-'.$ultimoid.'" class="message-item">
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
        
        if($_SESSION['ranker'] == 2){
          echo '<a data-post="'.$ultimoid.'" class="deletepost pull-right"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
        }elseif ($userpost == $_SESSION['idusuario']){
          echo '<a data-post="'.$ultimoid.'" class="deletepost pull-right"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
        }
			
      echo'</div>
		</div>
		<div class="qa-message-content">
			<p>'.$publicacion.'</p>
		</div>
	</div>  
    <div class="col-sm-12 message-footer">
      <a data-like="'.$ultimoid.'" class="likethis"><i class="fa fa-thumbs-o-up"></i> Me Gusta</a>
      <a data-like="'.$ultimoid.'" class="dontlikethis hidelike"><i class="fa fa-thumbs-o-down"></i> Ya no me gusta</a>
    	<a data-comment="'.$ultimoid.'" class="commentthis"><i class="fa fa-comment-o"></i> Comentar</a>
    	<a id="like-count-'.$ultimoid.'"class="pull-right">0 Me gusta</a>
    </div>
    <div id="comment-'.$ultimoid.'" class="col-sm-12 comments-box" style="display: none;">
      <div id="commenterror'.$ultimoid.'"></div>
      <div class="input-group">
        <form id="commentfrm'.$ultimoid.'">
          <input type="text" name="commentstext" class="form-control" placeholder="Comentarios...">
        </form>
        <span class="input-group-btn">
          <button data-comment="'.$ultimoid.'" class="btncommentpost btn btn-default" type="button"><i class="fa fa-comment-o"></i> Comentar</button>
        </span>
      </div><!-- /input-group -->
    </div>
    <!-- comentarios -->
      <div id="comment-box-real-'.$ultimoid.'"></div>
    <!-- comentarios -->
  </div>


  ';

}
elseif ($process == 2){
	
$SQL = 'SELECT * FROM likepost WHERE post = :post AND user = :user LIMIT 1';
$stn = $conexion -> prepare($SQL);
$stn -> bindParam(':post', $_POST['like'], PDO::PARAM_INT);
$stn -> bindParam(':user', $_SESSION['idusuario'], PDO::PARAM_INT);
$stn -> execute();
$results = $stn -> fetchAll();
if(empty($results)){
#--------------------------------------------------------------------
     
     $likedislike = 'INSERT INTO likepost (post,user) VALUES (:post,:user)';
     $sentence = $conexion -> prepare($likedislike);
     $sentence -> bindParam(':post', $_POST['like'], PDO::PARAM_INT);
     $sentence -> bindParam(':user', $_SESSION['idusuario'], PDO::PARAM_INT);
     $sentence -> execute();

#--------------------------------------------------------------------
}else{
#--------------------------------------------------------------------
     echo "1";
#--------------------------------------------------------------------
}



}
elseif ($process == 3){

$SQL = 'SELECT * FROM likepost WHERE post = :post AND user = :user LIMIT 1';
$stn = $conexion -> prepare($SQL);
$stn -> bindParam(':post', $_POST['like'], PDO::PARAM_INT);
$stn -> bindParam(':user', $_SESSION['idusuario'], PDO::PARAM_INT);
$stn -> execute();
$results = $stn -> fetchAll();
if(empty($results)){
#--------------------------------------------------------------------
     echo "1";
#--------------------------------------------------------------------
}else{
#--------------------------------------------------------------------
     $likedislike = 'DELETE FROM likepost WHERE post = :post  AND user = :user';
     $sentence = $conexion -> prepare($likedislike);
     $sentence -> bindParam(':post', $_POST['like'], PDO::PARAM_INT);
     $sentence -> bindParam(':user', $_SESSION['idusuario'], PDO::PARAM_INT);
     $sentence -> execute();
#--------------------------------------------------------------------
}

}
elseif ($process == 4){
	
  $SQL = 'SELECT * FROM likepost WHERE post = :post';
  $stn = $conexion -> prepare($SQL);
  $stn -> bindParam(':post', $_POST['post'], PDO::PARAM_INT);
  $stn -> execute();   
  $counter = $stn -> rowCount();

  echo $counter;

}
elseif ($process == 5){

  $deletepost = 'DELETE FROM publicaciones WHERE idpublicacion = :idpublicacion AND usuario = :usuario';
  $sentence = $conexion -> prepare($deletepost);
  $sentence -> bindParam(':idpublicacion', $_POST['delete'], PDO::PARAM_INT);
  $sentence -> bindParam(':usuario', $_SESSION['idusuario'], PDO::PARAM_INT);
  $sentence -> execute();

  $deletecomment = 'DELETE FROM comentarios WHERE publicacion = :publicacion';
  $deletesnt = $conexion -> prepare($deletecomment);
  $deletesnt -> bindParam(':publicacion',$_POST['delete'],PDO::PARAM_INT);
  $deletesnt -> execute();

  $deletelike = 'DELETE FROM likepost WHERE post = :post';
  $dellike = $conexion -> prepare($deletelike);
  $dellike -> bindParam(':post',$_POST['delete'], PDO::PARAM_INT);
  $dellike -> execute();

}
elseif ($process == 6){

  $deletecomment = 'DELETE FROM comentarios WHERE idcomentario = :idcomentario';
  $deletesnt = $conexion -> prepare($deletecomment);
  $deletesnt -> bindParam(':idcomentario',$_POST['delete'],PDO::PARAM_INT);
  $deletesnt -> execute();

}
elseif ($process == 7){

  $SQL = 'SELECT * FROM contacts WHERE contact = :contact AND fromcontact = :fromcontact';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':contact',$_POST['contact'],PDO::PARAM_INT);
  $sentence -> bindParam(':fromcontact',$_SESSION['idusuario'],PDO::PARAM_INT);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
   if(empty($resultados)){

     $fecha = date('Y-m-d');
     $newcontact = 'INSERT INTO contacts (contact,fromcontact,fecha) VALUES (:contact,:fromcontact,:fecha)';
     $concatec = $conexion -> prepare($newcontact);
     $concatec -> bindParam(':contact', $_POST['contact'], PDO::PARAM_INT);
     $concatec -> bindParam(':fromcontact', $_SESSION['idusuario'], PDO::PARAM_INT);
     $concatec -> bindParam(':fecha', $fecha, PDO::PARAM_STR);
     $concatec -> execute();

   }else{
       return;
   }

}
elseif ($process == 8){


  $SQL = 'SELECT * FROM contacts WHERE contact = :contact AND fromcontact = :fromcontact';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':contact',$_POST['contact'],PDO::PARAM_INT);
  $sentence -> bindParam(':fromcontact',$_SESSION['idusuario'],PDO::PARAM_INT);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
      return;
   }else{

     $newcontact = 'DELETE FROM contacts WHERE contact = :contact AND fromcontact = :fromcontact';
     $concatec = $conexion -> prepare($newcontact);
     $concatec -> bindParam(':contact', $_POST['contact'], PDO::PARAM_INT);
     $concatec -> bindParam(':fromcontact', $_SESSION['idusuario'], PDO::PARAM_INT);
     $concatec -> execute();

   }


}
elseif ($process == 9){

$tokenparse1 = base64_decode($_POST['tokenuser']);
$tokenparse2 = substr($tokenparse1, 0,19);
$tokenparse3 = str_replace($tokenparse2, '', $tokenparse1);
$asunto = strip_tags($_POST['asunto']);
$mensaje = strip_tags($_POST['mensaje']);
$leido = 1;

$SQL = 'INSERT INTO messages (fecha,de,para,asunto,mensaje,leido) VALUES (:fecha,:de,:para,:asunto,:mensaje,:leido)';
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':fecha',$tokenparse2,PDO::PARAM_STR);
$sentence -> bindParam(':de',$_SESSION['idusuario'],PDO::PARAM_INT);
$sentence -> bindParam(':para',$tokenparse3,PDO::PARAM_INT);
$sentence -> bindParam(':asunto',$asunto,PDO::PARAM_STR);
$sentence -> bindParam(':mensaje',$mensaje,PDO::PARAM_STR);
$sentence -> bindParam(':leido',$leido,PDO::PARAM_INT);
$sentence -> execute();


}
elseif ($process == 10){

$tokenparse1 = base64_decode($_POST['data']);
$tokenparse2 = substr($tokenparse1, 0,10);
$tokenparse3 = str_replace($tokenparse2, '', $tokenparse1);

$SQL = 'SELECT messages.idmessage,messages.mensaje,messages.leido,usuarios.permalink,usuarios.nombre,usuarios.apellido,messages.asunto,messages.fecha AS fecha FROM messages INNER JOIN usuarios ON usuarios.idusuario = messages.de WHERE messages.idmessage = :idmessage';
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idmessage', $tokenparse3, PDO::PARAM_INT);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
if(empty($resultados)){
  # code...
}else{
  foreach($resultados as $key){

    $fecha = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($key['fecha'])));
    $asunto = '<i class="fa fa-envelope-o"></i> '.$key['asunto'];
    $message = '
    <div class="col-md-12">
      <p class="nomargin"><i class="fa fa-user"></i> '.$key['nombre'].' '.$key['apellido'].'</p>
      <p class="nomargin"><i class="fa fa-clock-o"></i> '.$fecha.'</p>
      <p></p>
    </div>
    <div class="col-md-12">
    <p>'.$key['mensaje'].'</p>
    </div>
    ';
    $read = $key['leido'];
    $idmessage = $key['idmessage'];
  }
}

if ($read == 1) {
   
   $UPDA = 'UPDATE messages SET leido = 2 WHERE idmessage = :idmessage';
   $senupda = $conexion -> prepare($UPDA);
   $senupda -> bindParam(':idmessage', $tokenparse3, PDO::PARAM_INT);
   $senupda -> execute();

}


$data = array('asunto' => $asunto, 'message' => $message, 'leido' => $idmessage, 'read' => $read);
echo json_encode($data);

}

elseif ($process == 11) {

$tokenparse1 = base64_decode($_POST['data']);
$tokenparse2 = substr($tokenparse1, 0,10);
$tokenparse3 = str_replace($tokenparse2, '', $tokenparse1);

$delmessage = 'DELETE FROM messages WHERE idmessage = :idmessage AND para = :para';
$concatec = $conexion -> prepare($delmessage);
$concatec -> bindParam(':idmessage', $tokenparse3, PDO::PARAM_INT);
$concatec -> bindParam(':para', $_SESSION['idusuario'], PDO::PARAM_INT);
$concatec -> execute();


}elseif ($process == 12){
#---------------------------------------------------------------------------------

getpreference1();

$resultados = 6;
$page = $_POST['page'];
$inicial = ($page - 1) * $resultados;

$SQL = "SELECT usuarios.permalink,publicaciones.idpublicacion,publicaciones.publicacion,publicaciones.fecha,publicaciones.usuario AS usuariopost, usuarios.nombre AS nombre,usuarios.apellido AS apellido,usuarios.profile AS picture, publicaciones.fecha FROM publicaciones INNER JOIN usuarios ON publicaciones.usuario = usuarios.idusuario WHERE publicaciones.usuario = :usuario ORDER BY publicaciones.idpublicacion DESC LIMIT ".$inicial.",6";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':usuario',$_SESSION['idusuario'], PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
  
   echo '
      <div id="noposts" class="alert alert-info alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <i class="fa fa-files-o"></i> <strong>'.SAULANG33.'</strong></div>
   ';

}else{
  foreach ($results as $key){

echo'
<!-- time line -->
<div id="time-post-'.$key['idpublicacion'].'" class="message-item"> 
  <div class="message-inner">
    <div class="message-head clearfix">
      <div class="message-icon pull-left">';
        
             if ($key['picture'] == 1) {
              echo '<img src="sau-content/images/profile-small.png">';
             }else{
              $finalprofile = str_replace('normal-', 'small-', $key['picture']);
              echo'<img src="'.$finalprofile.'">';
             }


    echo'</div>
      <div class="user-detail">
        <h5 class="handle"><a href="profile!'.$key['permalink'].'">'.$key['nombre'].' '.$key['apellido'].'</a></h5>
        <div class="post-time">
                   '.fechastring($key['fecha']).'
        </div>';

              if($_SESSION['ranker'] == 2){
                echo '<a data-post="'.$key['idpublicacion'].'" class="deletepost pull-right"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
              }elseif ($key['usuariopost'] == $_SESSION['idusuario']){
                echo '<a data-post="'.$key['idpublicacion'].'" class="deletepost pull-right"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
              }

      echo'</div>
    </div>
    <div class="qa-message-content">
      <p>'.utf8_decode($key['publicacion']).'</p>
    </div>
  </div>  
    <div class="col-sm-12 message-footer">
        ';
         checklike($key['idpublicacion'],$_SESSION['idusuario']);
        echo'
      <a onclick="showboxafter('.$key['idpublicacion'].')" ><i class="fa fa-comment-o"></i> '.SAULANG11.'</a>
      '.getthelikes($key['idpublicacion']).'
    </div>
    <div id="comment-'.$key['idpublicacion'].'" class="col-sm-12 comments-box">
      <div id="commenterror'.$key['idpublicacion'].'"></div>
      <div class="input-group">
        <form id="commentfrm'.$key['idpublicacion'].'">
          <input type="text" name="commentstext" class="form-control" placeholder="Comentarios...">
        </form>
        <span class="input-group-btn">
          <button onclick="commentsfterbox('.$key['idpublicacion'].')" class="btncommentpost btn btn-default" type="button"><i class="fa fa-comment-o"></i> '.SAULANG11.'</button>
        </span>
      </div><!-- /input-group -->
    </div>

<!-- comentarios -->
<div id="comment-box-real-'.$key['idpublicacion'].'">';
    comments($key['idpublicacion']);
echo'
</div>
<!-- comentarios -->

</div>
<!-- time line -->


';
  }
 }  



#---------------------------------------------------------------------------------
}elseif ($process == 13){
//////////////////////////////////////////////////////////////////////////////////

getpreference1();

$resultados = 6;
$page = $_POST['page'];
$useriddata = $_POST['usuario'];
$inicial = ($page - 1) * $resultados;

$SQL = "SELECT usuarios.permalink,publicaciones.idpublicacion,publicaciones.publicacion,publicaciones.fecha,publicaciones.usuario AS usuariopost, usuarios.nombre AS nombre,usuarios.apellido AS apellido,usuarios.profile AS picture, publicaciones.fecha FROM publicaciones INNER JOIN usuarios ON publicaciones.usuario = usuarios.idusuario WHERE publicaciones.usuario = :usuario ORDER BY publicaciones.idpublicacion DESC LIMIT ".$inicial.",6";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':usuario',$useriddata, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
  
   echo '
      <div id="noposts" class="alert alert-info alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <i class="fa fa-files-o"></i> <strong>'.SAULANG33.'</strong></div>
   ';

}else{
  foreach ($results as $key){

echo'
<!-- time line -->
<div id="time-post-'.$key['idpublicacion'].'" class="message-item"> 
  <div class="message-inner">
    <div class="message-head clearfix">
      <div class="message-icon pull-left">';
        
             if ($key['picture'] == 1) {
              echo '<img src="sau-content/images/profile-small.png">';
             }else{
              $finalprofile = str_replace('normal-', 'small-', $key['picture']);
              echo'<img src="'.$finalprofile.'">';
             }


    echo'</div>
      <div class="user-detail">
        <h5 class="handle"><a href="profile!'.$key['permalink'].'">'.$key['nombre'].' '.$key['apellido'].'</a></h5>
        <div class="post-time">
                   '.fechastring($key['fecha']).'
        </div>';

              if($_SESSION['ranker'] == 2){
                echo '<a data-post="'.$key['idpublicacion'].'" class="deletepost pull-right"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
              }elseif ($key['usuariopost'] == $_SESSION['idusuario']){
                echo '<a data-post="'.$key['idpublicacion'].'" class="deletepost pull-right"><i class="fa fa-times"></i> '.SAULANG13.'</a>';
              }

      echo'</div>
    </div>
    <div class="qa-message-content">
      <p>'.utf8_decode($key['publicacion']).'</p>
    </div>
  </div>  
    <div class="col-sm-12 message-footer">
        ';
         checklike($key['idpublicacion'],$_SESSION['idusuario']);
        echo'
      <a onclick="showboxafter('.$key['idpublicacion'].')" ><i class="fa fa-comment-o"></i> '.SAULANG11.'</a>
      '.getthelikes($key['idpublicacion']).'
    </div>
    <div id="comment-'.$key['idpublicacion'].'" class="col-sm-12 comments-box">
      <div id="commenterror'.$key['idpublicacion'].'"></div>
      <div class="input-group">
        <form id="commentfrm'.$key['idpublicacion'].'">
          <input type="text" name="commentstext" class="form-control" placeholder="Comentarios...">
        </form>
        <span class="input-group-btn">
          <button onclick="commentsfterbox('.$key['idpublicacion'].')" class="btncommentpost btn btn-default" type="button"><i class="fa fa-comment-o"></i> '.SAULANG11.'</button>
        </span>
      </div><!-- /input-group -->
    </div>

<!-- comentarios -->
<div id="comment-box-real-'.$key['idpublicacion'].'">';
    comments($key['idpublicacion']);
echo'
</div>
<!-- comentarios -->

</div>
<!-- time line -->


';
  }
 }  






///////////////////////////////////////////////////////////////////////////////////
}elseif ($process == 14){
  # code...
}elseif ($process == 15){
  # code...
}




#----------------------------------------------------------------------------------	
}