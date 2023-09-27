<?php

namespace App\Http\Controllers;

use App\Helper\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
            }
        }
        return redirect()->back()->withInput()->with([
            'notifikasi' => 'Login Failed !',
            'type' => 'error'
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginPage')->with([
            'notifikasi' => 'Anda berhasil logout !',
            'type' => 'success'
        ]);
    }

    public function registerMobile(Request $request) {
        $response = (new UserService($request->email, $request->password))->register($request->devicename);
        return response()->json($response);
    }

    public function loginMobile(Request $request) {

    }
}
