<?php
require_once 'phpmailer/PHPMailerAutoload.php'; 
require_once '../sau-includes/resize.php';
require_once '../sau-config.php';

error_reporting(E_ALL ^ E_NOTICE);
session_start();


class Conexion
{
    private static $instancia;
    private $dbh;
 
    private function __construct()
    {
        try {

            $this->dbh = new PDO('mysql:host='.HOST.';dbname='.DBNAME, DBUSER, DBPASSWORD);
            $this->dbh->exec("SET CHARACTER SET utf8");

        } catch (PDOException $e) {

            print "Error!: " . $e->getMessage();

            die();
        }
    }

    public function prepare($sql)
    {

        return $this->dbh->prepare($sql);

    }
 
    public static function singleton_conexion()
    {

        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;

        }

        return self::$instancia;
        
    }


     // Evita que el objeto se pueda clonar
    public function __clone()
    {

        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);

    }
}



function checkranker(){
  if (isset($_SESSION['ranker'])) {
      if ($_SESSION['ranker'] == 2){
      }else{
        exit;
      }
  }else{
    exit;
  }
}


function seisultimosactivos(){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = 'SELECT * FROM usuarios WHERE activo = 2 ORDER BY idusuario DESC LIMIT 6';
$sentence = $conexion -> prepare($SQL);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
if (empty($resultados)){
}else{
  foreach ($resultados as $key){
    $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['registro'])));
    echo'
      <tr>
        <td>'.$key['nombre'].'</td>
        <td>'.$fecha.'</td>
        <td>'.$key['email'].'</td>
      </tr>
    ';
  }
 }
}


function seisultimaspublicaciones(){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = 'SELECT publicaciones.publicacion, publicaciones.fecha, usuarios.nombre, usuarios.apellido FROM publicaciones INNER JOIN usuarios ON usuarios.idusuario = publicaciones.usuario ORDER BY publicaciones.idpublicacion DESC LIMIT 6';
$sentence = $conexion -> prepare($SQL);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
if (empty($resultados)){
}else{
  foreach ($resultados as $key){
    $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['fecha'])));
    echo'
      <tr>
        <td>'.$key['nombre'].' </td>
        <td>'.$fecha.'</td>
        <td>'.substr($key['publicacion'], 0,30).'...</td>
      </tr>
    ';
  }
 }
}


function seisultimoscomentarios(){
// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = 'SELECT comentarios.comentario, comentarios.fecha, usuarios.nombre, usuarios.apellido FROM comentarios INNER JOIN usuarios ON usuarios.idusuario = comentarios.usuario ORDER BY comentarios.idcomentario DESC LIMIT 6';
$sentence = $conexion -> prepare($SQL);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
if (empty($resultados)){
}else{
  foreach ($resultados as $key){
    $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['fecha'])));
    echo'
      <tr>
        <td>'.$key['nombre'].'</td>
        <td>'.$fecha.'</td>
        <td>'.substr($key['comentario'], 0,30).'...</td>
      </tr>
    ';
  }
 }
}



