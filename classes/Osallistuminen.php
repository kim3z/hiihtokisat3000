<?php

/**
  * @author Alimu ja Kim
  */

class Osallistuminen {

  public static function onkoJarjestysNumeroOlemassa( $kisa_id, $sarja_id, $jarjestys_numero) {
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
}
