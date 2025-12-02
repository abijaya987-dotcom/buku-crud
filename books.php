<?php
require_once __DIR__ . '/class/Database.php';
require_once __DIR__ . '/class/Utility.php';

$db = new Database();
$pdo = $db->pdo;

// ambil data buku
$stmt = $pdo->query("SELECT * FROM books ORDER BY id DESC");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f5f5f5;
    }
  </style>
</head>

<body class="container mt-5">

  <?php Utility::showFlash(); ?>

  <!-- Judul halaman -->
  <h3 class="text-center mb-4">Daftar Buku Perpustakaan</h3>

  <!-- Tombol tambah buku -->
  <div class="text-center mb-3">
    <a href="create.php" class="btn btn-primary">+ Tambah Buku</a>
  </div>

  <!-- Tabel buku -->
  <div class="card shadow border-0">
    <div class="card-body p-3">

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark text-center">
            <tr>
              <th>Cover</th>
              <th class="text-start">Judul</th>
              <th>Penulis</th>
              <th>Tahun</th>
              <th>Kategori</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody class="text-center">
            <?php foreach ($books as $book): ?>
            <tr>

              <!-- Cover -->
              <td>
                <?php if ($book['cover_path']): ?>
                  <img src="<?= $book['cover_path'] ?>" width="50">
                <?php else: ?>
                  <span>-</span>
                <?php endif; ?>
              </td>

              <!-- Judul -->
              <td class="text-start"><?= htmlspecialchars($book['title']) ?></td>

              <!-- Penulis -->
              <td><?= htmlspecialchars($book['author']) ?></td>

              <!-- Tahun -->
              <td><?= $book['year_published'] ?></td>

              <!-- Kategori -->
              <td><?= $book['category'] ?></td>

              <!-- Status -->
              <td>
                <?= ucfirst($book['status']) ?>
              </td>

              <!-- Aksi -->
              <td>
                <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-danger"
                   onclick="return confirm('Yakin hapus buku ini?')">Hapus</a>
              </td>

            </tr>
            <?php endforeach; ?>
          </tbody>

        </table>
      </div>

    </div>
  </div>

 

</body>
</html>
