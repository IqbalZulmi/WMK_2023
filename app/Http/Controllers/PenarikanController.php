<?php

namespace App\Http\Controllers;

use App\Models\lapangan;
use App\Models\pemesanan;
use App\Models\penarikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenarikanController extends Controller
{
    public function showValidasiPenarikan(){
        $penarikan = penarikan::orderBy('created_at', 'asc')->get();

        return view('admin.validasi-penarikan',[
            'dataPenarikan' => $penarikan,
        ]);
    }

    public function showPenarikanPage(){
        $auth = Auth::user()->penyedia;
        $penarikan = Penarikan::where('id_penyedia_lapangan', $auth->id)->get();
        $lapangan = lapangan::where('id_penyedia_lapangan', $auth->id)->get();

        $penarikanPending = $penarikan->where('status','pending');

        $jumlahPenarikan = $penarikan->where('status','selesai')->sum('jumlah_penarikan');
        $jumlahPemesanan = $lapangan->sum(function ($lap) {
            return $lap->pemesanan->where('status', 'berhasil')->sum('total_harga');
        });

        $totalSaldo = $jumlahPemesanan - $jumlahPenarikan;

        return view('penyedia_lapangan.penarikan',[
            'dataPending' => $penarikanPending,
            'totalSaldo' => $totalSaldo,
        ]);
    }

    public function pengajuanPenarikan(){
        
    }

    // public function showValidasdasiPenarikan($id){
    //     $penarikan = Penarikan::where('id_penyedia_lapangan',$id)->get();
    //     $lapangan = lapangan::where('id_penyedia_lapangan',$id)->get();

    //     $jumlahPenarikan = $penarikan->sum('jumlah_penarikan');
    //     $jumlahpemesanan = $lapangan->pemesanan->sum('total_harga');

    //     $totalSaldo = $jumlahpemesanan - $jumlahPenarikan;
    //     // return view('admin.validasi-penarikan',[
    //     //     'dataPenarikan' => $penarikan,
    //     // ]);
    // }


}
