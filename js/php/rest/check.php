<?php

/* file mode
$dir = realpath(dirname(__FILE__) . '/../data/');
$list = array();

if ($handle = opendir($dir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $list[] = $entry;
        }
    }
    closedir($handle);
}

header('Content-Type: application/json');

if(count($_GET)===1 && !empty($_GET['file']) && in_array($_GET['file'],$list)){
    echo 'true';
}else{
    echo 'false';
}
*/

/* database mode */
include 'config.php';

$crud = new CRUD();
$draw = $crud->get($_GET['file']);

header('Content-Type: application/json');

if($draw){
    echo 'true';
}else{
    echo 'false';
}

