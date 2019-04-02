<?php

/**
  * @author
  */

class Kisa {

    /**
     * Kaikki kisat
     */
    public static function kaikkiKisat() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $kisat = [];

        $stmt = $conn->prepare('SELECT * FROM kisa');
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            array_push($kisat, $row);
        }

        $conn->close();

        return $kisat;
    }
}
