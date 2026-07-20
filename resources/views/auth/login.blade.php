<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GajiWeb - Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            /* Gradasi background yang sama dengan halaman register */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-login { 
            background-color: #ffffff; /* Card putih konsisten */
            border: none; 
            border-radius: 15px; 
            width: 100%; 
            max-width: 400px; 
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
        .text-link {
            color: #512da8;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        .text-link:hover {
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
        <h5 class="mb-4 text-dark fw-bold">Selamat Datang Kembali</h5>

        <!-- Notifikasi Session (Tidak diubah logikanya) -->
        @if (session('error'))
            <div class="alert alert-danger py-2 text-start" style="font-size: 0.85rem; border-radius: 8px;">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success py-2 text-start" style="font-size: 0.85rem; border-radius: 8px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="text-start">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" required>
            </div>
            
            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda" required>
            </div>
            
            <!-- Posisi Lupa Password dirapikan di kanan atas tombol -->
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('forgot') }}" class="text-link" style="font-size: 0.85rem;">Lupa Password?</a>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="submit" class="btn btn-custom">Masuk</button>
            </div>
            
            <!-- Link Daftar disesuaikan dengan form Register agar konsisten -->
            <div class="text-center mt-3">
                <span class="text-secondary" style="font-size: 0.9rem;">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="text-link" style="font-size: 0.9rem;">Daftar di sini</a>
            </div>
        </form>
    </div>

</body>
</html>