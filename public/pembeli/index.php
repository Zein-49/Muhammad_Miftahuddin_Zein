<?php
require_once '../../config/db.php';
$stmt = $pdo->query("SELECT * FROM pembeli");
$pembeli = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pembeli - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Data Pembeli</h2>
    <a href="tambah.php" class="btn">+ Tambah Pembeli</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($pembeli as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['nama'] ?></td>
            <td><?= $p['alamat'] ?></td>
            <td><?= $p['no_hp'] ?></td>
            <td>
                <a href="edit.php?id=<?= $p['id'] ?>" class="btn">Edit</a>
                <a href="hapus.php?id=<?= $p['id'] ?>" class="btn" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../index.php" class="btn">← Kembali</a>
</div>
</body>
</html>
