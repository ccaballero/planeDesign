<?php

// Conexion a Base de datos
require_once 'sau-admin/sau-login.php';
require_once 'sau-admin/phpmailer/PHPMailerAutoload.php'; 




// Token del usuario
function sau3token(){

  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT registro,idusuario,nombre FROM usuarios WHERE idusuario = :idusuario LIMIT 1';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':idusuario',$_SESSION['idusuario'],PDO::PARAM_INT);
  $sentence -> execute();
    $resultados = $sentence -> fetchAll();
    if (empty($resultados)){
    }else{
      foreach ($resultados as $key){
              
$crypt = sha1($key['registro'].$key['idusuario'].$key['nombre']);
$timelinelimit = knowtimelinepost();
echo'<script type="text/javascript">
         var initialsau4timeline = 1;
         var sau3token = "'.$crypt.'"; 
         var sautimelinelimit = '.$timelinelimit .';
     </script>
';
      }
    }
}



// Token del usuario
function sau3tokenprofile($usuario){

  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT registro,idusuario,nombre FROM usuarios WHERE idusuario = :idusuario LIMIT 1';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':idusuario',$usuario,PDO::PARAM_INT);
  $sentence -> execute();
    $resultados = $sentence -> fetchAll();
    if (empty($resultados)){
    }else{
      foreach ($resultados as $key){
              
$crypt = sha1($key['registro'].$key['idusuario'].$key['nombre']);
$timelinelimit = knowtimelinepostprofile($usuario);
echo'<script type="text/javascript">
         var initialsau4timelineprofile = 1;
         var sau3token = "'.$crypt.'"; 
         var sautimelinelimitprofile = '.$timelinelimit .';
         var datememeber = '.$key['idusuario'].';
     </script>
';
      }
    }
}


function knowtimelinepostprofile($usuario){

  $conexion = Conexion::singleton_conexion();

  $RowCount = "SELECT * FROM publicaciones WHERE usuario = :usuario";
  $counsentence = $conexion -> prepare($RowCount);
  $counsentence -> bindParam(':usuario',$usuario,PDO::PARAM_INT);
  $counsentence -> execute();
  $cuantos = $counsentence -> rowCount();

  // Tamaño de pagina
  $resultados = 6;
  // total parginado
  $totalpaginas = ceil($cuantos / $resultados);
  // Total de paginas
  return $totalpaginas;

}



function knowtimelinepost(){

  $conexion = Conexion::singleton_conexion();

  $RowCount = "SELECT * FROM publicaciones WHERE usuario = :usuario";
  $counsentence = $conexion -> prepare($RowCount);
  $counsentence -> bindParam(':usuario',$_SESSION['idusuario'],PDO::PARAM_INT);
  $counsentence -> execute();
  $cuantos = $counsentence -> rowCount();

  // Tamaño de pagina
  $resultados = 6;
  // total parginado
  $totalpaginas = ceil($cuantos / $resultados);
  // Total de paginas
  return $totalpaginas;

}


function loginactive(){
  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();
  $SQL = 'SELECT login FROM config WHERE idconfig = 1';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if (empty($resultados)){
    # code...
  }else{
    foreach ($resultados as $key){
       $activo = $key['login'];
    }
  }
  return $activo;
}


function registeractive(){
  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();
  $SQL = 'SELECT register FROM config WHERE idconfig = 1';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if (empty($resultados)){
    # code...
  }else{
    foreach ($resultados as $key){
       $activo = $key['register'];
    }
  }
  return $activo;
}


function forgotactive(){
  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();
  $SQL = 'SELECT forgot FROM config WHERE idconfig = 1';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if (empty($resultados)){
    # code...
  }else{
    foreach ($resultados as $key){
       $activo = $key['forgot'];
    }
  }
  return $activo;
}





function getpreference($iduser){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();
$SQL = "SELECT * FROM preferiences WHERE usuario = :usuario LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':usuario',$iduser, PDO::PARAM_STR);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
    // Idioma por defecto
    saulanger(SAULANGDEF);
    // Estilo por defecto
    getstyle(1);
}else{
  foreach ($results as $key){
    // Idioma por usuario
    saulanger($key['lang']);
    // Estilo por usuario
    getstyle($key['theme']);
  }
 }
}


