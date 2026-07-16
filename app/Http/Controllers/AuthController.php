<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // TAMPILAN & PROSES LOGIN (Pakai Email)
    public function showLogin() { return view('auth.login'); }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // TAMPILAN & PROSES REGISTER
    public function showRegister() { return view('auth.register'); }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // TAMPILAN & PROSES UPDATE PROFIL
    public function showProfile()
    {
        return view('auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|current_password',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->username = $request->username;
        
        // Hanya ubah password jika kolom password diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // PROSES LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // --- FITUR LUPA PASSWORD (SIMULASI OTP) ---

    public function showForgot() { return view('auth.forgot'); }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        
        // Buat 6 angka acak
        $otp = rand(100000, 999999);
        
        // Simpan ke session
        session(['otp' => $otp, 'reset_email' => $request->email]);

        // Trik Presentasi: Munculkan OTP di alert sukses agar mudah didemokan
        return redirect()->route('verify.otp')->with('success', "Simulasi Email: Kode OTP Anda adalah $otp");
    }

    public function showVerifyOtp() 
    { 
        if(!session('reset_email')) return redirect()->route('forgot');
        return view('auth.verify-otp'); 
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        if ($request->otp == session('otp')) {
            session(['otp_verified' => true]); // Tandai lolos verifikasi
            return redirect()->route('reset');
        }

        return back()->with('error', 'Kode OTP tidak valid!');
    }

    public function showReset() 
    { 
        if(!session('otp_verified')) return redirect()->route('forgot');
        return view('auth.reset'); 
    }

    public function resetPassword(Request $request)
    {
        $request->validate(['password' => 'required|min:6|confirmed']);

        // Update password berdasarkan email yang ada di session
        $user = User::where('email', session('reset_email'))->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Bersihkan session
        session()->forget(['otp', 'reset_email', 'otp_verified']);

        return redirect()->route('login')->with('success', 'Password berhasil direset! Silakan login.');
    }
}