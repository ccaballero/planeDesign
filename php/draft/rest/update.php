<?php

session_start();
include 'config.php';

if(!$_POST['file'] || !$_POST['content']){
    return 'false';
}

$crud = new CRUD();
return $crud->update($_POST['file'],implode(' ## ',$_POST['content']));

