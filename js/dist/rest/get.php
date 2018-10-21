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

if(count($_GET)===1 && !empty($_GET['file']) && in_array($_GET['file'],$list)){
    $file = file($dir . '/' . $_GET['file'],
        FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    header('Content-Type: application/json');
    echo json_encode($file);
}else{
    header('HTTP/1.0 404 Not Found');
    header('Content-Type: text/html');
    echo 'not found';
}
*/

/* database mode */
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

