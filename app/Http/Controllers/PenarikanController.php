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

        $penarikan = penarikan::where('id_penyedia_lapangan',$auth->id)->latest()->get();
        $lapangan = lapangan::where('id_penyedia_lapangan',$auth->id)->get();

        $penarikanPending = $penarikan->where('status','sedang diproses');

        $jumlahPenarikan = $penarikan->where('status', 'selesai')->sum('jumlah_penarikan');
        $jumlahPemesanan = $lapangan->flatMap(function ($lap) {
            return $lap->pemesanan->where('status', 'berhasil');
        });

        $totalSaldo = $jumlahPemesanan->sum('total_harga') - $jumlahPenarikan;

        return view('penyedia_lapangan.penarikan', [
            'dataPending' => $penarikanPending,
            'totalSaldo' => $totalSaldo,
        ]);
    }

    public function pengajuanPenarikan(Request $request){
        $validatedData = $request->validate([
            'total_saldo' => 'required',
            'bank' => 'required',
            'no_rekening' => 'required|numeric',
            'nama_rekening' => 'required',
            'jumlah_penarikan' => 'required|numeric|lte:total_saldo',
        ], [
            'total_saldo.required' => 'Total saldo harus diisi.',
            'bank.required' => 'Bank harus diisi.',
            'no_rekening.required' => 'Nomor rekening harus diisi.',
            'no_rekening.numeric' => 'Nomor rekening harus berupa angka.',
            'nama_rekening.required' => 'Nama rekening harus diisi.',
            'jumlah_penarikan.required' => 'Jumlah penarikan harus diisi.',
            'jumlah_penarikan.numeric' => 'Jumlah penarikan harus berupa angka.',
            'jumlah_penarikan.lte' => 'Jumlah penarikan tidak boleh lebih besar dari total saldo.',
        ]);

        $penarikan = new penarikan();
        $penarikan->id_penyedia_lapangan = Auth::user()->penyedia->id;
        $penarikan->jumlah_penarikan = $request->jumlah_penarikan;

        if ($penarikan->save()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil mengajukan penarikan saldo!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal mengajukan penarikan saldo!",
                "type"=>"error",
            ]);
        }
    }

    public function showRiwayatPenarikanPage(){
        $user = Auth::user()->penyedia;

        $penarikanSelesai = penarikan::where('id_penyedia_lapangan',$user->id)->where('status','selesai')->latest()->get();
        $penarikanDitolak = penarikan::where('id_penyedia_lapangan',$user->id)->where('status','ditolak')->latest()->get();
        return view('penyedia_lapangan.riwayat-penarikan',[
            'dataSelesai' => $penarikanSelesai,
            'dataDitolak' => $penarikanDitolak,
        ]);
    }
}