function getstyle($style){
    if($style == 1){
      echo'<link href="sau-content/sau-default.css" rel="stylesheet">';
    }elseif ($style == 2) {
      echo'<link href="sau-content/sau-blue.css" rel="stylesheet">';
    }elseif ($style == 3) {
      echo'<link href="sau-content/sau-black.css" rel="stylesheet">';
    }elseif ($style == 4) {
      echo'<link href="sau-content/sau-gray.css" rel="stylesheet">';
    }elseif ($style == 5) {
      echo'<link href="sau-content/sau-red.css" rel="stylesheet">';
    }
}

function getidperma($permalink){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "SELECT * FROM usuarios WHERE permalink = :permalink LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':permalink',$permalink, PDO::PARAM_STR);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
   $data = 'error';
   return $data;
}else{
  foreach ($results as $key){
     return $key['idusuario'];
  }
 }
}



function saulanger($lang){
    if ($lang == 1){
      include 'sau-includes/langs/spanish.lang.php';
    }elseif ($lang == 2){
      include 'sau-includes/langs/english.lang.php';
    }
}

function getprofileimg($iduser){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "SELECT * FROM usuarios WHERE idusuario = :idusuario";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idusuario',$iduser, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
}else{
  foreach ($results as $key){
   if($key['profile'] == 1){
     echo'<img class="profile-image" src="sau-content/images/profile-normal.png">';
   }else{
     echo'<img class="profile-image" src="'.$key['profile'].'">';
   }
  }
 }
}


function isadmin($ranker){
if ($ranker == 1) {
   }else{
    echo '<li><a href="sau-admin"><i class="fa fa-user-secret"></i> '.SAULANGA.'</a></li>';
   }
}

function thename($iduser){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "SELECT * FROM usuarios WHERE idusuario = :idusuario";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idusuario',$iduser, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
	
}else{
	foreach ($results as $key){
		echo $key['nombre'].' '.$key['apellido'];
	}
 }
}


function checklike($post,$user){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

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


function fechastring($fecha){
$fechatitle = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($fecha)));
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array(" ","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$year = substr($fecha,0,4);
$month = substr($fecha, 5, 2);
$day = substr($fecha, 8, 2);
$time = date('h:i A',strtotime(substr($fecha, 11,8)));
$complete = '<p title="'.$fechatitle.'"><i class="glyphicon glyphicon-time"></i> '.$dias[$day]." ".$day." de ".$meses[(int)$month]. " del ".$year.'</p>';
return $complete;
}


function getmyposts($iduser){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "SELECT usuarios.permalink,publicaciones.idpublicacion,publicaciones.publicacion,publicaciones.fecha,publicaciones.usuario AS usuariopost, usuarios.nombre AS nombre,usuarios.apellido AS apellido,usuarios.profile AS picture, publicaciones.fecha FROM publicaciones INNER JOIN usuarios ON publicaciones.usuario = usuarios.idusuario WHERE publicaciones.usuario = :usuario ORDER BY publicaciones.idpublicacion DESC LIMIT 6";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':usuario',$iduser, PDO::PARAM_INT);
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
    	<a data-comment="'.$key['idpublicacion'].'" class="commentthis"><i class="fa fa-comment-o"></i> '.SAULANG11.'</a>
    	'.getthelikes($key['idpublicacion']).'
    </div>
    <div id="comment-'.$key['idpublicacion'].'" class="col-sm-12 comments-box">
      <div id="commenterror'.$key['idpublicacion'].'"></div>
      <div class="input-group">
        <form id="commentfrm'.$key['idpublicacion'].'">
          <input type="text" name="commentstext" class="form-control" placeholder="Comentarios...">
        </form>
        <span class="input-group-btn">
          <button data-comment="'.$key['idpublicacion'].'" class="btncommentpost btn btn-default" type="button"><i class="fa fa-comment-o"></i> '.SAULANG11.'</button>
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
}



