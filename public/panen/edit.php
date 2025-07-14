<?php
require_once '../../config/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM hasil_panen WHERE id = ?");
$stmt->execute([$id]);
$panen = $stmt->fetch();

// Ambil data petani
$petani = $pdo->query("SELECT * FROM petani")->fetchAll();

if (!$panen) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petani_id = $_POST['petani_id'];
    $komoditas = $_POST['komoditas'];
    $jumlah_kg = $_POST['jumlah_kg'];
    $tanggal_panen = $_POST['tanggal_panen'];

    $stmt = $pdo->prepare("UPDATE hasil_panen SET petani_id = ?, komoditas = ?, jumlah_kg = ?, tanggal_panen = ? WHERE id = ?");
    $stmt->execute([$petani_id, $komoditas, $jumlah_kg, $tanggal_panen, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Panen - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Edit Data Hasil Panen</h2>
    <form method="post">
        <label>Petani</label>
        <select name="petani_id" required>
            <?php foreach ($petani as $p): ?>
                <option value="<?= $p['id'] ?>" <?= $panen['petani_id'] == $p['id'] ? 'selected' : '' ?>>
                    <?= $p['nama'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Komoditas</label>
        <input type="text" name="komoditas" value="<?= $panen['komoditas'] ?>" required>

        <label>Jumlah (kg)</label>
        <input type="number" name="jumlah_kg" value="<?= $panen['jumlah_kg'] ?>" required>

        <label>Tanggal Panen</label>
        <input type="date" name="tanggal_panen" value="<?= $panen['tanggal_panen'] ?>" required>

        <button type="submit">Update</button>
    </form>
    <a href="index.php" class="btn">← Kembali</a>
</div>
</body>
</html>
