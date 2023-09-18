<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\daftar_bank;
use App\Models\jenis_lapangan;
use Illuminate\Http\Request;

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
}
