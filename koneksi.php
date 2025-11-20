<?php
$host = "localhost";
$user = "root";          // sesuaikan
$pass = "";              // sesuaikan
$db   = "db_mahasiswa";  // nama database tadi

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
