<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function showValidasiPemesanan(){
        $pembayaranPending = Pembayaran::whereHas('pemesanan', function ($query) {
            $query->where('status', 'pending');
        })->orderBy('created_at', 'asc')->get();

        return view('admin.validasi-pemesanan', [
            'dataPembayaran' => $pembayaranPending,
        ]);
    }

    public function validasiPemesanan(Request $request, $id_pemesanan, $id_pembayaran){
        $validatedData = $request->validate([
            'status' => 'required',
        ], [
            'status.required' => 'status harus diisi.',
        ]);

        try {
            DB::beginTransaction();

            $pembayaran = pembayaran::where('id', $id_pembayaran)->firstOrFail();
            $pembayaran->id_admin = Auth::user()->admin->id;

            $pemesanan = pemesanan::where('id', $id_pemesanan)->firstOrFail();
            $pemesanan->status = $request->status;

            if ($request->status == 'gagal') {
                $request->validate([
                    'komentar' => 'required',
                ], [
                    'komentar.required' => 'komentar harus diisi.',
                ]);

                $pemesanan->komentar = $request->komentar;
            }else{
                $pemesanan->komentar = '-';
            }

            $pemesanan->save();
            $pembayaran->save();

            DB::commit();

            return redirect()->back()->with([
                'notifikasi' => "Berhasil memvalidasi Pemesanan!",
                "type" => "success",
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'notifikasi' => "Gagal memvalidasi Pemesanan!",
                "type" => "error",
            ]);
        }
    }

    public function showRiwayatValidasiPemesananPage(){
        $admin = Auth::user()->admin;

        $pembayaranBerhasil = Pembayaran::whereHas('pemesanan', function ($query) {
            $query->where('status', 'berhasil');
        })->where('id_admin', $admin->id)->latest()->get();

        $pembayaranGagal = Pembayaran::whereHas('pemesanan', function ($query) {
            $query->where('status', 'gagal');
        })->where('id_admin', $admin->id)->latest()->get();

        return view('admin.riwayat-validasi-pemesanan', [
            'dataBerhasil' => $pembayaranBerhasil,
            'dataGagal' => $pembayaranGagal,
        ]);
    }

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
