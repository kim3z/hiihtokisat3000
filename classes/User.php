<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

class User {

    public static $ADMIN_USER = 1;
    public static $NORMAL_USER = 2;
    
    public static $GENDER_MALE = 1;
    public static $GENDER_FEMALE = 2;

    /**
     * Paivita kayttajan profiili
     * 
     * @return boolean
     */
    public static function updateUser($user) {
        require('../kantayhteys.php');

        $stmt = $conn->prepare('UPDATE user SET etunimi = ?, sukunimi = ?, email = ?, seuraId = ?, syntymaAika = ?, sukupuoli = ? WHERE id = ?');
        $stmt->bind_param(
                    'sssisii', 
                    $user['etunimi'], 
                    $user['sukunimi'], 
                    $user['email'],
                    $user['seuraId'], 
                    $user['syntymaAika'], 
                    $user['sukupuoli'], 
                    $user['id']
        );

        if ($stmt->execute()) {
            $conn->close();
            return true;
        }

        $conn->close();

        return false;
    }

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
    public static function login($given_email, $given_psw) {
        require('../kantayhteys.php');
        $user = null;
        $stmt = $conn->prepare('SELECT * FROM user WHERE email = ?');

        $stmt->bind_param('s', $given_email);
        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            if (isset($row)) {
                $user = $row;
                break;
            }
        }

        if($user && password_verify($given_psw, $user['salasana'])){
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }

    /**
     * Get user by email
     */
    public static function getUserByEmail($email) {
        require('../kantayhteys.php');
        $user = null;
        $stmt = $conn->prepare('SELECT * FROM user WHERE email = ?');

        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            if (isset($row)) {
                $user = $row;
                break;
            }
        }

        return $user;
    }

    /**
     * Check if user already exists
     */
    protected static function exists($email) {
        $userExists = false;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('SELECT email FROM user WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            return true;
        }

        $stmt->close();
        $conn->close();

        return $userExists;
    }
}
