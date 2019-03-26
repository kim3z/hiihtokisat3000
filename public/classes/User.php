<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

class User {

    public static $ADMIN_USER = 1;
    public static $NORMAL_USER = 2;

    /**
     * Register new user
     */
    public static function registerUser($user) {

        if (self::exists($user['email'])) {
            return false;
        }

        require('../kantayhteys.php');

        $stmt = $conn->prepare('INSERT INTO user (etunimi, sukunimi, email, salasana, seuraId, syntymaAika, sukupuoli, rooli) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param(
                    'ssssisii', 
                    $user['etunimi'], 
                    $user['sukunimi'], 
                    $user['email'], 
                    $user['salasana'], 
                    $user['seuraId'], 
                    $user['syntymaAika'], 
                    $user['sukupuoli'], 
                    $user['rooli']
        );

        if ($stmt->execute()) {
            $conn->close();
            return true;
        }

        $conn->close();

        return false;
    }

    /**
     * User login
     */
    public static function login() {
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
    protected static function exists($email) {
        $userExists = false;

        require('../kantayhteys.php');

        $stmt = $conn->prepare("SELECT email FROM user WHERE email = ? LIMIT 1");
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $existingEmail = $stmt->get_result()->fetch_object()->email;

        $stmt->close();

        if (isset($existingEmail)) {
            if ($existingEmail === $email) {
                $userExists = true;
            }
        }

        return $userExists;
    }
}
