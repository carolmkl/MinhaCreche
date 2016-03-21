<?php
$dbserver = "localhost";
$dbuser = "admin";
$dbpass = "admin";
$dbname = "minhacreche";

/*Abre a conexão com o mysql*/
$conn = mysqli_connect($dbserver,$dbuser,$dbpass);
mysqli_select_db($conn,$dbname);

// Check connection
if (!$conn) {
    echo "<p>Connection failed: ".mysqli_connect_error()."</p>";
    die("Connection failed: " . mysqli_connect_error());
}
?>