function mailconfig(){

// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = 'SELECT * FROM config WHERE idconfig = 1';
$sentence = $conexion -> prepare($SQL);
$sentence -> execute();
$resultados = $sentence -> fetchAll();
if (empty($resultados)){
  # code...
}else{
  foreach ($resultados as $key){

    if ($key['login'] == 1){
       $login = '<option value="'.$key['login'].'">Activo</option>';
    }else{
       $login = '<option value="'.$key['login'].'">Inactivo</option>';
    }

    if ($key['register'] == 1){
       $register = '<option value="'.$key['register'].'">Activo</option>';
    }else{
       $register = '<option value="'.$key['register'].'">Inactivo</option>';
    }

    if ($key['forgot'] == 1){
       $forgot = '<option value="'.$key['forgot'].'">Activo</option>';
    }else{
       $forgot = '<option value="'.$key['forgot'].'">Inactivo</option>';
    }    



    echo'
         <div class="col-sm-6">
           
           <label>Login:</label>
           <select class="form-control" name="login">
              <optgroup>
                '.$login.'
              </optgroup>
              <optgroup>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
              </optgroup>
           </select>
           <label>Registro:</label>
           <select class="form-control" name="register">
              <optgroup>
                '.$register.'
              </optgroup>
              <optgroup>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
              </optgroup>
           </select>
           <label>Recovery Password:</label>
           <select class="form-control" name="forgot">
              <optgroup>
                '.$forgot.'
              </optgroup>
              <optgroup>
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
              </optgroup>
           </select>
           <label>Mensaje Registro:</label>
           <textarea class="form-control" rows="3" name="messagemail">'.$key['messagemail'].'</textarea>
           <label>Mensaje Cambio de Correo:</label>
           <textarea class="form-control" rows="3" name="messagechange">'.$key['messagechange'].'</textarea>
           <label>Mensaje de Recuperacion de Correo:</label>
           <textarea class="form-control" rows="3" name="renewmessage">'.$key['renewmessage'].'</textarea>


         </div>

         <div class="col-sm-6">
           
           <label>SMTP:</label>
           <input class="form-control" type="" name="smtp" value="'.$key['smtp'].'" >
           <label>Puerto:</label>
           <input class="form-control" type="" name="port" value="'.$key['port'].'" >
           <label>Nombre:</label>
           <input class="form-control" type="" name="fromname" value="'.$key['fromname'].'" >
           <label>Mail:</label>
           <input class="form-control" type="" name="mail" value="'.$key['mail'].'" >
           <label>Contraseña:</label>
           <input class="form-control" type="" name="password" value="'.$key['password'].'" >
           <label>URL:</label>
           <input class="form-control" type="" name="url" value="'.$key['url'].'" >

         </div>


    ';
  }
}



}



function getusuariosoptionmessage(){

// conexion de base de datos
$conexion = Conexion::singleton_conexion();

$SQL = "SELECT * FROM usuarios";
$sentence = $conexion -> prepare($SQL);
$sentence ->execute();
$results = $sentence -> fetchAll();
if (empty($results)) {
}else{
  foreach ($results as $key){

      echo'<option value="'.$key['idusuario'].'">'.$key['nombre'].' '.$key['apellido'].'</option>';

  }
 }
}


function cuantosusers(){

    $conexion = Conexion::singleton_conexion();

	$SQL = 'SELECT * FROM usuarios';
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$cuantos = $sentence -> rowCount();
	echo $cuantos;
}

function cuantospublic(){
	
    $conexion = Conexion::singleton_conexion();

	$SQL = 'SELECT * FROM publicaciones';
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$cuantos = $sentence -> rowCount();
	echo $cuantos;
}


function cuantoscomment(){
	
    $conexion = Conexion::singleton_conexion();

	$SQL = 'SELECT * FROM comentarios';
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$cuantos = $sentence -> rowCount();
	echo $cuantos;
}


