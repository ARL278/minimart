<?php
include 'koneksi.php';

// Ambil keyword pencarian jika ada
$keyword = "";
if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $query = "SELECT * FROM products WHERE nama_produk LIKE '%$keyword%' OR kategori LIKE '%$keyword%' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM products ORDER BY id DESC";
}
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Produk - MiniMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar Sederhana -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">MiniMart</a>
            <div class="d-flex">
                <a href="tambah_produk.php" class="btn btn-light text-primary fw-bold">Tambah Produk (Admin)</a>
            </div>
        </div>
    </nav>

    <!-- Konten Katalog Produk -->
    <div class="container mt-4">
        <h2 class="mb-4 text-center">Katalog Produk Terbaru</h2>
        
        <!-- Form Pencarian Produk -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form action="" method="GET" class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari nama produk atau kategori..." value="<?php echo htmlspecialchars($keyword); ?>">
                    <button class="btn btn-outline-primary" type="submit" name="cari">Cari</button>
                    <?php if (!empty($keyword)) { ?>
                        <a href="index.php" class="btn btn-outline-secondary">Reset</a>
                    <?php } ?>
                </form>
            </div>
        </div>

        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="uploads/<?php echo $row['gambar']; ?>" class="card-img-top" alt="Gambar Produk" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $row['nama_produk']; ?></h5>
                                <p class="text-muted mb-1"><small>Kategori: <?php echo $row['kategori']; ?></small></p>
                                <p class="text-success fw-bold">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
                                <p class="card-text text-truncate"><?php echo $row['deskripsi']; ?></p>
                                <a href="#" class="btn btn-outline-primary mt-auto">Detail Produk</a>
                            </div>
                        </div>
                    </div>
            <?php 
                }
            } else {
                echo '<div class="col-12 text-center"><p class="text-muted">Produk tidak ditemukan.</p></div>';
            }
            ?>
        </div>
    </div>
</body>
</html>