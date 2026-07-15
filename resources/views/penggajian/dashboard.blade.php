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
        
        /* Styling Sidebar & Topbar */
        .sidebar { background-color: #673ab7; min-height: 100vh; color: #fff; transition: margin 0.3s ease-out; z-index: 1000; width: 250px; }
        .sidebar.toggled { margin-left: -250px; }
        .sidebar .brand { background-color: #512da8; padding: 15px 20px; font-weight: bold; font-size: 1.2rem; }
        .sidebar-menu { padding: 0; list-style: none; }
        .sidebar-menu li.menu-header { padding: 10px 20px; font-size: 0.8rem; color: #d1c4e9; text-transform: uppercase; margin-top: 10px; }
        .sidebar-menu a { color: #ede7f6; text-decoration: none; padding: 12px 20px; display: block; font-size: 0.95rem; }
        .sidebar-menu a i { width: 25px; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background-color: #7e57c2; color: #fff; border-left: 4px solid #fff; }
        
        .topbar { background-color: #512da8; padding: 12px 20px; color: white; }
        .content-wrapper { padding: 30px; }
        .card { border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05); border-radius: 8px; }
        
        /* Responsif Sidebar */
        @media (max-width: 768px) {
            .sidebar { margin-left: -250px; position: absolute; }
            .sidebar.toggled { margin-left: 0; }
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
                <div><i class="fas fa-user-circle fs-4" style="cursor: pointer;"></i></div>
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
</body>
</html>