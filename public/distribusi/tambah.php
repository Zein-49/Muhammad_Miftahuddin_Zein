<?php
require_once '../../config/db.php';

// Ambil data hasil panen dan pembeli
$panen = $pdo->query("
    SELECT hp.id, hp.komoditas, p.nama AS nama_petani 
    FROM hasil_panen hp 
    JOIN petani p ON hp.petani_id = p.id
")->fetchAll();

$pembeli = $pdo->query("SELECT * FROM pembeli")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hasil_panen_id = $_POST['hasil_panen_id'];
    $pembeli_id = $_POST['pembeli_id'];
    $jumlah_kg = $_POST['jumlah_kg'];
    $tanggal_kirim = $_POST['tanggal_kirim'];

    $stmt = $pdo->prepare("INSERT INTO distribusi (hasil_panen_id, pembeli_id, jumlah_kg, tanggal_kirim) VALUES (?, ?, ?, ?)");
    $stmt->execute([$hasil_panen_id, $pembeli_id, $jumlah_kg, $tanggal_kirim]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Distribusi - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Data Distribusi</h2>
    <form method="post">
        <label>Hasil Panen (Petani - Komoditas)</label>
        <select name="hasil_panen_id" required>
            <option value="">-- Pilih Hasil Panen --</option>
            <?php foreach ($panen as $p): ?>
                <option value="<?= $p['id'] ?>"><?= $p['nama_petani'] ?> - <?= $p['komoditas'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Pembeli</label>
        <select name="pembeli_id" required>
            <option value="">-- Pilih Pembeli --</option>
            <?php foreach ($pembeli as $b): ?>
                <option value="<?= $b['id'] ?>"><?= $b['nama'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Jumlah (kg)</label>
        <input type="number" name="jumlah_kg" required>

        <label>Tanggal Kirim</label>
        <input type="date" name="tanggal_kirim" required>

        <button type="submit">Simpan</button>
    </form>
    <a href="index.php" class="btn">← Kembali</a>
</div>
</body>
</html>