function cuantoscontact(){
	
    $conexion = Conexion::singleton_conexion();

	$SQL = 'SELECT * FROM contacts';
	$sentence = $conexion -> prepare($SQL);
	$sentence -> execute();
	$cuantos = $sentence -> rowCount();
	echo $cuantos;
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

function displayusers(){

  // conexion de base de datos
  $conexion = Conexion::singleton_conexion();

  $SQL = 'SELECT usuarios.profile AS profile, usuarios.nombre AS nombre, usuarios.apellido AS apellido, usuarios.permalink FROM usuarios';
  $sentence = $conexion -> prepare($SQL);
  $sentence -> execute();
  $resultado = $sentence -> fetchAll();
  if(empty($resultado)){
  }else{
    foreach($resultado as $key){
       
       if($key['profile'] == 1){
         $profile = '<img src="sau-content/images/profile-small.png">';
       }else{
         $profileparse = str_replace('normal-', 'small-', $key['profile']);
         $profile = '<img src="'.$profileparse.'">';
       }

      echo'
      <div class="col-sm-2 col-xs-6 text-center useradmcube">
        <a href="profile!'.$key['permalink'].'" >
          '.$profile.'
          <p>'.$key['nombre'].' '.$key['apellido'].'</p>
        </a>
        <button class="btn btn-block btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Editar</button>
        <button class="btn btn-block btn-xs btn-danger"><i class="fa fa-times"></i> Eliminar</button>
      </div>
      ';

    }

  }
}




function userstableadm($page){

         // conexion de la base de datos
         $conexion = Conexion::singleton_conexion();

         $RowCount = "SELECT * FROM usuarios";
         $counsentence = $conexion -> prepare($RowCount);
         $counsentence -> execute();
         $cuantos = $counsentence -> rowCount();

         // Tamaño de pagina
         $resultados = 10;
         // total parginado
         $totalpaginas = ceil($cuantos / $resultados);
         // articulo inicial
         $articuloInicial = ($page - 1) * $resultados;

         if ($page == 1) {
            $SQL = "SELECT * FROM usuarios LIMIT 10";
            $paginaActual = 1;
         }else{
            $SQL = "SELECT * FROM usuarios LIMIT ".$articuloInicial.", ".$resultados."";
            $paginaActual = $page;
         }

         $sentence = $conexion -> prepare($SQL);
         $sentence -> bindParam(':estado', $estadoid, PDO::PARAM_INT);
         $sentence -> execute();
         $results = $sentence -> fetchAll();
         if (empty($results)){
           # code...
         }else{

                 echo'
                   <table class="table table-striped">
                      <thead class="messages-table-header">
                         <tr>
                           <th><i class="fa fa-angle-double-right"></i> Perfil</th>
                           <th><i class="fa fa-angle-double-right"></i> Nombre</th>
                           <th><i class="fa fa-angle-double-right"></i> Email</th>
                           <th><i class="fa fa-angle-double-right"></i> Registro</th>
                           <th><i class="fa fa-angle-double-right"></i> Rango</th>
                           <th><i class="fa fa-angle-double-right"></i> Activo</th>
                           <th><i class="fa fa-angle-double-right"></i> Acciones</th>
                         </tr>
                      </thead>
                      <tbody>
                     ';

          foreach ($results as $key){


            $fecha = str_replace('-', '/', date("d-m-Y", strtotime($key['registro'])));
            if ($key['profile'] == 1){
              $profile = '<img class="profileimgtableadmin" src="../sau-content/images/profile-small.png" >';
            }else{
              $profile = '<img class="profileimgtableadmin" src="../'.str_replace('normal', 'small', $key['profile']).'" >';
            }

            if ($key['ranker'] == 1){
              $rango = 'Usuario';
            }else{
              $rango = 'Administrador';
            }

            if ($key['activo'] == 1){
               $activo = 'No';
            }else{
               $activo = 'Si';
            }


            echo '
              <tr id="trusuario'.$key['idusuario'].'">
                <td>
                  '.$profile.'
                </td>
                <td>'.$key['nombre'].' '.$key['apellido'].'</td>
                <td>'.$key['email'].'</td>
                <td>'.$fecha.'</td>
                <td>'.$rango.'</td>
                <td>'.$activo.'</td>
                <td>
                  <button data-id="'.$key['idusuario'].'" class="edituser btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Editar</button>
                  <button data-id="'.$key['idusuario'].'" class="deleteuser btn btn-xs btn-danger"><i class="fa fa-times"></i> Eliminar</button>
                </td>
              </tr>
            ';
          }

          echo'
            </tbody>
          </table>
          ';


         }
echo'
<p></p>
<div class="col-md-12 text-right" style="margin-top: 0px;margin-bottom: 10px;padding: 0px 5px;">
<div class="btn-group" role="group" >
';

// mostramos la paginación
for ($i=1; $i <= $totalpaginas; $i++) { 

    // para identificar la página actual, le agregamos una clase
    // para darle un estilo diferente 
    if($i == $paginaActual){
        echo '<a class="btn btn-warning active">'.$i.'</a>';
    }
    // sólo vamos a mostrar los enlaces de la primer página,
    // las dos siguientes, las dos anteriores
    // y la última
    else if($i == 1){
         echo '<a class="btn btn-warning" href="usuarios?page='.$i.'"><i class="glyphicon glyphicon-chevron-left"></i><i class="glyphicon glyphicon-chevron-left"></i> </a>';
     }elseif ($i == $totalpaginas) {
       echo '<a class="btn btn-warning" rel="nofollow" href="usuarios?page='.$i.'"><i class="glyphicon glyphicon-chevron-right"></i><i class="glyphicon glyphicon-chevron-right"></i> </a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 2) {
       echo '<a class="btn btn-warning" rel="nofollow" href="usuarios?page='.$i.'">'.$i.'</a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 3) {
       echo '<a class="btn btn-warning" rel="nofollow" href="usuarios?page='.$i.'">'.$i.'</a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 4) {
       echo '<a class="btn btn-warning" rel="nofollow" href="usuarios?page='.$i.'">'.$i.'</a>';
     }elseif ($i == $paginaActual - 1 ){
       echo '<a class="btn btn-warning" rel="nofollow" href="usuarios?page='.$i.'"><i class="glyphicon glyphicon-chevron-left"></i></a>';
     }elseif ($i == $paginaActual + 5 ){
       echo '<a class="btn btn-warning" rel="nofollow" href="usuarios?page='.$i.'"><i class="glyphicon glyphicon-chevron-right"></i></a>';
     }
}

echo'
</div>
</div>
';

}




function processfile($archive,$profile){
/////////////////////////////////////////////////////////////////////////////////////////////////////////

    // conexion de la base de datos
    $conexion = Conexion::singleton_conexion();

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
    $stmt->bindParam(':idusuario', $profile, PDO::PARAM_INT);   
    $stmt->execute(); 

    echo '../'.$finalruta;
  
/////////////////////////////////////////////////////////////////////////////////////////////////////////
}



function changeuserpassword($usuario, $pass1){

// conexion de la base de datos
$conexion = Conexion::singleton_conexion();

// Actualizar Password
$cryptupda = sha1(SALT.$pass1.PEPER);
$updatepass = 'UPDATE usuarios SET password = :password WHERE idusuario = :idusuario';
$senteceupda = $conexion -> prepare($updatepass);
$senteceupda -> bindParam(':password',$cryptupda, PDO::PARAM_STR);
$senteceupda -> bindParam(':idusuario',$usuario, PDO::PARAM_INT);
$senteceupda -> execute();


}


function commentscount($posting){

    // conexion de la base de datos
    $conexion = Conexion::singleton_conexion();

    $SQL = 'SELECT * FROM comentarios WHERE publicacion = :publicacion';
    $sentence = $conexion -> prepare($SQL);
    $sentence -> bindParam(':publicacion', $posting, PDO::PARAM_INT);
    $sentence -> execute();
    $cuantos = $sentence -> rowCount();
    return $cuantos;
}

function fechastring($fecha){
$fechatitle = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($fecha)));
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array(" ","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$year = substr($fecha,0,4);
$month = substr($fecha, 5, 2);
$day = substr($fecha, 8, 2);
$time = date('h:i A',strtotime(substr($fecha, 11,8)));
$complete = '<i class="glyphicon glyphicon-time"></i> '.$dias[$day]." ".$day." de ".$meses[(int)$month]. " del ".$year.'';
return $complete;
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

<tr id="time-comment-'.$key['idcomentario'].'">
   <td><a class="btn btn-block btn-xs btn-success" href="../profile!'.$key['permalink'].'">'.$key['nombre'].' '.$key['apellido'].'</a></td>
   <td>'.fechastring($key['fecha']).'</td>
   <td>'.utf8_decode($key['comentario']).'</td>
   <td><a data-comment="'.$key['idcomentario'].'" class="deletecomment btn btn-xs btn-danger"><i class="fa fa-times"></i> Eliminar</a></td>
</tr>

';
  }
}

}


