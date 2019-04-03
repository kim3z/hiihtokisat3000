<?php

/**
  * @author Alimu ja Kim
  */

class Kisa {

    /**
     * Kaikki kisat
     */
    public static function kaikkiKisat() {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $kisat = [];

        $stmt = $conn->prepare('SELECT * FROM kisa');
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            array_push($kisat, $row);
        }
        $stmt->close();
        $conn->close();

        return $kisat;
    }

}
