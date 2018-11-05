<?php
require_once 'sau-includes/sau-functions.php';

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

