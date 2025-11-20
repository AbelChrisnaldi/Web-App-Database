<?php
include "koneksi.php";

// proses delete jika ada parameter ?hapus=id
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $sql = "DELETE FROM mahasiswa WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}

// ambil semua data
$result = $conn->query("SELECT * FROM mahasiswa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h1>Data Mahasiswa</h1>
    <a href="tambah.php">Tambah Mahasiswa</a>
    <br><br>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        if ($result->num_rows > 0):
            while($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nim']); ?></td>
            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= htmlspecialchars($row['jurusan']); ?></td>
            <td><?= htmlspecialchars($row['alamat']); ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>">Edit</a> |
                <a href="index.php?hapus=<?= $row['id']; ?>" 
                   onclick="return confirm('Yakin hapus data ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php
            endwhile;
        else:
        ?>
        <tr>
            <td colspan="6">Belum ada data.</td>
        </tr>
        <?php endif; ?>
    </table>
</body>
</html>
