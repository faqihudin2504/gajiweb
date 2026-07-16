<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penggajian - Dashboard Utama</title>
    
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
            <div class="brand">
                <i class="fas fa-cubes me-2"></i> GajiWeb
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Menu Utama</li>
                <li><a href="{{ route('dashboard') }}" class="active"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('karyawan.index') }}"><i class="fas fa-users"></i> Data Karyawan</a></li>
                <li><a href="{{ route('penggajian.index') }}"><i class="fas fa-table"></i> Data Penggajian</a></li>
            </ul>
        </div>

        <div class="flex-grow-1">
            
            <div class="topbar d-flex justify-content-between align-items-center">
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

            <div class="content-wrapper">
                <h4 class="mb-4 text-secondary"><i class="fas fa-tachometer-alt me-2"></i> Dashboard Overview</h4>

                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card bg-primary text-white h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50">Total Karyawan</h6>
                                    <h3 class="mb-0">{{ $totalKaryawan }} <span class="fs-6">Orang</span></h3>
                                </div>
                                <i class="fas fa-users fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-success text-white h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50">Total Pengeluaran Gaji</h6>
                                    <h4 class="mb-0">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
                                </div>
                                <i class="fas fa-wallet fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-info text-white h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-white-50">Rata-Rata Gaji</h6>
                                    <h4 class="mb-0">Rp {{ number_format($rataRataGaji, 0, ',', '.') }}</h4>
                                </div>
                                <i class="fas fa-chart-line fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card bg-warning text-dark h-100">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-black-50">Total Tunjangan</h6>
                                    <h4 class="mb-0">Rp {{ number_format($totalTunjangan, 0, ',', '.') }}</h4>
                                </div>
                                <i class="fas fa-hand-holding-usd fs-1 opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-4">
                    <h5 class="mb-3"><i class="fas fa-history me-2"></i> 5 Transaksi Penggajian Terbaru</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th>Waktu Input</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Total Gaji</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($gajiTerbaru as $gaji)
                                <tr>
                                    <td>{{ $gaji->created_at->format('d M Y - H:i') }}</td>
                                    <td><i class="fas fa-user-circle text-secondary me-2"></i> {{ $gaji->karyawan->nama_karyawan ?? 'Data Terhapus' }}</td>
                                    <td>{{ $gaji->karyawan->jabatan ?? '-' }}</td>
                                    <td class="text-success fw-bold">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada data penggajian.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-2">
                        <a href="{{ route('penggajian.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Data <i class="fas fa-arrow-right"></i></a>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>