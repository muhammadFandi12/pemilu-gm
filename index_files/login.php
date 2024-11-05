<?php
session_start();
include 'db.php'; // Koneksi database

$notification = ''; // Untuk menampung pesan notifikasi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form dan melakukan sanitasi
    $nim = htmlspecialchars(trim($_POST['nim']));
    $redeem_code = htmlspecialchars(trim($_POST['redeem_code']));

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE nim = ?");
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Memeriksa apakah redeem code cocok tanpa hashing
        if ($redeem_code === $user['redeem_code']) {
            $_SESSION['nim'] = $nim;
            header("Location: vote.php");
            exit();
        } else {
            $notification = "Redeem Code salah!";
        }
    } else {
        $notification = "NIM tidak ditemukan!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Pemilu GM 2024</title>
  <link rel="stylesheet" href="styles.css">
  <script>
    window.onload = function() {
      // Menampilkan notifikasi jika ada
      <?php if ($notification): ?>
        alert("<?php echo addslashes($notification); ?>");
      <?php endif; ?>
    };
  </script>
</head>
<body>
  <div class="container">
    <!-- Bagian Kiri: Logo -->
    <div class="logo-section">
      <img src="img/epicentrum-logo.jpeg" alt="Epicentrum Logo" class="logo">
    </div>
    
    <!-- Bagian Kanan: Form Login -->
    <div class="login-section">
      <h2>Login Pemilu GM 2024</h2>
      <form action="" method="post">
        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" required placeholder="Masukkan NIM">

        <label for="redeem_code">Redeem Code</label>
        <input type="text" id="redeem_code" name="redeem_code" required placeholder="Masukkan Redeem Code">

        <button type="submit">Login</button>
      </form>
      <p>Belum punya akun? <a href="register.html" class="register-link">Daftar di sini</a></p>
    </div>
  </div>
</body>
</html>
