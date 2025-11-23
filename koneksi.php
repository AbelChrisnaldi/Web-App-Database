<?php
$host = "dbmahasiswa1.mysql.database.azure.com";
$user = "admin123@dbmahasiswa1";
$pass = "Mahasiswa2025!";
$db   = "db_mahasiswa";
$conn = new mysqli($host, $user, $pass, $db, 3306);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>
