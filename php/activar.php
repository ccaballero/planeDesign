<?php
// Incluimos las funciones
require_once 'sau-includes/sau-functions.php';

// Checar si existen las variables
if(isset($_GET['token']) and isset($_GET['email'])){
   $active = checkactive($_GET['token'],$_GET['email']);
   if ($active == 1){
   	header('Location: index.php');
   }else{
   	header('Location: index.php');
   }
}else{
	header('Location: index.php');
}
