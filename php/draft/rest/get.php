<?php

session_start();
include 'config.php';

if(!$_GET['file']){
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: text/html');
    echo 'not found';
    return;
}

$crud = new CRUD();
$data = $crud->get($_GET['file']);

header('Content-Type: application/json');
echo json_encode(explode(' ## ',$data));

