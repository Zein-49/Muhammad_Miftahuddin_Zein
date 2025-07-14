<?php
require_once '../../config/db.php';

// Ambil data distribusi
$sql = "
    SELECT p.nama AS nama_petani, hp.komoditas, d.jumlah_kg, d.tanggal_kirim
    FROM distribusi d
    JOIN hasil_panen hp ON d.hasil_panen_id = hp.id
    JOIN petani p ON hp.petani_id = p.id
    ORDER BY d.tanggal_kirim ASC
";
$data = $pdo->query($sql)->fetchAll();

// Siapkan data untuk grafik
$grafik = $pdo->query("
    SELECT hp.komoditas, SUM(d.jumlah_kg) AS total_kg
    FROM distribusi d
    JOIN hasil_panen hp ON d.hasil_panen_id = hp.id
    GROUP BY hp.komoditas
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Distribusi - TaniSupply</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container">
    <h2>Laporan Distribusi Hasil Panen</h2>
    <a href="../index.php" class="btn">← Kembali ke Dashboard</a>

    <div class="card">
        <h3>Data Distribusi</h3>
        <table>
            <tr>
                <th>Petani</th>
                <th>Komoditas</th>
                <th>Jumlah (kg)</th>
                <th>Tanggal Kirim</th>
            </tr>
            <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['nama_petani'] ?></td>
                <td><?= $row['komoditas'] ?></td>
                <td><?= $row['jumlah_kg'] ?></td>
                <td><?= date('d-m-Y', strtotime($row['tanggal_kirim'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="card">
        <h3>Grafik Total Distribusi per Komoditas</h3>
        <canvas id="grafikDistribusi" width="600" height="300"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('grafikDistribusi').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($grafik, 'komoditas')) ?>,
        datasets: [{
            label: 'Total Distribusi (kg)',
            data: <?= json_encode(array_column($grafik, 'total_kg')) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Kilogram (kg)'
                }
            }
        }
    }
});
</script>
</body>
</html>
