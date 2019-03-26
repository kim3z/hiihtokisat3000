<?php
$servername = "localhost";
$username = "testi";
$password = "testi";
$dbname = "testi";

// Luodaan yhteys
$conn = new mysqli($servername, $username, $password, $dbname);
// Tarkastetaan yhteys
if ($conn->connect_error) {
	die("Tietokantayhteys katkennut: " . $conn->connect_error);
	}
?>