<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout Gagal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body { background: #f5f5f5; height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; }
        .card { padding: 50px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: none; }
        .icon-fail { font-size: 80px; color: #dc3545; }
        .btn-back { background: #6c757d; color: white; border-radius: 10px; padding: 10px 30px; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-fail"><i class="bi bi-x-circle-fill"></i></div>
        <h1 class="fw-bold mt-3">Checkout Gagal</h1>
        <p class="text-muted">Maaf, saldo tabunganmu belum mencukupi untuk membeli barang ini.</p>
        <div class="mt-4">
            <a href="dashboard.php" class="btn-back">Kembali</a>
        </div>
    </div>
</body>
</html>
