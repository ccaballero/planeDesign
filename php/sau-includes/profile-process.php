<?php
require_once '../sau-config.php';
require_once 'sau-complements.php';
error_reporting(E_ALL ^ E_NOTICE);
session_start();


$process = $_POST['process'];

if ($process == 1) {
///////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once "resize.php";

function processfile($archive,$profile){
/////////////////////////////////////////////////////////////////////////////////////////////////////////

    try {
      $conexion = new PDO('mysql:host='.HOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
    }
    catch (PDOException $ex) {
      exit;
    }

    // Comprobamos si ya existe una foto de perfil
    $sql = $conexion->prepare('SELECT * FROM usuarios WHERE idusuario = :idusuario');
    $sql->execute(array('idusuario' => $profile));
    $resultado = $sql->fetchAll();
    if (empty($resultado)) {
       // En caso de no existir continua el script
    }else{
      foreach ($resultado as $row) {

       if ($row["profile"] == 1) {
       }else{
         // En caso de Existir borramos el archivo
         $twoimg = str_replace('normal-', 'small-', $row["profile"]);
         unlink('../'.$row["profile"]);
         unlink('../'.$twoimg);
       }

     }
    }


    //comprobamos si el archivo ha subido y lo movemos a una ruta temporal
    if ($archive && move_uploaded_file($_FILES['imageprofile']['tmp_name'],"../sau-content/images/members/".$archive)){

      
    }  
    
    // Creamos ruta del temporal
    $temporal = '../sau-content/images/members/'.$archive;
    
    // Creamos un alfanumerico aleatorio.
     $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
     $string = '';
     for ($i = 0; $i < 25; $i++) {
      $string .= $characters[rand(0, strlen($characters) - 1)];
     }

     // Creamos una fecha para combinar con el string
     $date = date("Y-m-d");

    // Asignamos una ruta para el proceso de imagen 
    $ruta = '../sau-content/images/members/'.$string.$date.'.jpg';
    $rutasmall = '../sau-content/images/members/small-'.$string.$date.'.jpg';
    $small = '../sau-content/images/members/normal-'.$string.$date.'.jpg';

    // Asignamos una ruta para la base de datos
    $finalruta = 'sau-content/images/members/normal-'.$string.$date.'.jpg';

    // Procesamos archivo para redimensionar
    smart_resize_image($temporal, null, 200, 200, false , $ruta, true , false ,100);

    // Cópiamos imagen
    copy($ruta, $small);

    smart_resize_image($ruta, null, 50, 50, false , $rutasmall, true , false ,100);

    // Vaciamos todo a nuestra base de datos
    $sql = "UPDATE usuarios SET profile = :profile WHERE idusuario = :idusuario";
    $stmt = $conexion->prepare($sql);                                  
    $stmt->bindParam(':profile', $finalruta, PDO::PARAM_STR);       
    $stmt->bindParam(':idusuario', $_SESSION['idusuario'], PDO::PARAM_INT);   
    $stmt->execute(); 

    echo $finalruta;
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////
}


//comprobamos que sea una petición ajax
//if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    //comprobamos si existe un directorio para subir el archivo
    //si no es así, lo creamos
    if(!is_dir("../sau-content/images/members/")) 
        mkdir("../sau-content/images/members/", 0777);


    //comprobamos si existe un directorio para subir el archivot emporal
    //si no es así, lo creamos
    if(!is_dir("../sau-content/images/members/tmp")) 
        mkdir("../sau-content/images/members/tmp", 0777);

 
    //obtenemos el archivo a subir
    $file = $_FILES['imageprofile']['name'];

    // Obtenemos la extension
    $fileext = new SplFileInfo($file);
    $getextension = $fileext->getExtension();
  //var_dump($fileext);

    // convertimos extension a minusculas
    $extension = strtolower($getextension);

    // Verificamos si el archivo que se sube es valido
    if (strcmp($extension, 'jpg') == 0){
        processfile($file,$_SESSION['idusuario']);
        return;
    }else if (strcmp($extension, 'jpeg') == 0){
        processfile($file,$_SESSION['idusuario']);
        return;
    }else if (strcmp($extension, 'png') == 0){
        processfile($file,$_SESSION['idusuario']);
        return;
    }else if (strcmp($extension, 'gif') == 0){
        processfile($file,$_SESSION['idusuario']);
        return;
    }else{
       echo 1;
    }

/////////////////////////////////////////////////////////////////////////////////////////////////////////// 



}elseif ($process == 2) {
    # code...
}elseif ($process == 3) {
    # code...
}elseif ($process == 4) {
    # code...
}