function publishtableadm($page){

         // conexion de la base de datos
         $conexion = Conexion::singleton_conexion();

         $RowCount = "SELECT * FROM publicaciones";
         $counsentence = $conexion -> prepare($RowCount);
         $counsentence -> execute();
         $cuantos = $counsentence -> rowCount();

         // Tamaño de pagina
         $resultados = 10;
         // total parginado
         $totalpaginas = ceil($cuantos / $resultados);
         // articulo inicial
         $articuloInicial = ($page - 1) * $resultados;

         if ($page == 1) {
            $SQL = "SELECT publicaciones.idpublicacion, usuarios.nombre, usuarios.apellido, publicaciones.publicacion, publicaciones.fecha, publicaciones.usuario FROM publicaciones INNER JOIN usuarios ON usuarios.idusuario = publicaciones.usuario LIMIT 10";
            $paginaActual = 1;
         }else{
            $SQL = "SELECT publicaciones.idpublicacion, usuarios.nombre, usuarios.apellido, publicaciones.publicacion, publicaciones.fecha, publicaciones.usuario FROM publicaciones INNER JOIN usuarios ON usuarios.idusuario = publicaciones.usuario LIMIT ".$articuloInicial.", ".$resultados."";
            $paginaActual = $page;
         }

         $sentence = $conexion -> prepare($SQL);
         $sentence -> bindParam(':estado', $estadoid, PDO::PARAM_INT);
         $sentence -> execute();
         $results = $sentence -> fetchAll();
         if (empty($results)){
           # code...
         }else{

                 echo'
                   <table class="table table-striped">
                      <thead class="messages-table-header">
                         <tr>
                           <th><i class="fa fa-angle-double-right"></i> Usuario</th>
                           <th><i class="fa fa-angle-double-right"></i> Publicacion</th>
                           <th><i class="fa fa-angle-double-right"></i> Fecha</th>
                           <th><i class="fa fa-angle-double-right"></i> Acciones</th>
                         </tr>
                      </thead>
                      <tbody>
                     ';

          foreach ($results as $key){

            $comments = commentscount($key['idpublicacion']);
            $fecha = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($key['fecha'])));

            echo '
              <tr id="trpublicacion'.$key['idpublicacion'].'">
                <td>'.$key['nombre'].' '.$key['apellido'].'</td>
                <td>'.substr($key['publicacion'], 0,100).'</td>
                <td>'.$fecha.'</td>
                <td>
                  <button data-id="'.$key['idpublicacion'].'" class="vercomentarios btn btn-block btn-warning btn-xs">'.$comments.' Comentarios</button>
                  <button data-id="'.$key['idpublicacion'].'" class="editpublicacion btn btn-block btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Editar</button>
                  <button data-id="'.$key['idpublicacion'].'" class="deleteaplicacion btn btn-block btn-xs btn-danger"><i class="fa fa-times"></i> Eliminar</button>
                </td>
              </tr>
            ';
          }

          echo'
            </tbody>
          </table>
          ';


         }
