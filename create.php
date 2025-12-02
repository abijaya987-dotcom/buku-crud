<?php
require_once __DIR__ . '/class/Utility.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Tambah Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f5f5f5; }
    .card { border-radius: 12px; }
  </style>
</head>

<body class="container mt-5">

  <?php Utility::showFlash(); ?>

  <div class="card shadow border-0 mx-auto" style="max-width:600px;">
    <div class="card-body">

      <h4 class="text-center mb-4">Tambah Buku</h4>

      <form action="save.php" method="post" enctype="multipart/form-data">

        <div class="mb-2">
          <label>Judul Buku</label>
          <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Penulis</label>
          <input type="text" name="author" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Tahun Terbit</label>
          <input type="number" name="year_published" class="form-control" required>
        </div>

        <div class="mb-2">
          <label>Kategori</label>
          <select name="category" class="form-select" required>
            <option value="Fiksi">Fiksi</option>
            <option value="Nonfiksi">Nonfiksi</option>
            <option value="Referensi">Referensi</option>
          </select>
        </div>

        <div class="mb-2">
          <label>Status</label>
          <select name="status" class="form-select" required>
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
          </select>
        </div>

        <div class="mb-3">
          <label>Cover Buku</label>
          <input type="file" name="cover" class="form-control" accept="image/jpeg,image/png" required>
        </div>

        <div class="text-center">
          <a href="books.php" class="btn btn-secondary">Batal</a>
          <button class="btn btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>

  
</body>
</html>
