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

sort($list);
*/

/* database mode */
include 'config.php';

$crud = new CRUD();

header('Content-Type: application/json');
echo json_encode($crud->index());

