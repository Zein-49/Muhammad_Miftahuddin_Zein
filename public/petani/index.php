<?php
require_once '../../config/db.php';

$stmt = $pdo->query("SELECT * FROM petani");
$petani = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Petani - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Data Petani</h2>
    <a href="tambah.php" class="btn">+ Tambah Petani</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($petani as $p): ?>
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
    <a href="../index.php" class="btn">← Kembali ke Dashboard</a>
</div>
</body>
</html>
