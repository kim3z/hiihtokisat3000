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

        $stmt = $conn->prepare('SELECT * FROM kisa ORDER BY date ASC');
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            array_push($kisat, $row);
        }
        $stmt->close();
        $conn->close();

        return $kisat;
    }

    /**
     * Poista kisa
     * 
     * @return boolean
     */
    public static function poistaKisa($kisa_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('DELETE FROM kisa WHERE id = ?');
        $stmt->bind_param('i', $kisa_id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        }

        $stmt->close();
        $conn->close();

        return false;
    }

    /**
     * Poista kisan kaikki sarjat
     * 
     * @return boolean
     */
    public static function poistaKisanSarjat($kisa_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('DELETE FROM sarja WHERE kisaId = ?');
        $stmt->bind_param('i', $kisa_id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        }

        $stmt->close();
        $conn->close();

        return false;
    }

    /**
     * Paivita kisa
     */
    public static function paivitaKisa($kisa) {
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

    /**
     * Hae kisa
     */
    public static function haeKisa($kisa_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $kisa = null;

        $stmt = $conn->prepare('SELECT * FROM kisa WHERE id = ?');
        $stmt->bind_param('i', $kisa_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            $kisa = $row;
            break;
        }
        $stmt->close();
        $conn->close();

        return $kisa;
    }

}
