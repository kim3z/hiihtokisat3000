<?php

/**
  * @author Alimu ja Kim
  */

class Osallistuminen {

    /**
     * Kayttajan osallistumiset
     */
    public static function kayttajanOsallistumiset($user_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $osallistumiset = [];

        $stmt = $conn->prepare('SELECT * FROM osallistuminen WHERE userId = ?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            array_push($osallistumiset, $row);
        }
        $stmt->close();
        $conn->close();

        return $osallistumiset;
    }

    /**
     * Kayttajan osallistumiset
     */
    public static function kisaSarjaOsallistujat($kisa_id, $sarja_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $osallistujat = [];

        $stmt = $conn->prepare('SELECT * FROM osallistuminen WHERE kisaId = ? AND sarjaId = ?');
        $stmt->bind_param('ii', $kisa_id, $sarja_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            array_push($osallistujat, $row);
        }
        $stmt->close();
        $conn->close();

        return $osallistujat;
    }
  
    /**
     * Katso onko olemassa ilmoittautunut kayttaja samalla jarjestysnumerolla
     * 
     * @return boolean
     */
    public static function onkoJarjestysNumeroOlemassa($kisa_id, $sarja_id, $jarjestys_numero) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('SELECT * FROM osallistuminen WHERE kisaId = ? AND sarjaId = ? AND jarjestysNumero = ?');
        $stmt->bind_param('iii', $kisa_id, $sarja_id, $jarjestys_numero);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        }

        return false;
    }

    /**
     * Katso onko kayttaja jo rekisteroinyt kisaan
     * 
     * @return boolean
     */
    public static function kayttajaOnJoIlmoittautunut($kisa_id, $user_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('SELECT * FROM osallistuminen WHERE kisaId = ? AND userId = ?');
        $stmt->bind_param('ii', $kisa_id, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return true;
        }

        return false;
    }

    /**
     * Poista osallistuminen
     */
    public static function poistaOsallistuminen($kisa_id, $user_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('DELETE FROM osallistuminen WHERE kisaId = ? AND userId = ?');
        $stmt->bind_param('ii', $kisa_id, $user_id);

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
     * Poista osallistuja
     * 
     * @return boolean
     */
    public static function poistaOsallistuja($osallistuja_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('DELETE FROM osallistuminen WHERE id = ?');
        $stmt->bind_param('i', $osallistuja_id);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true;
        }

        $stmt->close();
        $conn->close();

        return false;
    }
}
