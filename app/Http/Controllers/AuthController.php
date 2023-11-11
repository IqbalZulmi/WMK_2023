<?php

namespace App\Http\Controllers;

use App\Helper\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('login');
    }

    public function loginProcess(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $request->session()->regenerate();
            if ($user->role === 'penyedia'){
                return redirect()->route('dashboardPage')->with([
                    'notifikasi' => 'Selamat Datang ' . $user->penyedia->nama_bisnis,
                    'type' => 'success'
                ]);
            }elseif($user->role === 'admin'){
                return redirect()->route('adminDashboardPage')->with([
                    'notifikasi' => 'Selamat Datang ' . $user->admin->nama,
                    'type' => 'success'
                ]);
            }elseif($user->role === 'superadmin'){
                return redirect()->route('superadminDashboardPage')->with([
                    'notifikasi' => 'Selamat Datang ' . $user->role,
                    'type' => 'success'
                ]);
            }elseif($user->role === 'pelanggan'){
                Auth::logout();
                return redirect()->back()->with([
                    'notifikasi' => 'Akses dilarang untuk pelanggan.',
                    'type' => 'error'
                ]);
            }
        }

        return redirect()->back()->withInput()->with([
            'notifikasi' => 'Login Failed !',
            'type' => 'error'
        ]);
    }

    public function logout(Request $request): RedirectResponse{
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginPage')->with([
            'notifikasi' => 'Anda berhasil logout !',
            'type' => 'success'
        ]);
    }

    public function loginMobile(Request $request) {
        $Validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($Validator->fails()) {
            return response()->json([
                'notifikasi' => 'login Failed',
                'type' => 'danger',
                'errors' => $Validator->errors()
            ], 422);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)){
            $user = Auth::user();
            if ($user->role === 'pelanggan') {
                $pelanggan = $user->pelanggan;
                $token = $user->createToken('laravel_reactnative_login')->plainTextToken;

                return response()->json([
                    'user' => $user,
                    'token'=> $token,
                    'notifikasi' => 'login success',
                    'type' => 'success'
                ],200);
            }else {
                return response()->json([
                    'notifikasi' => 'login Failed',
                    'type' => 'danger'
                ],401);
            }
        } else {
            return response()->json([
                'notifikasi' => 'login Error',
                'type' => 'danger'
            ],500);
        }
    }

    public function logoutMobile(Request $request){
        try {
            // Mendapatkan pengguna yang saat ini diautentikasi
            $user = Auth::user();

            // Mencabut semua token yang dimiliki oleh pengguna
            $user->tokens()->delete();

            return response()->json([
                'notifikasi' => 'logged out berhasil',
                'type'=> 'success'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'Failed to logout',
                'type'=> 'danger',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
