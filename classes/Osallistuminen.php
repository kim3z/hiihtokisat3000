<?php

/**
  * @author Alimu ja Kim
  */

class Osallistuminen {
  
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
  public static function kayttajaOnJoRekisteroinyt($kisa_id, $user_id) {
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
}
