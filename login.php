<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin'] = $username;
        header("Location: tambah_produk.php");
        exit;
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - MiniMart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #6f42c1 100%);
            height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        .btn-custom {
            background: linear-gradient(135deg, #0d6efd 0%, #6f42c1 100%);
            border: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

    <div class="card shadow-lg p-4" style="width: 380px;">
        <div class="text-center mb-4">
            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow" style="width: 60px; height: 60px;">
                <i class="bi bi-shop fs-3"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">Admin MiniMart</h4>
            <p class="text-muted small">Silakan login untuk mengelola toko</p>
        </div>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger alert-dismissible fade show py-2 small" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-1"></i> Username atau password salah!
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-semibold text-secondary">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-semibold text-secondary">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
            </div>
            <button type="submit" name="login" class="btn btn-custom w-100 py-2 shadow-sm">Masuk Dashboard</button>
        </form>
        
        <div class="text-center mt-3">
            <a href="index.php" class="text-decoration-none small text-muted"><i class="bi bi-arrow-left"></i> Kembali ke Beranda Toko</a>
        </div>
    </div>

</body>
</html>