<?php

  require_once '../kantayhteys.php';

  $kisat = [];

  $stmt = $conn->prepare('SELECT * FROM kisa');
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()) {
      array_push($kisat, $row);
  }

 ?>
