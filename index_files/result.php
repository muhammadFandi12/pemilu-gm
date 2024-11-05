<?php
include 'db.php';

$candidates = $conn->query("SELECT * FROM candidates ORDER BY votes DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Pemilu GM 2024</title>
  <link rel="stylesheet" href="result.css">
</head>
<body>
  <div class="container">
    <h1>Hasil Pemilu GM 2024</h1>
    <table>
      <tr>
        <th>Nama Kandidat</th>
        <th>Jumlah Suara</th>
      </tr>
      <?php while ($candidate = $candidates->fetch_assoc()): ?>
        <tr>
          <td><?= $candidate['name'] ?></td>
          <td><?= $candidate['votes'] ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>