function comments($post){

// conexion de base de datos
$conexion = Conexion::singleton_conexion();

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


function getthelikes($post){
  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM likepost WHERE post = :post';
  $stn = $conexion -> prepare($SQL);
  $stn -> bindParam(':post', $post, PDO::PARAM_INT);
  $stn -> execute();   
  $counter = $stn -> rowCount();
  $data = '<a id="like-count-'.$post.'"class="pull-right">'.$counter.' Me gusta</a>';
  return $data;	
}


function checkmycontact($usuario,$sausession){
  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM contacts WHERE contact = :contact AND fromcontact = :fromcontact';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':contact', $usuario, PDO::PARAM_STR);
  $sentence -> bindParam(':fromcontact', $sausession, PDO::PARAM_STR);
  $sentence -> execute();
  $resultado = $sentence -> fetchAll();
  if(empty($resultado)){
      echo'
        <button data-contact="'.$usuario.'" class="addcontact btn btn-default btn-sm"><i class="fa fa-user-plus"></i> '.SAULANG23.'</button>
        <button data-contact="'.$usuario.'" class="delcontact hidebtncontact btn btn-danger btn-sm"><i class="fa fa-user-times"></i> '.SAULANG24.'</button>
      ';
  }else{
    foreach($resultado as $key){
      echo'
        <button data-contact="'.$usuario.'" class="addcontact hidebtncontact btn btn-default btn-sm"><i class="fa fa-user-plus"></i> '.SAULANG23.'</button>
        <button data-contact="'.$usuario.'" class="delcontact btn btn-danger btn-sm"><i class="fa fa-user-times"></i> '.SAULANG24.'</button>
      ';
    }
  }
}



function mycontacs($iduser){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT usuarios.profile AS profile, usuarios.nombre AS nombre, usuarios.apellido AS apellido, usuarios.permalink FROM contacts INNER JOIN usuarios ON usuarios.idusuario = contacts.contact WHERE contacts.fromcontact = :contact ORDER BY contacts.idcontacts DESC LIMIT 16';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':contact', $iduser, PDO::PARAM_STR);
  $sentence -> execute();
  $resultado = $sentence -> fetchAll();
  if(empty($resultado)){
     echo '<div class="col-sm-12 text-center nocontacts"><i class="fa fa-user-times"></i> '.SAULANG26.'</div>';
  }else{
    foreach($resultado as $key){
       
       if($key['profile'] == 1){
         $profile = '<img src="sau-content/images/profile-small.png">';
       }else{
         $profileparse = str_replace('normal-', 'small-', $key['profile']);
         $profile = '<img src="'.$profileparse.'">';
       }

      echo'
      <div class="col-sm-3">
        <a href="profile!'.$key['permalink'].'" data-toggle="tooltip" data-placement="bottom" title="'.$key['nombre'].' '.$key['apellido'].'">
          '.$profile.'
        </a>
      </div>
      ';

    }

      if ($iduser == $_SESSION['idusuario']){ 
        echo'
          <div class="col-sm-12">
              <p></p>
              <a href="mycontacts" class="btn btn-warning btn-xs pull-right"><i class="fa fa-users"></i> '.SAULANG70.'</a>
          </div>
        ';
      }

  }

}
#---------------------------------------------------------------------------------------------
function follow($iduser){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT usuarios.profile AS profile, usuarios.nombre AS nombre, usuarios.apellido AS apellido, usuarios.permalink FROM contacts INNER JOIN usuarios ON usuarios.idusuario = contacts.contact WHERE contacts.fromcontact = :contact ORDER BY contacts.idcontacts DESC LIMIT 16';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':contact', $iduser, PDO::PARAM_STR);
  $sentence -> execute();
  $resultado = $sentence -> fetchAll();
  if(empty($resultado)){
     echo '<div class="col-sm-12 text-center nocontacts"><i class="fa fa-user-times"></i> '.SAULANG26.'</div>';
  }else{
    foreach($resultado as $key){
       
       if($key['profile'] == 1){
         $profile = '<img src="sau-content/images/profile-small.png">';
       }else{
         $profileparse = str_replace('normal-', 'small-', $key['profile']);
         $profile = '<img src="'.$profileparse.'">';
       }

      echo'
      <div class="col-sm-2 text-center">
        <a href="profile!'.$key['permalink'].'" >
          '.$profile.'
          <p>'.$key['nombre'].' '.$key['apellido'].'</p>
        </a>
      </div>
      ';

    }

  }

}



function followers($iduser){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT usuarios.profile AS profile, usuarios.nombre AS nombre, usuarios.apellido AS apellido, usuarios.permalink FROM contacts INNER JOIN usuarios ON usuarios.idusuario = contacts.fromcontact WHERE contacts.contact = :contact ORDER BY contacts.idcontacts DESC LIMIT 16';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':contact', $iduser, PDO::PARAM_STR);
  $sentence -> execute();
  $resultado = $sentence -> fetchAll();
  if(empty($resultado)){
     echo '<div class="col-sm-12 text-center nocontacts"><i class="fa fa-user-times"></i> '.SAULANG26.'</div>';
  }else{
    foreach($resultado as $key){
       
       if($key['profile'] == 1){
         $profile = '<img src="sau-content/images/profile-small.png">';
       }else{
         $profileparse = str_replace('normal-', 'small-', $key['profile']);
         $profile = '<img src="'.$profileparse.'">';
       }

      echo'
      <div class="col-sm-2 text-center">
        <a href="profile!'.$key['permalink'].'" >
          '.$profile.'
          <p>'.$key['nombre'].' '.$key['apellido'].'</p>
        </a>
      </div>
      ';

    }

  }

}

#---------------------------------------------------------------------------------------------
function messagesnoread(){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM messages WHERE para = :para AND leido = 1';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':para',$_SESSION['idusuario'], PDO::PARAM_INT);
  $sentence -> execute();
  $counter = $sentence -> rowCount();

  if ($counter == 0){
  }else{
    echo '<span class="messagesnoread animated tada infinite">'.$counter.'</span>';
  }

}


function messagelistli(){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT usuarios.nombre AS nombre, usuarios.apellido as apellido, usuarios.profile, messages.mensaje, messages.fecha, messages.leido FROM messages INNER JOIN usuarios ON usuarios.idusuario = messages.de WHERE messages.para = :para ORDER BY messages.idmessage DESC LIMIT 5';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':para',$_SESSION['idusuario'], PDO::PARAM_INT);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if(empty($resultados)){
    echo '<li class="text-center"><a href="messages">'.SAULANG31.'</a></li>';
  }else{
      foreach ($resultados as $key){
         
       if($key['profile'] == 1){
         $profile = '<img class="messageprofileradius" src="sau-content/images/profile-small.png">';
       }else{
         $profileparse = str_replace('normal-', 'small-', $key['profile']);
         $profile = '<img class="messageprofileradius" src="'.$profileparse.'">';
       }

       $mensaje = substr($key['mensaje'], 0,50);
       $fecha = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($key['fecha'])));
       if ($key['leido'] == 1) {
         $leido = 'animated flash infinite';
       }else{
         $leido = '';
       }


        echo'
        <li>
          <a href="messages">
            <div class="col-sm-2 col-xs-2 nopadding text-center '.$leido.'">'.$profile.'</div>
            <div class="col-sm-10 col-xs-10"><p>'.$mensaje.'</p><p class="ptimemessage">'.$fecha.'</p></div>
          </a>
        </li>';

      }
      echo '<li class="text-center"><a href="messages">'.SAULANG31.'</a></li>';
  }


}


