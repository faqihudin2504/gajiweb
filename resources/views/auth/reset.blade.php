<!DOCTYPE html>
<html lang="id">
<head>
    <title>Reset Password - GajiWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #d1c4e9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { background-color: #9fa8da; border: none; border-radius: 10px; width: 100%; max-width: 400px; padding: 40px; }
        .form-control { background-color: #e0e0e0; border: none; padding: 12px; }
        .btn-custom { background-color: #e0e0e0; border: none; font-weight: bold; padding: 10px; }
    </style>
</head>
<body>
    <div class="card-login text-center">
        <h5 class="text-white mb-4">Buat Password Baru</h5>
        
        @if ($errors->any())
            <div class="alert alert-danger py-2"><small>Password tidak cocok atau kurang dari 6 karakter.</small></div>
        @endif

        <form action="{{ route('reset.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="password" name="password" class="form-control text-center" placeholder="Password Baru" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password_confirmation" class="form-control text-center" placeholder="Konfirmasi Password Baru" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Simpan Password</button>
        </form>
    </div>
</body>
</html>