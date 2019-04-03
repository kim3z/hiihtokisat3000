<?php

/**
  * @author Alimu ja Kim
  */

class Sarja {

    public static $SUKUPUOLI_MIES = 1;
    public static $SUKUPUOLI_NAINEN = 2;

    /**
     * Kisan sarjat
     */
    public static function sarjat($kisa_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $kisanSarjat = [];

        $stmt = $conn->prepare('SELECT * FROM sarja WHERE kisaId = ?');
        $stmt->bind_param('i', $kisa_id);

        $stmt->execute();

        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            array_push($kisanSarjat, $row);
        }

        $conn->close();

        return $kisanSarjat;   
    }

    public static function onkoSarjaOlemassa($min_ika, $max_ika, $sukupuoli, $kisa_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('SELECT * FROM sarja WHERE kisaId = ? AND max_ika = ? AND min_ika = ? AND sukupuoli = ?');
        $stmt->bind_param('iiii', $kisa_id, $max_ika, $min_ika, $sukupuoli);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        }

        return false;
    }
}