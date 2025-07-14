<?php
require_once '../config/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>TaniSupply - Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f7f8;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #2c3e50;
      color: white;
      padding: 30px 20px;
      text-align: center;
    }
    .container {
      max-width: 800px;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h1 {
      margin-top: 0;
    }
    p {
      color: #555;
    }
    nav ul {
      list-style: none;
      padding: 0;
      margin-top: 30px;
    }
    nav ul li {
      margin-bottom: 15px;
    }
    nav ul li a {
      display: block;
      background-color: #3498db;
      color: white;
      padding: 12px 20px;
      text-align: center;
      text-decoration: none;
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }
    nav ul li a:hover {
      background-color: #2980b9;
    }
    footer {
      text-align: center;
      color: #888;
      font-size: 14px;
      margin-top: 40px;
      padding-bottom: 20px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Selamat Datang di TaniSupply</h1>
    <p>Aplikasi Manajemen Distribusi Hasil Pertanian</p>
  </header>

  <div class="container">
    <h2>Menu Utama</h2>
    <nav>
      <ul>
        <li><a href="petani/index.php">📋 Data Petani</a></li>
        <li><a href="panen/index.php">🌾 Data Panen</a></li>
        <li><a href="pembeli/index.php">🧑‍💼 Data Pembeli</a></li>
        <li><a href="distribusi/index.php">🚚 Distribusi</a></li>
        <li><a href="laporan/index.php">📊 Laporan</a></li>
      </ul>
    </nav>
  </div>

  <footer>
    &copy; <?= date("Y") ?> TaniSupply. All rights reserved.
  </footer>
</body>
</html>
