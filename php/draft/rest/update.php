<?php

/* file mode
$dir = realpath(dirname(__FILE__) . '/../data/');

if(!empty($_POST['file']) && !empty($_POST['content'])){
    file_put_contents($dir . '/' . basename($_POST['file']),
        implode(PHP_EOL,$_POST['content']));
}

echo 'true';
*/

/* database mode */
include 'config.php';

if(!$_POST['file'] || !$_POST['content']){
    return 'false';
}

$crud = new CRUD();
return $crud->update($_POST['file'],implode(' ## ',$_POST['content']));