function messagestable(){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();  
  $SQL = 'SELECT messages.leido,messages.idmessage,usuarios.permalink,usuarios.nombre,usuarios.apellido,messages.asunto,messages.fecha AS fecha FROM messages INNER JOIN usuarios ON usuarios.idusuario = messages.de WHERE messages.para = :para';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':para',$_SESSION['idusuario'], PDO::PARAM_INT);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if(empty($resultados)){
    # code...
  }else{
    foreach($resultados as $key){

      $fecha = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($key['fecha'])));
      $messagehash = base64_encode(date('Y-m-d').$key['idmessage']);
      if ($key['leido'] == 1) {
        $yavi = '<span id="new-message-'.$key['idmessage'].'" class="new-message animated flash infinite">'.SAULANG34.'</span>';
      }else{
        $yavi = '';
      }

      echo'
       <tr id="'.$messagehash.'">
         <td>
           <a class="message-usuario" target="_blank" href="profile!'.$key['permalink'].'">
             <i class="fa fa-angle-double-right"></i> '.$key['nombre'].' '.$key['apellido'].'
           </a>
           '.$yavi.'
         </td>
         <td><a data-message="'.$messagehash.'" class="messageview">'.$key['asunto'].'</a></td>
         <td><p class="message-fecha">'.$fecha.'</p></td>
         <td>
           <button data-message="'.$messagehash.'" class="deletemessage btn btn-xs btn-danger"><i class="fa fa-times"></i> '.SAULANG13.'</button>
         </td>
       </tr>
      ';


    }
  }

}


