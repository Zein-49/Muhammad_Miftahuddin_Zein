<?php
require_once '../../config/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM distribusi WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Ambil data untuk dropdown
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

    $stmt = $pdo->prepare("UPDATE distribusi SET hasil_panen_id = ?, pembeli_id = ?, jumlah_kg = ?, tanggal_kirim = ? WHERE id = ?");
    $stmt->execute([$hasil_panen_id, $pembeli_id, $jumlah_kg, $tanggal_kirim, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Distribusi - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Edit Data Distribusi</h2>
    <form method="post">
        <label>Hasil Panen</label>
        <select name="hasil_panen_id" required>
            <?php foreach ($panen as $p): ?>
                <option value="<?= $p['id'] ?>" <?= $data['hasil_panen_id'] == $p['id'] ? 'selected' : '' ?>>
                    <?= $p['nama_petani'] ?> - <?= $p['komoditas'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Pembeli</label>
        <select name="pembeli_id" required>
            <?php foreach ($pembeli as $b): ?>
                <option value="<?= $b['id'] ?>" <?= $data['pembeli_id'] == $b['id'] ? 'selected' : '' ?>>
                    <?= $b['nama'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Jumlah (kg)</label>
        <input type="number" name="jumlah_kg" value="<?= $data['jumlah_kg'] ?>" required>

        <label>Tanggal Kirim</label>
        <input type="date" name="tanggal_kirim" value="<?= $data['tanggal_kirim'] ?>" required>

        <button type="submit">Update</button>
    </form>
    <a href="index.php" class="btn">← Kembali</a>
</div>
</body>
</html>
