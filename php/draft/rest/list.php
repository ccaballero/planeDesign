<?php

session_start();
include 'config.php';

$crud = new CRUD();

header('Content-Type: application/json');
echo json_encode($crud->index());