function getmypreferences(){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "SELECT * FROM preferiences WHERE usuario = :usuario LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':usuario',$_SESSION['idusuario'], PDO::PARAM_STR);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {


echo'
     <form id="changepref">
      <label>'.SAULANG35.'</label>
      <select class="form-control" name="theme">
        <option value="1">SAU Default</option>
        <option value="2">SAU Blue</option>
        <option value="3">SAU Black</option>
        <option value="4">SAU Gray</option>
        <option value="5">SAU Red</option>
      </select>
      <label>'.SAULANG36.'</label>
      <select class="form-control" name="lang">
        <option value="1">'.SAULANG37.'</option>
        <option value="2">'.SAULANG38.'</option>
      </select>
      </form>
      <p></p>
      <button class="saveprefe btn btn-block btn-default"><i class="fa fa-floppy-o"></i> '.SAULANG39.'</button>
';


}else{
  foreach ($results as $key){

    if($key['theme'] == 1){

     $theme = '<option value="1">SAU Default</option>
     <option value="2">SAU Blue</option>
     <option value="3">SAU Black</option>
     <option value="4">SAU Gray</option>
     <option value="5">SAU Red</option>';

    }elseif ($key['theme'] == 2){

      $theme = '<option value="2">SAU Blue</option>
      <option value="1">SAU Default</option>
     <option value="3">SAU Black</option>
     <option value="4">SAU Gray</option>
     <option value="5">SAU Red</option>';

    }elseif ($key['theme'] ==3){

      $theme = '<option value="3">SAU Black</option>
      <option value="2">SAU Blue</option>
      <option value="1">SAU Default</option>
     <option value="4">SAU Gray</option>
     <option value="5">SAU Red</option>';

    }elseif ($key['theme'] == 4){

      $theme = '<option value="4">SAU Gray</option>
      <option value="3">SAU Black</option>
      <option value="2">SAU Blue</option>
      <option value="1">SAU Default</option>
     <option value="5">SAU Red</option>';  

    }elseif ($key['theme'] == 5){
      $theme = '<option value="5">SAU Red</option>
      <option value="4">SAU Gray</option>
      <option value="3">SAU Black</option>
      <option value="2">SAU Blue</option>
      <option value="1">SAU Default</option>';  
    }

    if($key['lang'] == 1){
      $lang = '
     <option value="1">'.SAULANG37.'</option>
     <option value="2">'.SAULANG38.'</option>
      ';
    }else{
      $lang = '
     <option value="2">'.SAULANG38.'</option>
     <option value="1">'.SAULANG37.'</option>
      ';
    }

    echo'
   <form id="changepref">
      <label>'.SAULANG35.'</label>
      <select class="form-control" name="theme">
       '.$theme.'
      </select>
      <label>'.SAULANG36.'</label>
      <select class="form-control" name="lang">
        '.$lang.'
      </select>
      </form>
      <p></p>
      <button class="saveprefe btn btn-block btn-default"><i class="fa fa-floppy-o"></i> '.SAULANG39.'</button>     
    ';
  }
 }
}


function getmypreferences2(){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = 'SELECT * FROM usuarios WHERE idusuario = :idusuario';
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idusuario', $_SESSION['idusuario'], PDO::PARAM_INT);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
if (empty($resultados)) {
  # code...
}else{
  foreach($resultados as $key){
     
    $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['registro'])));

    echo'
   <form id="personaldates">
      <label>'.SAULANG46.'</label>
      <input class="form-control" type="text" name="nombre" value="'.$key['nombre'].'" > 
      <label>'.SAULANG47.'</label>
      <input class="form-control" type="text" name="apellidos" value="'.$key['apellido'].'" > 
      <label>'.SAULANG48.'</label>
      <input class="form-control" type="text" value="'.$fecha.'" disabled>
      <p></p>
   </form>
      <button class="saveprefdata1 btn btn-block btn-warning"><i class="fa fa-floppy-o"></i> '.SAULANG39.'</button>
    ';
    }
  }
}


