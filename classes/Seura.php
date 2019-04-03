<?php

/**
  * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
  */

class Seura {

    /**
     * Register new user
     */
    public static function kaikkiSeurat() {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';
       
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

    /**
     * Seuran nimi by id
     */
    public static function seuraNimi($seura_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';

        $seurat = [];
        $stmt = $conn->prepare('SELECT nimi FROM seura WHERE id = ?');
        $stmt->bind_param('i', $seura_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        while($row = $result->fetch_assoc()) {
            array_push($seurat, $row);
        }

        if (count($seurat) > 0) {
            return $seurat[0]['nimi'];
        }

        return null;
    }
}
