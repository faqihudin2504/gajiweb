<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - GajiWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; overflow-x: hidden; font-family: 'Segoe UI', sans-serif; }
        .sidebar { background-color: #673ab7; min-height: 100vh; color: #fff; width: 250px; transition: 0.3s; }
        .sidebar .brand { background-color: #512da8; padding: 15px 20px; font-weight: bold; font-size: 1.2rem; }
        .sidebar-menu { padding: 0; list-style: none; }
        .sidebar-menu li.menu-header { padding: 10px 20px; font-size: 0.8rem; color: #d1c4e9; text-transform: uppercase; margin-top: 10px; }
        .sidebar-menu a { color: #ede7f6; text-decoration: none; padding: 12px 20px; display: block; }
        .sidebar-menu a i { width: 25px; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background-color: #7e57c2; border-left: 4px solid #fff; }
        .topbar { background-color: #512da8; padding: 12px 20px; color: white; }
        .content-wrapper { padding: 30px; }
        .card { border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05); border-radius: 8px; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <div class="brand"><i class="fas fa-cubes me-2"></i> GajiWeb</div>
            <ul class="sidebar-menu">
                <li class="menu-header">Menu Utama</li>
                <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('karyawan.index') }}"><i class="fas fa-users"></i> Data Karyawan</a></li>
                <li><a href="{{ route('penggajian.index') }}"><i class="fas fa-table"></i> Data Penggajian</a></li>
            </ul>
        </div>

        <div class="flex-grow-1">
            <div class="topbar d-flex justify-content-between align-items-center">
                <div><i class="fas fa-bars fs-5"></i></div>
                <div class="dropdown">
                    <div class="d-flex align-items-center dropdown-toggle" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fs-3 me-2"></i>
                        <span class="fw-bold text-uppercase">{{ Auth::user()->username }}</span>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow mt-2" style="width: 250px;">
                        <li><a class="dropdown-item py-2" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i> Profile ku</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger"><i class="fas fa-power-off me-2"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="content-wrapper">
                <h4 class="mb-4 text-secondary">Pengaturan Profil</h4>

                @if (session('success'))
                    <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i> {{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card p-4 col-lg-6">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Email (Tidak bisa diubah)</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ganti Username</label>
                            <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Password Saat Ini (Wajib diisi untuk menyimpan perubahan)</label>
                            <input type="password" name="current_password" class="form-control" placeholder="Masukkan password lama Anda" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Ganti Password (Opsional)</label>
                            <input type="password" name="password" class="form-control" placeholder="Isi jika ingin mengganti password">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password baru">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>