function changeemail(){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = 'SELECT email FROM usuarios WHERE idusuario = :idusuario';
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idusuario', $_SESSION['idusuario'], PDO::PARAM_INT);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
 if (empty($resultados)) {
  # code...
 }else{
   foreach($resultados as $key){
     echo '<label class="actualmail" ><i class="fa fa-envelope-o"></i> '.SAULANG52.' '.$key['email'].'</label>';
   }
 }  
}


function changepermalink(){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = 'SELECT permalink FROM usuarios WHERE idusuario = :idusuario';
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idusuario', $_SESSION['idusuario'], PDO::PARAM_INT);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
 if (empty($resultados)) {
  # code...
 }else{
   foreach($resultados as $key){
     echo '<label class="actualperma" ><i class="fa fa-envelope-o"></i> '.SAULANG54.' '.$key['permalink'].'</label>';
   }
 }  
}


function congifurationmail(){
   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM config WHERE idconfig = 1';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
   }else{
      foreach ($resultados as $key){
        $data = $key['smtp'].'|'.$key['port'].'|'.$key['fromname'].'|'.$key['mail'].'|'.$key['password'].'|'.$key['url'].'|'.$key['messagemail'];
        return $data;
      }
   }
}



function register($nombre,$apellido,$email,$password){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $regname = strip_tags($nombre);
  $regapellido = strip_tags($apellido);
  $regemail = strip_tags($email);
  $regcrypt = sha1(SALT.$password.PEPER);
  $noactive = 1;
  $regdate = date('Y-m-d');
  $permalink = substr(sha1($email.$regdate), 0,10);

  $Check = 'SELECT * FROM usuarios WHERE email = :email';
  $checksente = $conexion -> prepare($Check);
  $checksente -> bindParam(':email',$regemail,PDO::PARAM_STR);
  $checksente -> execute();
  $resultcheck = $checksente -> fetchAll();
  if(empty($resultcheck)){
  #------------------------------------------------------------
  // Registro de nuevo usuario
  $SQLReg = 'INSERT INTO usuarios (nombre, apellido, profile, email, password, registro, permalink, activo, ranker) VALUES (:nombre, :apellido, :profile, :email, :password, :registro, :permalink, :activo, :ranker)';
  $sentence = $conexion -> prepare($SQLReg);
  $sentence -> bindParam(':nombre',$regname,PDO::PARAM_STR);
  $sentence -> bindParam(':apellido',$regapellido,PDO::PARAM_STR);
  $sentence -> bindParam(':profile',$noactive,PDO::PARAM_STR);
  $sentence -> bindParam(':email',$regemail,PDO::PARAM_STR);
  $sentence -> bindParam(':password',$regcrypt,PDO::PARAM_STR);
  $sentence -> bindParam(':registro',$regdate,PDO::PARAM_STR);
  $sentence -> bindParam(':permalink',$permalink,PDO::PARAM_STR);
  $sentence -> bindParam(':activo',$noactive,PDO::PARAM_INT);
  $sentence -> bindParam(':ranker',$noactive,PDO::PARAM_INT);
  $sentence -> execute();

  // Insertar para Verificar
  $mailtoken = sha1($email.TOKENMAIL);
  $ver = 'INSERT INTO verify (token,email,fecha) VALUES (:token,:email,:fecha)';
  $versentence = $conexion -> prepare($ver);
  $versentence -> bindParam(':token',$mailtoken,PDO::PARAM_STR);
  $versentence -> bindParam(':email',$regemail,PDO::PARAM_STR);
  $versentence -> bindParam(':fecha',$regdate,PDO::PARAM_STR);
  $versentence -> execute();

  
  $dataexplode = congifurationmail();
  $parsedata = explode("|", $dataexplode);

  $htmlhead = '<!DOCTYPE html><html><body>';
  $htmlfooter = '</body></html>';
  $messageone = '<p>'.$parsedata[6].'</p></p><p></p>';
  $activationlink = '<p><label>'.SAULANG69.'</label><p></p><a href="'.$parsedata[5].'sauactive?token='.$mailtoken.'&email='.$regemail.'">'.$parsedata[5].'activate?token='.$mailtoken.'&email='.$regemail.'</a></p>';


  // Envio de Correo 
  $mail = new PHPMailer;
  $mail->isSMTP();                                      
  $mail->Host = $parsedata[0];   // especiificar el servidor smtp
  $mail->SMTPAuth = true;                           
  $mail->Username = $parsedata[3];   // correo desde el que se enviara
  $mail->Password = $parsedata[4];  // password del correo
  $mail->Port = $parsedata[1];     // el puerto por defecto para SMTP es 587 pero puede ser otro
  $mail->setFrom($parsedata[3], $parsedata[2]);  // remitente, el segundo paramtero es el nombre
  $mail->addAddress($regemail);   // destino
  $mail->isHTML(true);    
  $mail->Subject = SAULANG68.' - '.SITETITLE;   // Asunto
  $mail->Body    = $htmlhead.$messageone.$activationlink.$htmlfooter;
  $mail->send(); 


  #------------------------------------------------------------
  }else{
  #------------------------------------------------------------
    return 1;
  #------------------------------------------------------------  
  }

}


