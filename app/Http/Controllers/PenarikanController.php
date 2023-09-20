<?php

namespace App\Http\Controllers;

use App\Models\lapangan;
use App\Models\pemesanan;
use App\Models\penarikan;
use Illuminate\Http\Request;

class PenarikanController extends Controller
{
    public function showValidasiPenarikan(){
        $penarikan = Penarikan::orderBy('created_at', 'asc')->get();

        return view('admin.validasi-penarikan',[
            'dataPenarikan' => $penarikan,
        ]);
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
