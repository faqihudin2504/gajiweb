<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GajiWeb Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #d1c4e9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { background-color: #9fa8da; border: none; border-radius: 10px; width: 100%; max-width: 400px; padding: 40px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .brand-logo { background-color: #512da8; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; font-size: 1.5rem; text-align: center; display: inline-block; margin-bottom: 30px; }
        .form-control { background-color: #e0e0e0; border: none; padding: 12px; }
        .btn-custom { background-color: #e0e0e0; border: none; color: #333; font-weight: bold; padding: 10px; transition: 0.3s; }
        .btn-custom:hover { background-color: #bdbdbd; }
    </style>
</head>
<body>

    <div class="card-login text-center">
        <div class="brand-logo">
            <i class="fas fa-cubes me-2"></i> GajiWeb
        </div>

        @if (session('error'))
            <div class="alert alert-danger py-2">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success py-2">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <h6 class="text-start text-white mb-3">Email</h6>
            <div class="mb-3">
                <input type="email" name="email" class="form-control text-center" placeholder="Masukkan Email" required>
            </div>
            <h6 class="text-start text-white mb-3">Password</h6>
            <div class="mb-3">
                <input type="password" name="password" class="form-control text-center" placeholder="Masukkan Password" required>
            </div>
            
            <div class="text-end mb-4">
                <a href="{{ route('forgot') }}" class="text-white text-decoration-none" style="font-size: 0.85rem;">Lupa Password?</a>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Masuk</button>
                <a href="{{ route('register') }}" class="btn btn-secondary">Daftar</a>
            </div>
        </form>
    </div>

</body>
</html>