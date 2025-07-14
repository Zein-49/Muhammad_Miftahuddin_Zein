<?php
require_once '../../config/db.php';
$stmt = $pdo->query("SELECT hp.*, p.nama AS nama_petani FROM hasil_panen hp JOIN petani p ON hp.petani_id = p.id");
$panen = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Hasil Panen - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Data Hasil Panen</h2>
    <a href="tambah.php" class="btn">+ Tambah Panen</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Petani</th>
            <th>Komoditas</th>
            <th>Jumlah (kg)</th>
            <th>Tanggal Panen</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($panen as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['nama_petani'] ?></td>
            <td><?= $p['komoditas'] ?></td>
            <td><?= $p['jumlah_kg'] ?></td>
            <td><?= $p['tanggal_panen'] ?></td>
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
