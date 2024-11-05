<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "pemilu_gm";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
