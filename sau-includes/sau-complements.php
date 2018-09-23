<?php


function fechastring($fecha){
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array(" ","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$year = substr($fecha,0,4);
$month = substr($fecha, 5, 2);
$day = substr($fecha, 8, 2);
$complete = ''.$dias[$day].' '.$day.' de '.$meses[(int)$month].' del '.$year;
return $complete;
}

function gethename($iduser,$conexion){
$SQL = "SELECT * FROM usuarios WHERE idusuario = :idusuario LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idusuario',$iduser, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
	
}else{
	foreach ($results as $key){
		$data = $key['nombre'].' '.$key['apellido']; 
		return $data;
	}
  }	
}

function getpicture($iduser,$conexion){
$SQL = "SELECT * FROM usuarios WHERE idusuario = :idusuario LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idusuario',$iduser, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
  
}else{
  foreach ($results as $key){
    $data = $key['profile'];
    return $data;
  }
 }  
}


function getuserpost($idpost,$conexion){
$SQL = "SELECT * FROM publicaciones WHERE idpublicacion = :idpublicacion LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idpublicacion',$idpost, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
  
}else{
  foreach ($results as $key){
    $data = $key['usuario'];
    return $data;
  }
 } 	
}

function getpostcomment($idcomment,$conexion){
$SQL = "SELECT * FROM comentarios WHERE idcomentario = :idcomentario LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idcomentario',$idcomment, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
  
}else{
  foreach ($results as $key){
    $data = $key['usuario'];
    return $data;
  }
 }  
}


function getpostpermalink($idusuario,$conexion){
$SQL = "SELECT * FROM usuarios WHERE idusuario = :idusuario LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':idusuario',$idusuario, PDO::PARAM_INT);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
  
}else{
  foreach ($results as $key){
    $data = $key['permalink'];
    return $data;
  }
 }  
}


function getpreference($iduser,$conexion){
$SQL = "SELECT * FROM preferiences WHERE usuario = :usuario LIMIT 1";
$sentence = $conexion -> prepare($SQL);
$sentence -> bindParam(':usuario',$iduser, PDO::PARAM_STR);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
    // Idioma por defecto
    saulanger(SAULANGDEF);
}else{
  foreach ($results as $key){
    // Idioma por usuario
    saulanger($key['lang']);
  }
 }
}



function saulanger($lang){
    if ($lang == 1){
      include 'langs/spanish.lang.php';
    }elseif ($lang == 2){
      include 'langs/english.lang.php';
    }
}


function congifurationmail($conexion){
   $SQL = 'SELECT * FROM config WHERE idconfig = 1';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> execute();
   $resultados = $sentence -> fetchAll();
   if(empty($resultados)){
   }else{
      foreach ($resultados as $key){
        $data = $key['smtp'].'|'.$key['port'].'|'.$key['fromname'].'|'.$key['mail'].'|'.$key['password'].'|'.$key['url'].'|'.$key['messagechange'];
        return $data;
      }
   }
}