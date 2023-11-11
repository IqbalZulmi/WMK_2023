<?php

namespace App\Http\Controllers;

use App\Models\jadwal_lapangan;
use App\Models\pembayaran;
use App\Models\pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function pemesananPelanggan(Request $request,$id_pelanggan){
        try {
            $data = $request->all();
            $allPemesanans = [];

            if (count($data['id_jadwal_lapangan']) != count($data['id_lapangan'])) {
                // Menangani kasus dimana panjang kedua array tidak sama
                return response()->json([
                    'notifikasi' => 'Jumlah id_jadwal_lapangan dan id_lapangan tidak sama',
                    'type' => 'danger'
                ], 400);
            }

            for ($i = 0; $i < count($data['id_jadwal_lapangan']); $i++) {
                $pemesanan = Pemesanan::create([
                    'id_pelanggan' => $id_pelanggan,
                    'id_lapangan' => $data['id_lapangan'][$i],
                    'id_jadwal_lapangan' => $data['id_jadwal_lapangan'][$i],
                    'id_metode_pembayaran' => $data['id_metode_pembayaran'],
                    'tanggal_pemesanan' => $data['tanggal_pemesanan'],
                    'total_harga' => $data['total_harga'],
                    'status' => 'draft'
                ]);

                $allPemesanans[] = $pemesanan;

                // Update status di tabel jadwal yang sesuai
                jadwal_lapangan::where('id', $data['id_jadwal_lapangan'][$i])
                ->update(['status' => 'sedang dipesan']);
            }

            return response()->json([
                'notifikasi' => 'Data pemesanan berhasil disimpan',
                'type' => 'success',
                'dataPemesanan' => $allPemesanans
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'Terjadi kesalahan saat menyimpan data',
                'type' => 'danger',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function pembayaranPelanggan(Request $request){
        try {
            $Validator = Validator::make($request->all(), [
                'bukti_pembayaran' => 'required|mimes:jpeg,png,jpg',
            ],[
                'bukti_pembayaran.required' => 'bukti pembayaran harus diisi.',
                'bukti_pembayaran.mimes' => 'Format file gambar yang diterima adalah JPEG, PNG, atau JPG.',

            ]);

            if ($Validator->fails()) {
                return response()->json([
                    'notifikasi' => 'Gagal mengupload bukti pembayaran',
                    'type' => 'danger',
                    'errors' => $Validator->errors()
                ], 422);
            }

            $data = $request->all();
            $bukti_pembayaran = $data['bukti_pembayaran']->store('public/bukti_pembayaran');
            $bukti_pembayaran = basename($bukti_pembayaran);

            for ($i = 0; $i < count($data['id_pemesanan']); $i++) {
                pembayaran::create([
                    'id_pemesanan' => $data['id_pemesanan'][$i],
                    'tanggal_pembayaran' => $data['tanggal_pembayaran'],
                    'bukti_pembayaran' => 'bukti_pembayaran/'.$bukti_pembayaran,
                ]);

                pemesanan::where('id',$data['id_pemesanan'][$i])
                ->update(['status' => 'pending']);
            }

            return response()->json([
                'notifikasi' => 'Data pembayaran berhasil disimpan',
                'type' => 'success',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'Terjadi kesalahan saat menyimpan data',
                'type' => 'danger',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function riwayatPemesananPelanggan($id_pelanggan, $status){
        try {
            // Ambil data pemesanan berdasarkan status dan id_pelanggan
            $dataDraft = pemesanan::where('id_pelanggan', $id_pelanggan)
            ->with(['lapangan.jenis_lapangan','lapangan.penyedia','jadwal_lapangan', 'metode_pembayaran', 'pembayaran.admin'])
            ->where('status', $status)
            ->get();

            // Kelompokkan data berdasarkan created_at
            $groupedDataDraft = $dataDraft->groupBy(function($date) {
                return Carbon::parse($date->created_at);
            });

            return response()->json([
                'notifikasi' => 'Data berhasil diambil',
                'type' => 'success',
                'dataDraft' => $groupedDataDraft,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'Terjadi kesalahan saat mengambil data',
                'type' => 'danger',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function showValidasiPemesanan(){
        $dataPending = pemesanan::where('status', 'pending')
        ->get();

         // Kelompokkan data berdasarkan created_at dan id_pelanggan
        $groupedDataPending = $dataPending->groupBy(function ($item) {
            // Menggunakan timestamp dan id_pelanggan sebagai kunci unik
            return Carbon::parse($item->created_at). '_' . $item->id_pelanggan;
        });

        return view('admin.validasi-pemesanan', [
            'dataPembayaran' => $groupedDataPending,
        ]);
    }

    public function validasiPemesanan(Request $request){
        // Validasi awal untuk id_pemesanans dan status
        $validatedData = $request->validate([
            'id_pemesanans' => 'required|array',
            'status' => 'required',
        ], [
            'status.required' => 'status harus diisi.',
        ]);

        // Validasi tambahan untuk komentar jika status gagal
        if ($request->status == 'gagal') {
            $request->validate([
                'komentar' => 'required',
            ], [
                'komentar.required' => 'komentar harus diisi ketika status gagal.',
            ]);
        }

        try {
            DB::beginTransaction();

            foreach ($request->id_pemesanans as $idPemesanan) {
                $pemesanan = Pemesanan::findOrFail($idPemesanan);
                $statusUpdate = $request->status == 'gagal' ? 'draft' : $request->status;
                $komentarUpdate = $request->status == 'gagal' ? $request->komentar : '-';

                $pemesanan->update([
                    'status' => $statusUpdate,
                    'komentar' => $komentarUpdate
                ]);

                $statusJadwal = $request->status == 'gagal' ? 'sedang dipesan' : 'telah dipesan';

                $pemesanan->pembayaran->update(['id_admin' => Auth::user()->admin->id]);

                $pemesanan->jadwal_lapangan->update(['status' => $statusJadwal]);
            }

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

        $pemesananDraft = pemesanan::whereHas('lapangan', function ($query) use ($user) {
            $query->where('id_penyedia_lapangan', $user->id);
        })->where('status','draft')->get();

        $pemesananPending = pemesanan::whereHas('lapangan', function ($query) use ($user) {
            $query->where('id_penyedia_lapangan', $user->id);
        })->where('status','pending')->get();

        $pemesananBerhasil = pemesanan::whereHas('lapangan', function ($query) use ($user) {
            $query->where('id_penyedia_lapangan', $user->id);
        })->where('status','berhasil')->get();

        return view('penyedia_lapangan.riwayat-pemesanan', [
            'dataDraft' => $pemesananDraft,
            'dataPending' => $pemesananPending,
            'dataBerhasil' => $pemesananBerhasil,
        ]);
    }

}
