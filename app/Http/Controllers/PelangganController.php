<?php

namespace App\Http\Controllers;

use App\Models\jadwal_lapangan;
use App\Models\lapangan;
use App\Models\penyedia_lapangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    public function getLapanganApi(){
        try {
            $penyediaLapangan = penyedia_lapangan::all();
            $Lapangan = lapangan::with(['penyedia', 'jenis_lapangan'])->get();

            return response()->json([
                'notifikasi' => 'data berhasil diambil',
                'type' => 'success',
                'dataPenyediaLapangan' => $penyediaLapangan,
                'dataLapangan' => $Lapangan,
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'data gagal diambil',
                'type' => 'danger',
                'message' => $e->getMessage() // Opsional: Anda bisa mengembalikan pesan kesalahan untuk debugging
            ], 500); // HTTP status code 500 untuk Internal Server Error
        }
    }

    public function getJadwalLapangan($id_lapangan){
        try {
            $jadwalLapangan = jadwal_lapangan::where('id_lapangan',$id_lapangan)->get();

            return response()->json([
                'notifikasi' => 'data berhasil diambil',
                'type' => 'success',
                'dataJadwalLapangan' => $jadwalLapangan,
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'data gagal diambil',
                'type' => 'danger',
                'message' => $e->getMessage() // Opsional: Anda bisa mengembalikan pesan kesalahan untuk debugging
            ], 500); // HTTP status code 500 untuk Internal Server Error
        }
    }

    public function getJenisLapanganPenyedia($id_penyedia){
        try {
            $lapangan = lapangan::where('id_penyedia_lapangan',$id_penyedia);

            $semuaLapangan = $lapangan->with(['penyedia', 'jenis_lapangan'])->get();

            $jenisLapangan = $lapangan ->with('jenis_lapangan')
            ->select('id_jenis_lapangan')
            ->distinct()
            ->get();

            $lapanganIds = lapangan::where('id_penyedia_lapangan',$id_penyedia)->pluck('id');
            $minHarga = jadwal_lapangan::whereIn('id_lapangan', $lapanganIds)->min('harga');

            return response()->json([
                'notifikasi' => 'data berhasil diambil',
                'type' => 'success',
                'dataLapangan'=> $semuaLapangan,
                'dataJenisLapangan' => $jenisLapangan,
                'minHarga' => $minHarga,
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'data gagal diambil',
                'type' => 'danger',
                'message' => $e->getMessage() // Opsional: Anda bisa mengembalikan pesan kesalahan untuk debugging
            ], 500); // HTTP status code 500 untuk Internal Server Error
        }
    }

    public function getLapanganTertentu($jenis_lapangan){
        try {
            $Lapangan = lapangan::with(['penyedia', 'jenis_lapangan'])
            ->whereHas('jenis_lapangan', function($query) use ($jenis_lapangan) {
                $query->where('jenis_lapangan', $jenis_lapangan);
            })
            ->get();

            return response()->json([
                'notifikasi' => 'data berhasil diambil',
                'type' => 'success',
                'dataLapangan' => $Lapangan,
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'data gagal diambil',
                'type' => 'danger',
                'message' => $e->getMessage() // Opsional: Anda bisa mengembalikan pesan kesalahan untuk debugging
            ], 500); // HTTP status code 500 untuk Internal Server Error
        }
    }

    public function updateProfile($id_user, Request $request){
        $Validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'. $request->old_email . ',email|email:dns',
            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Email tidak valid.',
            'email.email:dns' => 'Email tidak valid.',
            'nama.required' => 'Nama wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg.',
            'foto.max' => 'Ukuran gambar maksimum adalah 2 MB.',
        ]);

        if ($Validator->fails()) {
            return response()->json([
                'notifikasi' => 'Gagal mengubah profil',
                'type' => 'danger',
                'errors' => $Validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $akun = User::findOrFail($id_user);
            $akun->email = $request->email;
            $akun->save();

            $pelanggan = $akun->pelanggan;
            $pelanggan->nama = $request->nama;
            $pelanggan->no_hp = $request->no_hp;


            if ($request->hasFile('foto')) {
                $old_foto = $pelanggan->foto;
                if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                    unlink('storage/'.$old_foto);
                }

                $foto = $request->file('foto')->store('public/profile_img');
                $foto = basename($foto);
                $pelanggan->foto = $foto ? 'profile_img/' . $foto : null;
            }else{
                $foto = $pelanggan->foto;
            }

            $pelanggan->save(); // Save changes for pelanggan

            DB::commit(); // Commit the transaction

            return response()->json([
                'notifikasi' => 'data berhasil diubah',
                'type' => 'success',
            ],200);

        } catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'data gagal diubah',
                'type' => 'danger',
                'message' => $e->getMessage() // Opsional: Anda bisa mengembalikan pesan kesalahan untuk debugging
            ], 500); // HTTP status code 500 untuk Internal Server Error
        }
    }

    public function updatePassword(Request $request, $id_user){
        $Validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|different:password_lama',
            'konf_password' => 'required|same:password_baru',
        ], [
            'password_lama.required' => 'Masukkan password saat ini.',
            'password_baru.required' => 'Masukkan password baru.',
            'password_baru.min' => 'Password baru minimal terdiri dari 8 karakter.',
            'password_baru.different' => 'Password baru harus berbeda dengan password saat ini.',
            'konf_password.required' => 'Masukkan konfirmasi password baru.',
            'konf_password.same' => 'Konfirmasi password baru tidak cocok.',
        ]);

        if ($Validator->fails()) {
            return response()->json([
                'notifikasi' => 'Gagal mengubah password',
                'type' => 'danger',
                'errors' => $Validator->errors()
            ], 422);
        }

        try{
            if (!Hash::check($request->password_lama, auth()->user()->password)) {
                return response()->json([
                    'notifikasi' => 'Password lama tidak cocok.',
                    'type'=> 'danger',
                    'errors' => ['password_lama' => ['Password salah.']]
                ], 422);
            }

            $user = User::where('id',$id_user)->firstOrFail();
            $user->password = Hash::make($request->password_baru);
            $user->save();

            return response()->json([
                'notifikasi' => 'Password berhasil diperbarui!',
                'type' => 'success'
            ],200);

        }catch (\Exception $e) {
            return response()->json([
                'notifikasi' => 'password gagal diubah',
                'type' => 'danger',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
