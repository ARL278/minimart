<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $kategori    = $_POST['kategori'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $deskripsi   = $_POST['deskripsi'];

    // Handle Upload Gambar
    $nama_gambar = $_FILES['gambar']['name'];
    $lokasi_tmp  = $_FILES['gambar']['tmp_name'];
    $folder      = "uploads/";

    // Pastikan folder uploads ada, jika belum buat otomatis
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    if (!empty($nama_gambar)) {
        move_uploaded_file($lokasi_tmp, $folder . $nama_gambar);
        
        // Simpan ke database
        $query = "INSERT INTO products (nama_produk, kategori, harga, stok, deskripsi, gambar) 
                  VALUES ('$nama_produk', '$kategori', '$harga', '$stok', '$deskripsi', '$nama_gambar')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>alert('Produk berhasil ditambahkan!'); window.location='tambah_produk.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan produk!');</script>";
        }
    } else {
        echo "<script>alert('Gambar produk wajib diunggah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk - MiniMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tambah Produk Baru (Admin)</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Produk</label>
                                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" name="gambar" class="form-control" accept=".jpg, .jpeg, .png" required>
                                <small class="text-muted">Format yang diizinkan: .jpg, .png</small>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success w-100">Simpan Produk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>