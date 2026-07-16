<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f6f9; overflow-x: hidden; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* --- CSS Sidebar Default (Desktop) --- */
        .sidebar { 
            background-color: #673ab7; 
            min-height: 100vh; 
            width: 250px; 
            min-width: 250px; /* Cegah sidebar menyusut */
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
        
        /* Modifikasi Tombol */
        .btn-edit { background-color: #28a745; color: white; border: none; }
        .btn-delete { background-color: #dc3545; color: white; border: none; }
        
        /* ========================================================
           PERBAIKAN BUG RESPONSIVE (Split Screen / Layar HP) 
           ======================================================== */
        @media (max-width: 768px) {
            .sidebar { 
                position: fixed; /* Sidebar melayang di atas konten */
                top: 0;
                left: 0;
                height: 100vh;
                margin-left: -250px; 
                box-shadow: 5px 0 15px rgba(0,0,0,0.3); /* Tambahkan bayangan agar timbul */
            }
            .sidebar.toggled { margin-left: 0; }
            
            /* Paksa area konten tetap 100% dari lebar layar agar form tidak gepeng */
            .flex-grow-1 { min-width: 100vw; }
            .content-wrapper { padding: 15px; } /* Kurangi jarak padding di layar sempit */
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <div class="brand"><i class="fas fa-cubes me-2"></i> GajiWeb</div>
            <ul class="sidebar-menu">
                <li class="menu-header">Menu Utama</li>
                <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('karyawan.index') }}" class="active"><i class="fas fa-users"></i> Data Karyawan</a></li>
                <li><a href="{{ route('penggajian.index') }}"><i class="fas fa-table"></i> Data Penggajian</a></li>
            </ul>
        </div>

        <div class="flex-grow-1">
            <div class="topbar d-flex justify-content-between align-items-center">
                <div><i class="fas fa-bars fs-5" id="btnToggle" style="cursor: pointer;"></i></div>
                <div><i class="fas fa-user-circle fs-4"></i></div>
            </div>

            <div class="content-wrapper">
                <h4 class="mb-4 text-secondary">Edit Data Karyawan</h4>

                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card p-4 col-lg-8">
                    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" name="nama_karyawan" class="form-control" value="{{ $karyawan->nama_karyawan }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jabatan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                <input type="text" name="jabatan" class="form-control" value="{{ $karyawan->jabatan }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">No. Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" name="no_telp" class="form-control" value="{{ $karyawan->no_telp }}">
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt me-1"></i> Perbarui</button>
                            <a href="{{ route('karyawan.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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