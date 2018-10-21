<?php

include 'config.php';
include 'factory.php';

if(!$_GET['file']){
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: text/html');
    echo 'not found';
    return;
}

$crud = new CRUD();
$data = $crud->get($_GET['file']);

if(!$data){
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: text/html');
    echo 'not found';
    return;
}

header('Content-Type: text/xml');
echo Factory::generateXML(explode(' ## ',$data));

