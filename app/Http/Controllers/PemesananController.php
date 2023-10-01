<?php

namespace App\Http\Controllers;

use App\Models\pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function showRiwayatPemesananPage(){
        $user = Auth::user()->penyedia;

        $pemesananPending = pemesanan::whereHas('lapangan', function ($query) use ($user) {
            $query->where('id_penyedia_lapangan', $user->id);
        })->where('status','pending')->get();

        $pemesananBerhasil = pemesanan::whereHas('lapangan', function ($query) use ($user) {
            $query->where('id_penyedia_lapangan', $user->id);
        })->where('status','berhasil')->get();

        return view('penyedia_lapangan.riwayat-pemesanan', [
            'dataPending' => $pemesananPending,
            'dataBerhasil' => $pemesananBerhasil,
        ]);
    }

}
