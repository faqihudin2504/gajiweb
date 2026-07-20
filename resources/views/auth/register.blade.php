<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GajiWeb - Buat Akun Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            /* Menggunakan gradasi warna agar lebih modern */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-login { 
            background-color: #ffffff; /* Card putih agar form lebih jelas */
            border: none; 
            border-radius: 15px; 
            width: 100%; 
            max-width: 450px; 
            padding: 40px 30px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
        }
        .brand-logo { 
            background-color: #512da8; 
            color: white; 
            padding: 12px 25px; 
            border-radius: 8px; 
            font-weight: 700; 
            font-size: 1.8rem; 
            display: inline-block; 
            margin-bottom: 25px; 
            letter-spacing: 1px;
        }
        .form-control { 
            background-color: #f8f9fa; 
            border: 1px solid #ced4da; 
            padding: 12px 15px; 
            border-radius: 8px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #512da8;
            box-shadow: 0 0 0 0.2rem rgba(81, 45, 168, 0.25);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }
        .btn-custom { 
            background-color: #512da8; 
            border: none; 
            color: #fff; 
            font-weight: bold; 
            padding: 12px; 
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            background-color: #4527a0;
            color: #fff;
            transform: translateY(-2px);
        }
        .login-link {
            color: #512da8;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        .login-link:hover {
            color: #311b92;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="card-login text-center">
        <div class="brand-logo">
            <i class="fas fa-cubes me-2"></i> GajiWeb
        </div>
        <h5 class="mb-4 text-dark fw-bold">Buat Akun Admin</h5>

        <!-- Menampilkan Error Validasi (Tidak diubah) -->
        @if ($errors->any())
            <div class="alert alert-danger py-2 text-start" style="font-size: 0.85rem; border-radius: 8px;">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Action & Method (Tidak diubah) -->
        <form action="{{ route('register.post') }}" method="POST" class="text-start">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap Anda" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Nama Pengguna</label>
                <input type="text" name="username" class="form-control" placeholder="Untuk Tampilan Akun" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Alamat Email Anda" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Kata Sandi</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 Karakter" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang kata sandi" required>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-custom">Daftar Sekarang</button>
            </div>
            
            <div class="text-center mt-3">
                <span class="text-secondary" style="font-size: 0.9rem;">Sudah punya akun?</span>
                <a href="{{ route('login') }}" class="login-link" style="font-size: 0.9rem;">Masuk di sini</a>
            </div>
        </form>
    </div>

</body>
</html>