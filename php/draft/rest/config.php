<?php

// CREATE DATABASE draft CHARACTER SET utf8;
// GRANT all PRIVILEGES ON draft.* TO 'jacobian'@'localhost' IDENTIFIED BY 'asdf';

class CRUD {
    private $host = '127.0.0.1';
    private $user = 'jacobian';
    private $db = 'draft';
    private $pass = 'asdf';
    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            'mysql:host=' . $this->host . ';dbname=' . $this->db,
            $this->user, $this->pass);
    }

    public function index() {
        $sql = 'SELECT name,data FROM draw ORDER BY name ASC';
        $q = $this->conn->query($sql) or die('failed!');
        $data = array();

        while($r = $q->fetch(PDO::FETCH_ASSOC)){
            $data[] = $r['name'];
        }

        return $data;
    }

    public function get($name) {
        $sql = 'SELECT * FROM draw WHERE name = :name';
        $q = $this->conn->prepare($sql);
        $q->execute(array(':name' => $name));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if($data) {
            return $data['data'];
        } else {
            return;
        }
    }

    public function update($name, $data) {
        $sql = 'UPDATE draw SET data=:data WHERE name=:name';
        $q = $this->conn->prepare($sql);
        $q->execute(array(
            ':name'=>$name,
            ':data'=>$data
        ));

        return true;
    }

    public function create($name, $data){
        $sql = 'INSERT INTO draw (name,data) VALUE (:name, :data)';
        $q = $this->conn->prepare($sql);
        $q->execute(array(
            ':name'=>$name,
            ':data'=>$data
        ));

        return true;
    }

    public function delete($name) {
        $sql='DELETE FROM draw WHERE name=:name';
        $q = $this->conn->prepare($sql);
        $q->execute(array(
            ':name'=>$name
        ));

        return true;
    }
}