function finder($var,$page){
#---------------------------------------------------------------------------------------
  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  // Cuantos resultados con esta bisqueda
  $SQLCounter = 'SELECT * FROM usuarios WHERE nombre LIKE "%'.$var.'%"';
  $sentencecount = $conexion -> prepare($SQLCounter);
  $sentencecount -> execute();
  $cuantos = $sentencecount -> rowCount();

  // Tamaño de pagina
  $resultados = 48;
  // total parginado
  $totalpaginas = ceil($cuantos / $resultados);
  // articulo inicial
  $articuloInicial = ($page - 1) * $resultados;


  if ($page == 1) {
    $SQL = 'SELECT * FROM usuarios WHERE nombre LIKE  "%'.$var.'%" LIMIT 48';
    $paginaActual = 1;
  }else{
    $SQL = 'SELECT * FROM usuarios WHERE nombre LIKE  "%'.$var.'%" LIMIT '.$articuloInicial.', '.$resultados.'';
    $paginaActual = $page;
  }

  // Le damos la consulta
  $sentence = $conexion -> prepare($SQL);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if (empty($resultados)){
    echo '<h4><i class="fa fa-th-list"></i> '.SAULANG64.'</h4>';
  }else{
    foreach ($resultados as $key){
      
       if ($key['profile'] == 1){
           $imagen = '<img class="borderimgsearch" src="sau-content/images/profile-small.png">';
       }else{
           $finalprofile = str_replace('normal-', 'small-', $key['profile']);
           $imagen = '<img class="borderimgsearch" src="'.$finalprofile.'">';
       }

       echo'
         <div class="col-sm-2 col-xs-2 text-center">
            '.$imagen.'
            <p><strong><a class="link" href="profile!'.$key['permalink'].'">'.$key['nombre'].'</a></strong></p>
         </div>
       ';
    }
  }
   
echo'
<div class="parselinks col-sm-12 text-right">
<p></p>
';
// mostramos la paginación
for ($i=1; $i <= $totalpaginas; $i++) { 

    // para identificar la página actual, le agregamos una clase
    // para darle un estilo diferente 
    if($i == $paginaActual){
        echo '<a class="btn btn-info btn-sm active">' . $i . '</a>';
    }
    // sólo vamos a mostrar los enlaces de la primer página,
    // las dos siguientes, las dos anteriores
    // y la última
    else if($i == 1){
         echo '<a class="btn btn-info btn-sm" href="search?find='.$var.'"><i class="glyphicon glyphicon-chevron-left"></i><i class="glyphicon glyphicon-chevron-left"></i> </a>';
     }elseif ($i == $totalpaginas) {
       echo '<a class="btn btn-info btn-sm" rel="nofollow" href="search?find='.$var.'&page='.$i.'"><i class="glyphicon glyphicon-chevron-right"></i><i class="glyphicon glyphicon-chevron-right"></i> </a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 2) {
       echo '<a class="btn btn-info btn-sm" rel="nofollow" href="search?find='.$var.'&page='.$i.'"> ' . $i . '</a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 3) {
       echo '<a class="btn btn-info btn-sm" rel="nofollow" href="search?find='.$var.'&page='.$i.'"> ' . $i . '</a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 4) {
       echo '<a class="btn btn-info btn-sm" rel="nofollow" href="search?find='.$var.'&page='.$i.'"> ' . $i . '</a>';
     }elseif ($i == $paginaActual - 1 ){
       echo '<a class="btn btn-info btn-sm" rel="nofollow" href="search?find='.$var.'&page='.$i.'"><i class="glyphicon glyphicon-chevron-left"></i></a>';
     }elseif ($i == $paginaActual + 5 ){
       echo '<a class="btn btn-info btn-sm" rel="nofollow" href="search?find='.$var.'&page='.$i.'"><i class="glyphicon glyphicon-chevron-right"></i></a>';
     }
}

echo'
</div>
';
#---------------------------------------------------------------------------------------
}


