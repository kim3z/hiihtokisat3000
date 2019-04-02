<?php
$servername = "";
$username = "";
$password = "";
$dbname = "hiihtokisat";

// Luodaan yhteys
$conn = new mysqli($servername, $username, $password, $dbname);
// Tarkastetaan yhteys
if ($conn->connect_error) {
	die("Tietokantayhteys katkennut: " . $conn->connect_error);
	}

$conn->set_charset("utf8");

?>