echo'
<p></p>
<div class="col-md-12 text-right" style="margin-top: 0px;margin-bottom: 10px;padding: 0px 5px;">
<div class="btn-group" role="group" >
';

// mostramos la paginación
for ($i=1; $i <= $totalpaginas; $i++) { 

    // para identificar la página actual, le agregamos una clase
    // para darle un estilo diferente 
    if($i == $paginaActual){
        echo '<a class="btn btn-warning active">'.$i.'</a>';
    }
    // sólo vamos a mostrar los enlaces de la primer página,
    // las dos siguientes, las dos anteriores
    // y la última
    else if($i == 1){
         echo '<a class="btn btn-warning" href="publicaciones?page='.$i.'"><i class="glyphicon glyphicon-chevron-left"></i><i class="glyphicon glyphicon-chevron-left"></i> </a>';
     }elseif ($i == $totalpaginas) {
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'"><i class="glyphicon glyphicon-chevron-right"></i><i class="glyphicon glyphicon-chevron-right"></i> </a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 2) {
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'">'.$i.'</a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 3) {
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'">'.$i.'</a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 4) {
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'">'.$i.'</a>';
     }elseif ($i == $paginaActual - 1 ){
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'"><i class="glyphicon glyphicon-chevron-left"></i></a>';
     }elseif ($i == $paginaActual + 5 ){
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'"><i class="glyphicon glyphicon-chevron-right"></i></a>';
     }
}

echo'
</div>
</div>
';

}

