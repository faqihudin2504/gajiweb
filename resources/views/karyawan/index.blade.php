<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        body { background-color: #f4f6f9; overflow-x: hidden; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { background-color: #673ab7; min-height: 100vh; color: #fff; transition: 0.3s; width: 250px;}
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
        .btn-edit { background-color: #28a745; color: white; border: none; }
        .btn-delete { background-color: #dc3545; color: white; border: none; }
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
                <li><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('karyawan.index') }}" class="active"><i class="fas fa-users"></i> Data Karyawan</a></li>
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
                <h4 class="mb-4 text-secondary">Data Karyawan</h4>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card p-4">
                    <div class="mb-4">
                        <a href="{{ route('karyawan.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Karyawan
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table id="karyawanTable" class="table table-bordered table-striped table-hover align-middle w-100">
                            <thead class="table-light">
                                <tr class="text-center text-muted">
                                    <th width="5%">No</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>No. Telepon</th>
                                    <th width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataKaryawan as $index => $karyawan)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="fw-bold">{{ $karyawan->nama_karyawan }}</td>
                                    <td>{{ $karyawan->jabatan }}</td>
                                    <td>{{ $karyawan->no_telp ?? '-' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST" class="m-0">
                                            <a href="{{ route('karyawan.edit', $karyawan->id) }}" class="btn btn-edit btn-sm me-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Hapus karyawan ini? Data riwayat gajinya juga akan ikut terhapus!')">
                                                <i class="fas fa-times"></i> Delete
                                            </button>
                                        </form>
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
            $('#karyawanTable').DataTable();
            
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