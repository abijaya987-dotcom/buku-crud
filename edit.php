<?php
require_once __DIR__ . '/class/Database.php';
require_once __DIR__ . '/class/Utility.php'; // ini wajib agar Utility dikenali

$db = new Database();
$pdo = $db->pdo;

$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM books WHERE id=?");
$stmt->execute([$id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

// jika buku tidak ada, hentikan agar tidak error
if (!$book) {
    echo "<h4 class='text-center text-danger mt-5'>Buku tidak ditemukan!</h4>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    img:hover {
      transform: scale(1.2);
    }
  </style>
</head>

<body class="container mt-5">

  <h3 class="text-center mb-4">Edit Buku</h3>

  <?php Utility::showFlash(); ?>

  <div class="card p-4 mx-auto" style="max-width:700px;">
    <form action="update.php" method="post" enctype="multipart/form-data">

      <input type="hidden" name="id" value="<?= $book['id'] ?>">

      <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="title" class="form-control"
               value="<?= htmlspecialchars($book['title']) ?>" required>
      </div>

      <div class="mb-3">
        <label>Penulis</label>
        <input type="text" name="author" class="form-control"
               value="<?= htmlspecialchars($book['author']) ?>" required>
      </div>

      <div class="mb-3 row">
        <div class="col">
          <label>Tahun</label>
          <input type="number" name="year_published" class="form-control"
                 value="<?= $book['year_published'] ?>" required>
        </div>

        <div class="col">
          <label>Kategori</label>
          <select name="category" class="form-select" required>
            <option value="Fiksi" <?= $book['category']=="Fiksi"?"selected":"" ?>>Fiksi</option>
            <option value="Nonfiksi" <?= $book['category']=="Nonfiksi"?"selected":"" ?>>Nonfiksi</option>
            <option value="Referensi" <?= $book['category']=="Referensi"?"selected":"" ?>>Referensi</option>
          </select>
        </div>

        <div class="col">
          <label>Status</label>
          <select name="status" class="form-select" required>
            <option value="available" <?= $book['status']=="available"?"selected":"" ?>>Available</option>
            <option value="unavailable" <?= $book['status']=="unavailable"?"selected":"" ?>>Unavailable</option>
          </select>
        </div>
      </div>

      <div class="mb-3">
        <label>Cover Saat Ini</label><br>
        <?php if ($book['cover_path']): ?>
          <img src="<?= $book['cover_path'] ?>" width="100" class="border rounded">
        <?php else: ?>
          <span>Tidak ada cover</span>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label>Ganti Cover</label>
        <input type="file" name="cover" class="form-control" accept="image/jpeg,image/png">
      </div>

      <div class="text-end">
        <a href="books.php" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>

    </form>
  </div>

  
</body>
</html>