function newuserfunction($nombre,$apellido,$email,$password,$activo,$rango){

  // conexion de la base de datos
  $conexion = Conexion::singleton_conexion();

  $Check = "SELECT * FROM usuarios WHERE email = :email";
  $sencheck = $conexion -> prepare($Check);
  $sencheck -> bindParam(':email', $email, PDO::PARAM_STR);
  $sencheck -> execute();
  $resultados = $sencheck -> fetchAll();
  if (empty($resultados)){

     
     $profile = 1;
     $date = date('Y-m-d');
     $crypt = sha1(SALT.$_POST['contrasena'].PEPER);
     $perma = sha1($_POST['email']);
     $SQL = 'INSERT INTO usuarios (nombre, apellido, profile, email, password, registro, permalink, activo, ranker) VALUES (?,?,?,?,?,?,?,?,?)';
     $sentence = $conexion -> prepare($SQL);
     $sentence -> bindParam(1,$_POST['nombre'],PDO::PARAM_STR);
     $sentence -> bindParam(2,$_POST['apellido'],PDO::PARAM_STR);
     $sentence -> bindParam(3,$profile,PDO::PARAM_STR);
     $sentence -> bindParam(4,$_POST['email'],PDO::PARAM_STR);
     $sentence -> bindParam(5,$crypt,PDO::PARAM_STR);
     $sentence -> bindParam(6,$date,PDO::PARAM_STR);
     $sentence -> bindParam(7,$perma,PDO::PARAM_STR);
     $sentence -> bindParam(8,$_POST['activo'],PDO::PARAM_INT);
     $sentence -> bindParam(9,$_POST['rango'],PDO::PARAM_INT);
     $sentence -> execute();
     
    if ($_POST['activo'] == 1) {
    // Insertar para Verificar
    $mailtoken = sha1($email.TOKENMAIL);
    $ver = 'INSERT INTO verify (token,email,fecha) VALUES (:token,:email,:fecha)';
    $versentence = $conexion -> prepare($ver);
    $versentence -> bindParam(':token',$mailtoken,PDO::PARAM_STR);
    $versentence -> bindParam(':email',$email,PDO::PARAM_STR);
    $versentence -> bindParam(':fecha',$date,PDO::PARAM_STR);
    $versentence -> execute();

    // Email
    $dataexplode = congifurationmail();
    $parsedata = explode("|", $dataexplode);

    $htmlhead = '<!DOCTYPE html><html><body>';
    $htmlfooter = '</body></html>';
    $messageone = '<p>'.$parsedata[6].'</p></p><p></p>';
    $activationlink = '<p><label>Activar Mi Cuenta: </label><p></p><a href="'.$parsedata[5].'active?token='.$mailtoken.'&email='.$email.'">'.$parsedata[5].'activate?token='.$mailtoken.'&email='.$email.'</a></p>';

    // Envio de Correo 
    $mail = new PHPMailer;
    $mail->isSMTP();                                      
    $mail->Host = $parsedata[0];   // especiificar el servidor smtp
    $mail->SMTPAuth = true;                           
    $mail->Username = $parsedata[3];   // correo desde el que se enviara
    $mail->Password = $parsedata[4];  // password del correo
    $mail->Port = $parsedata[1];     // el puerto por defecto para SMTP es 587 pero puede ser otro
    $mail->setFrom($parsedata[3], $parsedata[2]);  // remitente, el segundo paramtero es el nombre
    $mail->addAddress($email);   // destino
    $mail->isHTML(true);    
    $mail->Subject = 'Activacion de Cuenta -'.SITETITLE;   // Asunto
    $mail->Body    = $htmlhead.$messageone.$activationlink.$htmlfooter;
    $mail->send();
    }



  }else{
    foreach ($resultados as $key){
      # code...
    }
  }




}


