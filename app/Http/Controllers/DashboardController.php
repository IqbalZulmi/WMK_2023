<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\daftar_bank;
use App\Models\jenis_lapangan;
use App\Models\lapangan;
use App\Models\pemesanan;
use App\Models\penarikan;
use App\Models\penyedia_lapangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function superadminDashboard(){
        $admin = admin::latest()->get();
        $daftar_bank = daftar_bank::all();
        $jenis_lapangan = jenis_lapangan::all();

        return view('superadmin.dashboard',[
            'dataAdmin' => $admin,
            'daftarBank' => $daftar_bank,
            'dataLapangan' => $jenis_lapangan,
        ]);
    }

    public function adminDashboard(){
        $penyedia = User::where('role','penyedia')->orderBy('status','asc')->latest()->get();
        $penarikan = penarikan::where('status','sedang diproses')->get();
        $pemesanan = pemesanan::where('status','pending')->get();

        return view('admin.dashboard', [
            'dataPenyedia' => $penyedia,
            'dataPenarikan' => $penarikan,
            'dataPemesanan' => $pemesanan,
        ]);
    }


    public function penyediaDashboard(){
        $user = Auth::user()->penyedia;
        $penarikan = Penarikan::where('id_penyedia_lapangan', $user->id)->get();
        $lapangan = lapangan::where('id_penyedia_lapangan', $user->id)->get();

        $jumlahPenarikan = $penarikan->sum('jumlah_penarikan');
        $jumlahPemesanan = $lapangan->sum(function ($lap) {
            return $lap->pemesanan->where('status', 'berhasil')->sum('total_harga');
        });

        $totalSaldo = $jumlahPemesanan - $jumlahPenarikan;

        return view('penyedia_lapangan.dashboard', [
            'totalSaldo' => $totalSaldo,
            'dataLapangan' => $lapangan,
            'dataPenarikan' => $penarikan,
        ]);
    }

}
