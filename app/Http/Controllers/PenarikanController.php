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
        $penarikan = Penarikan::where('status', 'sedang diproses')
            ->orderBy('created_at', 'asc')
            ->get();

        $totalSaldos = [];

        foreach ($penarikan as $data) {
            $totalSaldos[$data->penyedia->id] = $this->hitungTotalSaldo($data->penyedia->id);
        }

        return view('admin.validasi-penarikan', [
            'dataPenarikan' => $penarikan,
            'totalSaldos' => $totalSaldos,
        ]);
    }

    public function hitungTotalSaldo($id_penyedia_lapangan){
        $pemesananBerhasil = Pemesanan::where('status', 'berhasil')
        ->whereHas('lapangan', function ($query) use ($id_penyedia_lapangan) {
            $query->where('id_penyedia_lapangan', $id_penyedia_lapangan);
        })
        ->sum('total_harga');


        $penarikanSelesai = Penarikan::where('status', 'selesai')
            ->where('id_penyedia_lapangan', $id_penyedia_lapangan)
            ->sum('jumlah_penarikan');

        $totalSaldo = $pemesananBerhasil - $penarikanSelesai;

        return $totalSaldo;
    }

    public function validasiPenarikan(Request $request,$id_penarikan){
        $validatedData = $request->validate([
            'total_saldo' => 'required',
            'jumlah_penarikan' => 'required|numeric|lte:total_saldo',
            'status' => 'required',
        ], [
            'total_saldo.required' => 'Total saldo harus diisi.',
            'jumlah_penarikan.required' => 'Jumlah penarikan harus diisi.',
            'jumlah_penarikan.numeric' => 'Jumlah penarikan harus berupa angka.',
            'jumlah_penarikan.lte' => 'Jumlah penarikan tidak boleh lebih besar dari total saldo.',
        ]);

        $penarikan = penarikan::where('id',$id_penarikan)->firstOrFail();

        $penarikan->id_admin = Auth::user()->admin->id;

        $penarikan->status = $request->status;

        if($request->status == 'selesai'){
            $request->validate([
                'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048|file',
            ],[
                'bukti_pembayaran.required' => 'bukti pembayaran harus diisi.',
                'bukti_pembayaran.image' => 'bukti pembayaran harus berupa file gambar.',
                'bukti_pembayaran.mimes' => 'Format file gambar yang diterima adalah JPEG, PNG, atau JPG.',
                'bukti_pembayaran.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
                'bukti_pembayaran.file' => 'bukti pembayaran harus berupa file gambar.',
            ]);

            if ($request->hasFile('bukti_pembayaran')) {
                $old_bukti_pembayaran = $penarikan->bukti_pembayaran;
                if (!empty($old_bukti_pembayaran) && is_file('storage/'.$old_bukti_pembayaran)) {
                    unlink('storage/'.$old_bukti_pembayaran);
                }

                $bukti_pembayaran = $request->file('bukti_pembayaran')->store('public/bukti_pembayaran');
                $bukti_pembayaran = basename($bukti_pembayaran);
                $penarikan->bukti_pembayaran = $bukti_pembayaran ? 'bukti_pembayaran/' . $bukti_pembayaran : null;
            }else{
                $bukti_pembayaran = $penarikan->bukti_pembayaran;
            }

            $penarikan->komentar = '-';
        }else{
            $request->validate([
                'komentar' => 'required',
            ],[
                'komentar.required' => 'komentar harus diisi.',
            ]);

            $penarikan->komentar = $request->komentar;
        }

        if ($penarikan->save()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil memvalidasi penarikan saldo!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal memvalidasi penarikan saldo!",
                "type"=>"error",
            ]);
        }
    }

    public function showRiwayatValidasiPenarikanPage(){
        $admin = Auth::user()->admin;

        $penarikanSelesai = penarikan::where('id_admin',$admin->id)->where('status','selesai')->get();
        $penarikanDitolak = penarikan::where('id_admin',$admin->id)->where('status','ditolak')->get();

        return view('admin.riwayat-validasi-penarikan',[
            'dataSelesai' => $penarikanSelesai,
            'dataDitolak' => $penarikanDitolak,
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
