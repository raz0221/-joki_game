<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAFTAP.Joki - {{ $title ?? 'Autentikasi' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #212529 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .brand-text {
            font-weight: 700;
            letter-spacing: 1px;
            color: white !important;
            text-align: center;
            margin-bottom: 30px;
        }
        .brand-highlight {
            color: #ffd700;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="brand-text">
            <span class="brand-highlight">HAFTAP</span>.Joki
        </h1>
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>