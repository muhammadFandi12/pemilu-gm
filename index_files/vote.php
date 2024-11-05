<?php
session_start();
include 'db.php';

if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
    exit();
}

$nim = $_SESSION['nim'];

// Mendapatkan daftar kandidat
$sql = "SELECT * FROM candidates";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemilu GM 2024 - Pemungutan Suara</title>
  <link rel="stylesheet" href="vote.css">
</head>
<body>
  <div class="container">
    <h1>Pemilihan Kandidat GM 2024</h1>
    
    <form action="submit_vote.php" method="post">
      <input type="hidden" name="nim" value="<?php echo $nim; ?>"> <!-- NIM harus ada di sini -->
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="candidate">
          <img src="img/<?php echo $row['photo']; ?>" alt="<?php echo $row['name']; ?>" class="candidate-photo">
          <h2><?php echo $row['name']; ?></h2>
          <p><strong>Visi:</strong> <?php echo $row['vision']; ?></p>
          <p><strong>Misi:</strong> <?php echo $row['mission']; ?></p>
          <label>
            <input type="radio" name="candidate_id" value="<?php echo $row['id']; ?>" required>
            Pilih <?php echo $row['name']; ?>
          </label>
        </div>
      <?php endwhile; ?>
      <button type="submit" class="btn">Submit Vote</button>
    </form>
  </div>


</body>
</html>
