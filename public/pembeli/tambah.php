<?php
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $stmt = $pdo->prepare("INSERT INTO pembeli (nama, alamat, no_hp) VALUES (?, ?, ?)");
    $stmt->execute([$nama, $alamat, $no_hp]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pembeli - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Data Pembeli</h2>
    <form method="post">
        <label>Nama</label>
        <input type="text" name="nama" required>

        <label>Alamat</label>
        <textarea name="alamat" required></textarea>

        <label>No HP</label>
        <input type="text" name="no_hp" required>

        <button type="submit">Simpan</button>
    </form>
    <a href="index.php" class="btn">← Kembali</a>
</div>
</body>
</html>
