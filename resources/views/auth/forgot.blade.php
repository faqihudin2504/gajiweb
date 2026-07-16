<!DOCTYPE html>
<html lang="id">
<head>
    <title>Lupa Password - GajiWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #d1c4e9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { background-color: #9fa8da; border: none; border-radius: 10px; width: 100%; max-width: 400px; padding: 40px; }
        .form-control { background-color: #e0e0e0; border: none; padding: 12px; }
        .btn-custom { background-color: #e0e0e0; border: none; color: #333; font-weight: bold; padding: 10px; }
    </style>
</head>
<body>
    <div class="card-login text-center">
        <h5 class="text-white mb-4">Lupa Password</h5>
        
        @if ($errors->any())
            <div class="alert alert-danger py-2"><small>Email tidak ditemukan di sistem.</small></div>
        @endif

        <form action="{{ route('forgot.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="email" name="email" class="form-control text-center" placeholder="Masukkan Email Akun Anda" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom">Kirim Kode OTP</button>
                <a href="{{ route('login') }}" class="text-white mt-2 text-decoration-none" style="font-size: 0.85rem;">Kembali ke Login</a>
            </div>
        </form>
    </div>
</body>
</html>