<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

// ambil data lama
$sql  = "SELECT * FROM mahasiswa WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
    header("Location: index.php");
    exit;
}

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = $_POST['nim'];
    $nama    = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat  = $_POST['alamat'];

    $sqlU = "UPDATE mahasiswa
             SET nim = ?, nama = ?, jurusan = ?, alamat = ?
             WHERE id = ?";
    $stmtU = $conn->prepare($sqlU);
    $stmtU->bind_param("ssssi", $nim, $nama, $jurusan, $alamat, $id);

    if ($stmtU->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $pesan = "Gagal mengupdate data: " . $stmtU->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
</head>
<body>
    <h1>Edit Mahasiswa</h1>
    <a href="index.php">Kembali</a>
    <br><br>

    <?php if ($pesan): ?>
        <p><?= htmlspecialchars($pesan); ?></p>
    <?php endif; ?>

    <form method="post">
        <label>NIM</label><br>
        <input type="text" name="nim" required
               value="<?= htmlspecialchars($data['nim']); ?>"><br><br>

        <label>Nama</label><br>
        <input type="text" name="nama" required
               value="<?= htmlspecialchars($data['nama']); ?>"><br><br>

        <label>Jurusan</label><br>
        <input type="text" name="jurusan" required
               value="<?= htmlspecialchars($data['jurusan']); ?>"><br><br>

        <label>Alamat</label><br>
        <textarea name="alamat"><?= htmlspecialchars($data['alamat']); ?></textarea><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
