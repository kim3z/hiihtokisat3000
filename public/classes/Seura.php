<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

class Seura {

    /**
     * Register new user
     */
    public static function kaikkiSeurat() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';
       
        $seurat = [];

        $stmt = $conn->prepare('SELECT * FROM seura');
        $stmt->execute();
        $result = $stmt->get_result();
        
        while($row = $result->fetch_assoc()) {
            array_push($seurat, $row);
        }

        $conn->close();

        return $seurat;
    }
}
