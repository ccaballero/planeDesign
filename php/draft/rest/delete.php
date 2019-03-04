<?php

session_start();
include 'config.php';

if(!$_GET['ident']){
    return 'false';
}

$crud = new CRUD();
return $crud->delete($_GET['ident']);

