<?php
include "koneksi.php";

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = $_POST['nim'];
    $nama    = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat  = $_POST['alamat'];

    $sql = "INSERT INTO mahasiswa (nim, nama, jurusan, alamat)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nim, $nama, $jurusan, $alamat);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $pesan = "Gagal menambah data: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
</head>
<body>
    <h1>Tambah Mahasiswa</h1>
    <a href="index.php">Kembali</a>
    <br><br>

    <?php if ($pesan): ?>
        <p><?= htmlspecialchars($pesan); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>NIM</label><br>
        <input type="text" name="nim" required><br><br>

        <label>Nama</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Jurusan</label><br>
        <input type="text" name="jurusan" required><br><br>

        <label>Alamat</label><br>
        <textarea name="alamat"></textarea><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
