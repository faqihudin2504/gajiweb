<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GajiWeb Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #d1c4e9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { background-color: #9fa8da; border: none; border-radius: 10px; width: 100%; max-width: 400px; padding: 40px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .brand-logo { background-color: #512da8; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; font-size: 1.5rem; text-align: center; display: inline-block; margin-bottom: 20px; }
        .form-control { background-color: #e0e0e0; border: none; padding: 12px; }
        .btn-custom { background-color: #e0e0e0; border: none; color: #333; font-weight: bold; padding: 10px; }
    </style>
</head>
<body>

    <div class="card-login text-center">
        <div class="brand-logo">
            <i class="fas fa-cubes me-2"></i> GajiWeb
        </div>
        <h6 class="text-white mb-3">Buat Akun Admin</h6>

        @if ($errors->any())
            <div class="alert alert-danger py-2 text-start" style="font-size: 0.85rem;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control text-center" placeholder="Nama Lengkap" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control text-center" placeholder="Alamat Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="username" class="form-control text-center" placeholder="Username (Untuk Tampilan)" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control text-center" placeholder="Password (Min. 6 Karakter)" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password_confirmation" class="form-control text-center" placeholder="Konfirmasi Password" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Daftar</button>
                <a href="{{ route('login') }}" class="text-white mt-2 text-decoration-none" style="font-size: 0.85rem;">Sudah punya akun? Masuk di sini</a>
            </div>
        </form>
    </div>

</body>
</html>