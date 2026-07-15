<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penggajian - Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        /* CSS Kustom untuk meniru tema warna ungu (Jagowebdev) di gambar */
        body { background-color: #f4f6f9; overflow-x: hidden; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Styling Sidebar */
        .sidebar { background-color: #673ab7; min-height: 100vh; color: #fff; transition: 0.3s; }
        .sidebar .brand { background-color: #512da8; padding: 15px 20px; font-weight: bold; font-size: 1.2rem; }
        .sidebar-menu { padding: 0; list-style: none; }
        .sidebar-menu li.menu-header { padding: 10px 20px; font-size: 0.8rem; color: #d1c4e9; text-transform: uppercase; margin-top: 10px; }
        .sidebar-menu a { color: #ede7f6; text-decoration: none; padding: 12px 20px; display: block; font-size: 0.95rem; }
        .sidebar-menu a i { width: 25px; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background-color: #7e57c2; color: #fff; border-left: 4px solid #fff; }
        
        /* Styling Navbar & Konten */
        .topbar { background-color: #512da8; padding: 12px 20px; color: white; }
        .content-wrapper { padding: 30px; }
        .card { border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05); border-radius: 8px; }
        
        /* Modifikasi Tombol Aksi */
        .btn-edit { background-color: #28a745; color: white; border: none; }
        .btn-delete { background-color: #dc3545; color: white; border: none; }

        /* Animasi Hamburger Menu */
        .sidebar { width: 250px; transition: margin 0.3s ease-out; z-index: 1000; }
        .sidebar.toggled { margin-left: -250px; }

        /* Responsif untuk layar HP/Tablet kecil */
        @media (max-width: 768px) {
        .sidebar { margin-left: -250px; position: absolute; }
        .sidebar.toggled { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        
        <div class="sidebar" style="width: 250px;">
            <div class="brand">
                <i class="fas fa-cubes me-2"></i> GajiWeb
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Menu Utama</li>            
                <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>                
                <li><a href="{{ route('karyawan.index') }}"><i class="fas fa-users"></i> Data Karyawan</a></li>                            
                <li><a href="{{ route('penggajian.index') }}" class="{{ request()->routeIs('penggajian.*') ? 'active' : '' }}"><i class="fas fa-table"></i> Data Penggajian</a></li>               
            </ul>
        </div>

        <div class="flex-grow-1">
            
            <div class="topbar d-flex justify-content-between align-items-center">
                <div>
                   <div><i class="fas fa-bars fs-5" id="btnToggle" style="cursor: pointer;"></i></div>
                </div>
                <div>
                    <i class="fas fa-user-circle fs-4" style="cursor: pointer;"></i>
                </div>
            </div>

            <div class="content-wrapper">
                <h4 class="mb-4 text-secondary">Data Penggajian</h4>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card p-4">
                    <div class="mb-4">
                        <a href="{{ route('penggajian.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Data
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table id="gajiTable" class="table table-bordered table-striped table-hover align-middle w-100">
                            <thead class="table-light">
                                <tr class="text-center text-muted">
                                    <th width="5%">No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Total Gaji</th>
                                    <th width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataGaji as $index => $gaji)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    
                                    <td>
                                        <i class="fas fa-user-circle fs-3 text-secondary me-2 align-middle"></i> 
                                        {{ $gaji->karyawan->nama_karyawan ?? 'Data Terhapus' }}
                                    </td>
                                    <td>{{ $gaji->karyawan->jabatan ?? '-' }}</td>
                                    
                                    <td>Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($gaji->tunjangan, 0, ',', '.') }}</td>
                                    <td class="text-success fw-bold">Rp {{ number_format($gaji->total_gaji, 0, ',', '.') }}</td>
                                    
                                    <td class="text-center">
                                        <a href="{{ route('penggajian.edit', $gaji->id) }}" class="btn btn-edit btn-sm">
                                            <i class="fas fa-edit"></i> Edit Data
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#gajiTable').DataTable({
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries"
                }
            });
        });
    </script>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnToggle = document.getElementById('btnToggle');
        const sidebar = document.querySelector('.sidebar');

        if(btnToggle) {
            btnToggle.addEventListener('click', function() {
                // Menambahkan atau menghapus class 'toggled' setiap kali diklik
                sidebar.classList.toggle('toggled');
            });
        }
    });
</script>
</html>