function generateRandomString($length = 6) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function congifurationmailrecover(){
   // conexion de base de datos
   $conexion = Conexion::singleton_conexion();

   $SQL = 'SELECT * FROM config WHERE idconfig = 1';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
   }else{
      foreach ($resultados as $key){
        $data = $key['smtp'].'|'.$key['port'].'|'.$key['fromname'].'|'.$key['mail'].'|'.$key['password'].'|'.$key['url'].'|'.$key['renewmessage'];
        return $data;
      }
   }
}





function recoverypass($email){

  // Strip Email
  $stripemail = strip_tags($email);

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM usuarios WHERE email = :email LIMIT 1';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':email',$stripemail, PDO::PARAM_STR);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if (empty($resultados)){
   
    return 1;

  }else{

    // Generamos Password y lo ciframos    
    $passgenerated = generateRandomString();
    $newpass = sha1(SALT.$passgenerated.PEPER);
    
    $NewPassSQL = 'UPDATE usuarios SET password = :password WHERE email = :email';
    $stnpass = $conexion -> prepare($NewPassSQL);
    $stnpass -> bindParam(':password', $newpass , PDO::PARAM_STR);
    $stnpass -> bindParam(':email', $stripemail, PDO::PARAM_STR);
    $stnpass -> execute();

    $dataexplode = congifurationmailrecover();
    $parsedata = explode("|", $dataexplode);

    $htmlhead = '<!DOCTYPE html><html><body>';
    $htmlfooter = '</body></html>';
    $messageone = '<p>'.$parsedata[6].'</p></p><p></p>';
    $activationlink = '<p><label>'.SAULANG76.' <strong>'.$passgenerated.'</strong></label></p>';

    // Envio de Correo 
    $mail = new PHPMailer;
    $mail->isSMTP();                                      
    $mail->Host = $parsedata[0]; // especiificar el servidor smtp
    $mail->SMTPAuth = true;                           
    $mail->Username = $parsedata[3]; // correo desde el que se enviara
    $mail->Password = $parsedata[4]; // password del correo
    $mail->Port = $parsedata[1];     // el puerto por defecto para SMTP es 587 pero puede ser otro
    $mail->setFrom($parsedata[3], $parsedata[2]);  // remitente, el segundo paramtero es el nombre
    $mail->addAddress($stripemail);   // destino
    $mail->isHTML(true);    
    $mail->Subject = SAULANG75.' - '.SITETITLE;   // Asunto
    $mail->Body = $htmlhead.$messageone.$activationlink.$htmlfooter;
    $mail->send(); 

  }
}


function getidusuario($email){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':email',$email, PDO::PARAM_STR);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
}else{
  foreach ($results as $key){
     return $key['idusuario'];
  }
 }
}



function checkactive($token,$email){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT * FROM verify WHERE token = :token AND email = :email';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> bindParam(':token', $token, PDO::PARAM_STR);
  $sentence -> bindParam(':email', $email, PDO::PARAM_STR);
  $sentence -> execute();
  $resultados = $sentence -> fetchAll();
  if(empty($resultados)){
    # code...
  }else{

    foreach($resultados as $key){

        // Tomamos el ID del usuario
        $idusuario = getidusuario($email);
        
        // Activamos la cuenta
        $SQLver = 'UPDATE usuarios SET activo = 2 WHERE idusuario = :idusuario';
        $stnver = $conexion -> prepare($SQLver);
        $stnver -> bindParam(':idusuario', $idusuario, PDO::PARAM_STR);
        $stnver -> execute();

        // Borrar registro de verificacion
        $Del = 'DELETE FROM verify WHERE idactive = :idactive';
        $delstn = $conexion -> prepare($Del);
        $delstn -> bindParam(':idactive', $key['idactive'], PDO::PARAM_INT);
        $delstn -> execute();

    }

  }

}