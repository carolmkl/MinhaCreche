<?php
$dbserver = "localhost";
$dbuser = "admin";
$dbpass = "admin";
$dbname = "minhacreche";

/*Abre a conexão com o mysql*/
$conn = new mysqli($dbserver,$dbuser,$dbpass,$dbname);

// Check connection
if ($conn->connect_error) {
    echo "<p>Connection failed: ".$conn->connect_error."</p>";
    die("Connection failed: " . $conn->connect_error);
}
?>