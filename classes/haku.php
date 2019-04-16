<?php

class haku {
	
	
    public static function haeTiedot($kisa_id, $sarja_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';
        $tiedot = [];
        $stmt = $conn->prepare('SELECT * FROM osallistuminen WHERE kisaId = ? AND sarjaId = ?');
        $stmt->bind_param('ii', $kisa_id, $sarja_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {

			array_push($tiedot, $row);
            
        }
		
		
        $stmt->close();
        $conn->close();
        return $tiedot;
    }
	
	public static function haeNimi($user_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';
        $nimi = null;
        $stmt = $conn->prepare('SELECT etunimi, sukunimi FROM user WHERE id = ?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $nimi = $row;
		}
		 
        $stmt->close();
        $conn->close();
        return $nimi;
    }
	
	public static function haeSeuraid($user_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';
        $seuraid = null;
        $stmt = $conn->prepare('SELECT seuraId FROM user WHERE id = ?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $seuraid = $row;
		}
		
        $stmt->close();
        $conn->close();
		return $seuraid;
        
    }
	
	public static function haeSeura($seura_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';
        $seura = null;
        $stmt = $conn->prepare('SELECT nimi FROM seura WHERE id = ?');
        $stmt->bind_param('i', $seura_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
            $seura = $row;
		}
		
        $stmt->close();
        $conn->close();
		return $seura;
        
    }
	
	public static function haeKilpailijat($kisa_id) {
        require $_SERVER['DOCUMENT_ROOT'] . '/kantayhteys.php';
        $tiedot = [];
        $stmt = $conn->prepare('SELECT * FROM osallistuminen WHERE kisaId = ? ');
        $stmt->bind_param('i', $kisa_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()) {
           
			array_push($tiedot, $row);
            
        }
		
        $stmt->close();
        $conn->close();
        return $tiedot;
    }
	
	
}