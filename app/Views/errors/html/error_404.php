

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 - Halaman Tidak Ditemukan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            margin:0;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f8f9fa;
            font-family:Arial, Helvetica, sans-serif;
        }

        .error-page{
            text-align:center;
        }

        .error-code{
            font-size:120px;
            font-weight:700;
            color:#0d6efd;
            margin-bottom:0;
            line-height:1;
        }

        .error-title{
            font-size:32px;
            font-weight:600;
            margin-top:10px;
        }

        .error-text{
            color:#6c757d;
            margin:20px 0 30px;
        }
    </style>
</head>
<body>

<div class="error-page">

    <h1 class="error-code">404</h1>

    <h2 class="error-title">
        Halaman Tidak Ditemukan
    </h2>

    <p class="error-text">
        Maaf, halaman yang Anda cari tidak tersedia atau sudah dipindahkan.
    </p>

    <a href="<?= base_url('/') ?>" class="btn btn-primary">
        Kembali ke Dashboard
    </a>

</div>

</body>
</html> 