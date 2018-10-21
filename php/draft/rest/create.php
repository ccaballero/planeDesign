<?php

include 'config.php';

if(!$_POST['file'] || !$_POST['content']){
    return 'false';
}

$crud = new CRUD();
return $crud->create($_POST['file'],implode(' ## ',$_POST['content']));

