<?php

session_start();
include 'config.php';

$crud = new CRUD();
$draw = $crud->get($_GET['file']);

header('Content-Type: application/json');

if($draw){
    echo 'true';
}else{
    echo 'false';
}

