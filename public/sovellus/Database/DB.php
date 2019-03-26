<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

class DB {

    private $db_host = MY_DB_HOST;
    private $db_user = MY_DB_USERNAME;
    private $db_password = MY_DB_PASSWORD;
    private $db_name = MY_DB_NAME;
    public $conn = null;

    public function newConnection(){
 
        $this->conn = null;
 
        try {
            $this->conn = new PDO('mysql:host=' . $this->db_host . ';dbname=' . $this->db_name, $this->db_user, $this->db_password);
            $this->conn->exec('set names utf8');
        } catch(PDOException $e) {
            echo 'Tietokantaan ei saatu yhteytta. Error: ' . $e->getMessage();
        }
 
        return $this->conn;
    }
}
?>