// Mensajes
function mensajesadmin($page){

         // conexion de la base de datos
         $conexion = Conexion::singleton_conexion();

         $RowCount = "SELECT * FROM publicaciones";
         $counsentence = $conexion -> prepare($RowCount);
         $counsentence -> execute();
         $cuantos = $counsentence -> rowCount();

         // Tamaño de pagina
         $resultados = 10;
         // total parginado
         $totalpaginas = ceil($cuantos / $resultados);
         // articulo inicial
         $articuloInicial = ($page - 1) * $resultados;

         if ($page == 1) {
            $SQL = "SELECT publicaciones.idpublicacion, usuarios.nombre, usuarios.apellido, publicaciones.publicacion, publicaciones.fecha, publicaciones.usuario FROM publicaciones INNER JOIN usuarios ON usuarios.idusuario = publicaciones.usuario LIMIT 10";
            $paginaActual = 1;
         }else{
            $SQL = "SELECT publicaciones.idpublicacion, usuarios.nombre, usuarios.apellido, publicaciones.publicacion, publicaciones.fecha, publicaciones.usuario FROM publicaciones INNER JOIN usuarios ON usuarios.idusuario = publicaciones.usuario LIMIT ".$articuloInicial.", ".$resultados."";
            $paginaActual = $page;
         }

         $sentence = $conexion -> prepare($SQL);
         $sentence -> bindParam(':estado', $estadoid, PDO::PARAM_INT);
         $sentence -> execute();
         $results = $sentence -> fetchAll();
         if (empty($results)){
           # code...
         }else{

                 echo'
                   <table class="table table-striped">
                      <thead class="messages-table-header">
                         <tr>
                           <th><i class="fa fa-angle-double-right"></i> Usuario</th>
                           <th><i class="fa fa-angle-double-right"></i> Publicacion</th>
                           <th><i class="fa fa-angle-double-right"></i> Fecha</th>
                           <th><i class="fa fa-angle-double-right"></i> Acciones</th>
                         </tr>
                      </thead>
                      <tbody>
                     ';

          foreach ($results as $key){


            $fecha = str_replace('-', '/', date("d-m-Y h:i:s", strtotime($key['fecha'])));

            echo '
              <tr id="trpublicacion'.$key['idpublicacion'].'">
                <td>'.$key['nombre'].' '.$key['apellido'].'</td>
                <td>'.substr($key['publicacion'], 0,100).'</td>
                <td>'.$fecha.'</td>
                <td>
                  <button data-id="'.$key['idpublicacion'].'" class="editpublicacion btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Editar</button>
                  <button data-id="'.$key['idpublicacion'].'" class="deleteaplicacion btn btn-xs btn-danger"><i class="fa fa-times"></i> Eliminar</button>
                </td>
              </tr>
            ';
          }

          echo'
            </tbody>
          </table>
          ';


         }
echo'
<p></p>
<div class="col-md-12 text-right" style="margin-top: 0px;margin-bottom: 10px;padding: 0px 5px;">
<div class="btn-group" role="group" >
';

// mostramos la paginación
for ($i=1; $i <= $totalpaginas; $i++) { 

    // para identificar la página actual, le agregamos una clase
    // para darle un estilo diferente 
    if($i == $paginaActual){
        echo '<a class="btn btn-warning active">'.$i.'</a>';
    }
    // sólo vamos a mostrar los enlaces de la primer página,
    // las dos siguientes, las dos anteriores
    // y la última
    else if($i == 1){
         echo '<a class="btn btn-warning" href="publicaciones?page='.$i.'"><i class="glyphicon glyphicon-chevron-left"></i><i class="glyphicon glyphicon-chevron-left"></i> </a>';
     }elseif ($i == $totalpaginas) {
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'"><i class="glyphicon glyphicon-chevron-right"></i><i class="glyphicon glyphicon-chevron-right"></i> </a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 2) {
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'">'.$i.'</a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 3) {
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'">'.$i.'</a>';
     }elseif ($i >= $paginaActual && $i <= $paginaActual + 4) {
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'">'.$i.'</a>';
     }elseif ($i == $paginaActual - 1 ){
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'"><i class="glyphicon glyphicon-chevron-left"></i></a>';
     }elseif ($i == $paginaActual + 5 ){
       echo '<a class="btn btn-warning" rel="nofollow" href="publicaciones?page='.$i.'"><i class="glyphicon glyphicon-chevron-right"></i></a>';
     }
}

echo'
</div>
</div>
';

}

