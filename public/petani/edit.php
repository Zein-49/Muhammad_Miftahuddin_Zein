<?php
require_once '../../config/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM petani WHERE id = ?");
$stmt->execute([$id]);
$petani = $stmt->fetch();

if (!$petani) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    $stmt = $pdo->prepare("UPDATE petani SET nama = ?, alamat = ?, no_hp = ? WHERE id = ?");
    $stmt->execute([$nama, $alamat, $no_hp, $id]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Petani - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Edit Data Petani</h2>
    <form method="post">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= $petani['nama'] ?>" required>

        <label>Alamat</label>
        <textarea name="alamat" required><?= $petani['alamat'] ?></textarea>

        <label>No HP</label>
        <input type="text" name="no_hp" value="<?= $petani['no_hp'] ?>" required>

        <button type="submit">Update</button>
    </form>
    <a href="index.php" class="btn">← Kembali</a>
</div>
</body>
</html>
