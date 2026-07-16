<!DOCTYPE html>
<html lang="id">
<head>
    <title>Verifikasi OTP - GajiWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #d1c4e9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { background-color: #9fa8da; border: none; border-radius: 10px; width: 100%; max-width: 400px; padding: 40px; }
        .form-control { background-color: #e0e0e0; border: none; padding: 12px; letter-spacing: 5px; font-size: 1.2rem;}
        .btn-custom { background-color: #e0e0e0; border: none; font-weight: bold; padding: 10px; }
    </style>
</head>
<body>
    <div class="card-login text-center">
        <h5 class="text-white mb-3">Verifikasi OTP</h5>
        
        @if (session('success'))
            <div class="alert alert-success py-2"><strong>{{ session('success') }}</strong></div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger py-2">{{ session('error') }}</div>
        @endif

        <form action="{{ route('verify.otp.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <input type="number" name="otp" class="form-control text-center" placeholder="------" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Verifikasi</button>
        </form>
    </div>
</body>
</html>