<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

class User {
    private $db_table = 'users';
    private $conn;

    public $id;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * User register
     */
    function register() {
        if ($this->exists()) {
            return false;
        } 

        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));

        $sql = 'INSERT INTO ' . $this->db_table . ' (username, password) VALUES (:username, :password)';
        $stmt = $this->conn->prepare($sql);

        $params = array(
            ':username' => $this->username,
            ':password' => $this->password
        );
        
        if ($stmt->execute($params)) {
            return true;
        }

        return false;
    }

    /**
     * User login
     */
    function login() {
        $sql = 'SELECT * FROM ' . $this->db_table. ' WHERE username=:username';
        $stmt = $this->conn->prepare($sql);

        $params = array(
            ':username' => $this->username
        );

        $stmt->execute($params);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($this->password, $user['password'])){
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }

    /**
     * Check if user already exists
     */
    function exists() {
        $userExists = false;
        $sql = 'SELECT * FROM ' . $this->db_table . ' WHERE username=:username';

        $stmt = $this->conn->prepare($sql);

        $params = array(
            ':username' => $this->username
        );

        $stmt->execute($params);

        if($stmt->rowCount() > 0){
            $userExists = true;
        }

        return $userExists;
    }
}
