<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $redeem_code = $_POST['redeem_code'];

    // Periksa apakah NIM sudah ada
    $checkUser = $conn->query("SELECT * FROM users WHERE nim='$nim'");
    
    if ($checkUser->num_rows > 0) {
        // Kirim notifikasi ke frontend menggunakan JavaScript
        echo "<script>
                alert('NIM sudah terdaftar. Silakan login atau gunakan NIM lain.');
                window.location.href = 'register.html';
              </script>";
    } else {
        // Periksa apakah redeem code valid
        $checkRedeemCode = $conn->query("SELECT * FROM users WHERE redeem_code='$redeem_code'");
        
        if ($checkRedeemCode->num_rows > 0) {
            // Kirim notifikasi ke frontend
            echo "<script>
                    alert('Redeem code ini sudah digunakan.');
                    window.location.href = 'register.html';
                  </script>";
        } else {
            // Menyimpan pengguna baru ke database
            $sql = "INSERT INTO users (nim, redeem_code, voted) VALUES ('$nim', '$redeem_code', FALSE)";
            
            if ($conn->query($sql) === TRUE) {
                // Kirim notifikasi ke frontend
                echo "<script>
                        alert('Registrasi berhasil! Silakan login di sini.');
                        window.location.href = 'login.php'; // Redirect ke halaman login
                      </script>";
            } else {
                // Kirim notifikasi kesalahan ke frontend
                echo "<script>
                        alert('Terjadi kesalahan: " . $conn->error . "');
                      </script>";
            }
        }
    }
}
?>
