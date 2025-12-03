<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Http\Controllers\UserOrderController; // WAJIB: Import Controller untuk Cart Logic

class AuthController extends Controller
{
    // =========================================================
    // 1. LOGIN ADMIN & PEGAWAI (Pintu Staff - Pakai USERNAME)
    // =========================================================

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi Username
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            // Redirect Pintar (menggunakan logika Role)
            $role = Auth::user()->role;
            
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            if ($role === 'pegawai') {
                return redirect()->route('pegawai.dashboard');
            }
            
            if ($role === 'user') {
                // FIX: Menggunakan rute user.katalog yang baru
                return redirect()->route('user.katalog');
            }
            
            return redirect()->route('home'); // Fallback
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // =========================================================
    // 2. LOGIN & REGISTER USER (Pintu Pelanggan - Tetap Email)
    // =========================================================

    public function showUserLogin()
    {
        return view('user.auth.login');
    }

    public function userLoginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // --- INTEGRASI CART: Memuat Cart dari DB ke Session ---
            // FIX: BUAT INSTANCE BARU & PANGGIL FUNGSI PENGAMBIL DATA (bukan fungsi view)
            $userOrderController = new UserOrderController();
            $cartJson = $userOrderController->getCartDataForSession(Auth::id()); 
            // Simpan JSON cart ke session
            $request->session()->put('db_cart_data', $cartJson);
            // --------------------------------------------------------

            return redirect()->route('dashboard_redirect'); 
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function showUserRegister()
    {
        return view('user.auth.register');
    }

    public function userRegisterProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => explode('@', $request->email)[0] . rand(100,999),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);
        
        // --- INTEGRASI CART: Siapkan Session Cart Kosong ---
        $request->session()->put('db_cart_data', '[]');
        // ----------------------------------------------------
        
        return redirect()->route('dashboard_redirect');
    }

    // =========================================================
    // 3. LOGOUT & SOCIALITE
    // =========================================================

    public function logout(Request $request)
    {
        // Mendapatkan role sebelum logout total
        $role = Auth::user() ? Auth::user()->role : 'user';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (in_array($role, ['admin', 'pegawai'])) {
            return redirect()->route('login');
        }
        
        return redirect()->route('user.login');
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }
                Auth::login($user);
                
                // --- INTEGRASI CART: Memuat Cart dari DB ke Session ---
                // FIX: BUAT INSTANCE BARU & PANGGIL FUNGSI PENGAMBIL DATA (bukan fungsi view)
                $userOrderController = new UserOrderController();
                $cartJson = $userOrderController->getCartDataForSession(Auth::id());
                session()->put('db_cart_data', $cartJson);
                // ----------------------------------------------------
                
                return redirect()->route('dashboard_redirect');
            
            } else {
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'username' => explode('@', $googleUser->email)[0] . rand(100,999),
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make('123456dummy'),
                    'role' => 'user',
                ]);

                Auth::login($newUser);
                // --- INTEGRASI CART: Siapkan Session Cart Kosong ---
                session()->put('db_cart_data', '[]');
                // ----------------------------------------------------
                
                return redirect()->route('dashboard_redirect');
            }

        } catch (\Exception $e) {
            return redirect()->route('user.login')->withErrors(['email' => 'Login Google Gagal.']);
        }
    }
}