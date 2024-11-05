<?php
session_start(); // Pastikan session dimulai
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $candidate_id = $_POST['candidate_id'];
    $nim = $_POST['nim']; // Dapatkan NIM dari formulir

    // Cek apakah pengguna sudah memberikan suara
    $stmtCheckVote = $conn->prepare("SELECT voted FROM users WHERE nim = ?");
    $stmtCheckVote->bind_param("s", $nim);
    $stmtCheckVote->execute();
    $resultCheck = $stmtCheckVote->get_result();

    if ($resultCheck->num_rows === 1) {
        $user = $resultCheck->fetch_assoc();
        
        if ($user['voted']) {
            // Jika pengguna sudah memberikan suara, tampilkan notifikasi
            echo "<script>alert('Tidak boleh curang yah dik, Kamu sudah sudah vote!'); window.location.href = 'logout.php';</script>";
            exit();
        }
    }

    // Menyimpan suara ke database
    $sqlVote = "UPDATE candidates SET votes = votes + 1 WHERE id = ?";
    $stmtVote = $conn->prepare($sqlVote);
    $stmtVote->bind_param("i", $candidate_id);

    if ($stmtVote->execute()) {
        // Update nilai vote di tabel users
        $sqlUpdateVote = "UPDATE users SET voted = 1 WHERE nim = ?";
        $stmtUpdateVote = $conn->prepare($sqlUpdateVote);
        $stmtUpdateVote->bind_param("s", $nim);

        if ($stmtUpdateVote->execute()) {
            echo "<script>alert('Terima kasih telah memberikan suara!'); window.location.href = 'thank_you.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat memperbarui data suara: " . $conn->error . "'); window.location.href = 'vote.php';</script>";
        }
        $stmtUpdateVote->close();
    } else {
        echo "<script>alert('Terjadi kesalahan saat mencatat suara: " . $conn->error . "'); window.location.href = 'vote.php';</script>";
    }
    $stmtVote->close();
    $stmtCheckVote->close();
}

$conn->close();
?>
