<?php
require_once '../../config/db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM hasil_panen WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
