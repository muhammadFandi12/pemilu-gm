<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Pemilu GM 2024</title>
    <link rel="stylesheet" href="thank_you.css"> <!-- Ganti dengan nama file CSS Anda -->
</head>
<body>
    <div class="container">
        <h1>Terima Kasih!</h1>
        <p>Anda telah berhasil memberikan suara untuk pemilihan GM 2024.</p>
        <p>Jika Anda ingin melihat hasil pemungutan suara atau informasi lebih lanjut, silakan kembali ke <a href="result.php">halaman pemungutan suara</a>.</p>
        <a href="login.php" class="btn">Logout</a> <!-- Tambahkan opsi logout jika diperlukan -->
    </div>
</body>
</html>
