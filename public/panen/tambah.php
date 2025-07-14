<?php
require_once '../../config/db.php';

// Ambil data petani untuk dropdown
$petani = $pdo->query("SELECT * FROM petani")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petani_id = $_POST['petani_id'];
    $komoditas = $_POST['komoditas'];
    $jumlah_kg = $_POST['jumlah_kg'];
    $tanggal_panen = $_POST['tanggal_panen'];

    $stmt = $pdo->prepare("INSERT INTO hasil_panen (petani_id, komoditas, jumlah_kg, tanggal_panen) VALUES (?, ?, ?, ?)");
    $stmt->execute([$petani_id, $komoditas, $jumlah_kg, $tanggal_panen]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Panen - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Tambah Data Hasil Panen</h2>
    <form method="post">
        <label>Petani</label>
        <select name="petani_id" required>
            <option value="">-- Pilih Petani --</option>
            <?php foreach ($petani as $p): ?>
                <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Komoditas</label>
        <input type="text" name="komoditas" required>

        <label>Jumlah (kg)</label>
        <input type="number" name="jumlah_kg" required>

        <label>Tanggal Panen</label>
        <input type="date" name="tanggal_panen" required>

        <button type="submit">Simpan</button>
    </form>
    <a href="index.php" class="btn">← Kembali</a>
</div>
</body>
</html>
