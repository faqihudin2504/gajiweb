<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - GajiWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { background-color: #f4f6f9; overflow-x: hidden; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* --- CSS Sidebar (Sudah dengan perbaikan responsive overlay) --- */
        .sidebar { 
            background-color: #673ab7; 
            min-height: 100vh; 
            width: 250px; 
            min-width: 250px; 
            color: #fff; 
            transition: all 0.3s ease-in-out; 
            z-index: 1040; 
        }
        .sidebar.toggled { margin-left: -250px; }
        .sidebar .brand { background-color: #512da8; padding: 15px 20px; font-weight: bold; font-size: 1.2rem; }
        .sidebar-menu { padding: 0; list-style: none; }
        .sidebar-menu li.menu-header { padding: 10px 20px; font-size: 0.8rem; color: #d1c4e9; text-transform: uppercase; margin-top: 10px; }
        .sidebar-menu a { color: #ede7f6; text-decoration: none; padding: 12px 20px; display: block; font-size: 0.95rem; }
        .sidebar-menu a i { width: 25px; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background-color: #7e57c2; color: #fff; border-left: 4px solid #fff; }
        
        /* --- CSS Topbar & Konten --- */
        .topbar { background-color: #512da8; padding: 12px 20px; color: white; }
        .content-wrapper { padding: 30px; transition: all 0.3s ease; }
        .card { border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05); border-radius: 8px; }
        
        @media (max-width: 768px) {
            .sidebar { 
                position: fixed; 
                top: 0;
                left: 0;
                height: 100vh;
                margin-left: -250px; 
                box-shadow: 5px 0 15px rgba(0,0,0,0.3); 
            }
            .sidebar.toggled { margin-left: 0; }
            .flex-grow-1 { min-width: 100vw; }
            .content-wrapper { padding: 15px; } 
        }
    </style>
</head>
<body>
    <div class="d-flex">
        
        <!-- SIDEBAR -->
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
            
            <!-- TOP NAVBAR (SUDAH DISAMAKAN DENGAN DASHBOARD KESELURUHAN) -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <!-- ID btnToggle sudah ditambahkan di sini -->
                <div><i class="fas fa-bars fs-5" id="btnToggle" style="cursor: pointer;"></i></div>
                
                <div class="dropdown">
                    <div class="d-flex align-items-center dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                        <i class="fas fa-user-circle fs-3 me-2"></i>
                        <span class="fw-bold text-uppercase" style="font-size: 0.9rem;">{{ Auth::user()->username }}</span>
                    </div>
                    
                    <ul class="dropdown-menu dropdown-menu-end shadow mt-2" style="width: 250px;">
                        <li class="text-center py-3 border-bottom">
                            <i class="fas fa-user-circle text-secondary" style="font-size: 4rem;"></i>
                            <h6 class="mt-2 mb-0 fw-bold text-uppercase">{{ Auth::user()->username }}</h6>
                            <small class="text-muted">{{ Auth::user()->email }}</small>
                        </li>
                        <li><a class="dropdown-item py-2 mt-2" href="{{ route('profile') }}"><i class="fas fa-user me-2"></i> Profile ku</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="fas fa-power-off me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- KONTEN PROFIL YANG SUDAH DI-REVAMP ESTETIKNYA -->
            <div class="content-wrapper">
                <h4 class="mb-4 text-secondary"><i class="fas fa-cog me-2"></i> Pengaturan Akun</h4>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm"><i class="fas fa-check-circle me-2"></i> {{ session('success') }} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- Kolom Kiri: Kartu Identitas Visual -->
                    <div class="col-md-4 mb-4">
                        <div class="card p-4 text-center h-100">
                            <i class="fas fa-user-circle text-secondary mx-auto mb-3" style="font-size: 6rem;"></i>
                            <h5 class="fw-bold text-uppercase mb-1">{{ Auth::user()->username }}</h5>
                            <p class="text-muted mb-3">{{ Auth::user()->email }}</p>
                            <span class="badge bg-primary w-50 mx-auto py-2">Administrator</span>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Pengaturan Lengkap -->
                    <div class="col-md-8">
                        <div class="card p-4">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <h6 class="fw-bold mb-3 border-bottom pb-2 text-primary">Informasi Dasar</h6>
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="form-label text-muted">Email (Terkunci)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <h6 class="fw-bold mb-3 mt-4 border-bottom pb-2 text-primary">Keamanan Sandi</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-danger">Password Saat Ini *</label>
                                    <div class="input-group">
                                        <span class="input-group-text text-danger"><i class="fas fa-key"></i></span>
                                        <input type="password" name="current_password" class="form-control border-danger" placeholder="Wajib diisi untuk menyimpan perubahan" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label class="form-label fw-bold">Password Baru (Opsional)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Konfirmasi Password Baru</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password baru">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-2"></i> Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- SCRIPT WAJIB UNTUK BOOTSTRAP & HAMBURGER MENU -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btnToggle = document.getElementById('btnToggle');
            const sidebar = document.querySelector('.sidebar');

            if(btnToggle) {
                btnToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('toggled');
                });
            }
        });
    </script>
</body>
</html>