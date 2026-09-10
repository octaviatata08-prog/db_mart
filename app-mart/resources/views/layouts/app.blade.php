<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GITAOCMART - Auth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #fff0f5;
            font-family: sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-box { 
            width: 40px; height: 40px; 
            background: linear-gradient(135deg, #ff758c 0%, #d63384 100%); 
            border-radius: 12px; 
            display: flex; align-items: center; justify-content: center; 
            color: white; font-size: 20px; margin-right: 10px; 
        }
        .brand-text { font-size: 1.2rem; font-weight: 800; color: #333; }
        .brand-text span { color: #d63384; }

        .auth-card {
            border-radius: 20px;
            background: white;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(214, 51, 132, 0.15);
            max-width: 400px;
            width: 100%;
        }
        .text-pink { color: #d63384; }
        .btn-pink { background-color: #d63384; color: white; border-radius: 50px; font-weight: bold; }
        .btn-pink:hover { background-color: #b02a6b; color: white; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="text-center mb-4">
            <a href="/" class="d-inline-flex align-items-center text-decoration-none">
                <div class="logo-box"><i class="bi bi-bag-heart-fill"></i></div>
                <span class="brand-text">GITA<span>OCMART</span></span>
            </a>
        </div>

        @yield('content')
    </div>
</body>
</html>