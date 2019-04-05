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

    /**
     * Poista sarja
     */
    public static function poistaSarja($sarja_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $stmt = $conn->prepare('DELETE FROM sarja WHERE id = ?');
        $stmt->bind_param('i', $sarja_id);

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
     * Katso onko sarja jo olemassa
     * 
     * @return boolean
     */
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

    /**
     * Hae kayttajalle sopiva sarja ian perusteella
     */
    public static function haeSopivaSarja($kisa_id, $ika, $sukupuoli){
      require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

      $sarja = null;
      $stmt = $conn->prepare('SELECT * FROM sarja WHERE kisaId = ? AND max_ika >= ? AND min_ika <= ? AND sukupuoli = ?');
      $stmt->bind_param('iiii', $kisa_id, $ika, $ika, $sukupuoli);
      $stmt->execute();

      $result = $stmt->get_result();

      while($row = $result->fetch_assoc()) {
          $sarja = $row;
          break;
      }

      return $sarja;

    }

    /**
     * Hae sarja
     */
    public static function haeSarja($sarja_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $sarja = null;

        $stmt = $conn->prepare('SELECT * FROM sarja WHERE id = ?');
        $stmt->bind_param('i', $sarja_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while($row = $result->fetch_assoc()) {
            $sarja = $row;
            break;
        }
        $stmt->close();
        $conn->close();

        return $sarja;
    }
}
