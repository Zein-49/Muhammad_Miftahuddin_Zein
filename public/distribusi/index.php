<?php
require_once '../../config/db.php';
$stmt = $pdo->query("
    SELECT d.id, p.nama AS nama_petani, b.nama AS nama_pembeli, hp.komoditas, d.jumlah_kg, d.tanggal_kirim
    FROM distribusi d
    JOIN hasil_panen hp ON d.hasil_panen_id = hp.id
    JOIN petani p ON hp.petani_id = p.id
    JOIN pembeli b ON d.pembeli_id = b.id
    ORDER BY d.tanggal_kirim DESC
");
$distribusi = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Distribusi - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Distribusi Hasil Panen</h2>
    <a href="tambah.php" class="btn">+ Tambah Distribusi</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Petani</th>
            <th>Pembeli</th>
            <th>Komoditas</th>
            <th>Jumlah (kg)</th>
            <th>Tanggal Kirim</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($distribusi as $d): ?>
        <tr>
            <td><?= $d['id'] ?></td>
            <td><?= $d['nama_petani'] ?></td>
            <td><?= $d['nama_pembeli'] ?></td>
            <td><?= $d['komoditas'] ?></td>
            <td><?= $d['jumlah_kg'] ?></td>
            <td><?= $d['tanggal_kirim'] ?></td>
            <td>
                <a href="edit.php?id=<?= $d['id'] ?>" class="btn">Edit</a>
                <a href="hapus.php?id=<?= $d['id'] ?>" class="btn" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../index.php" class="btn">← Kembali</a>
</div>
</body>
</html>
