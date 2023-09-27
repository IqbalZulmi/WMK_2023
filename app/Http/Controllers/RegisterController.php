<?php

namespace App\Http\Controllers;

use App\Models\penyedia_lapangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterPage(){
        return view('register');
    }

    public function registerPenyedia(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:users,email|email:dns',
            'password' => 'required|min:8',
            'konf_password' => 'required|min:8|same:password',
            'nama_bisnis' => 'required',
            'alamat' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' => 'required|after:jam_buka',
            'no_hp' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048|file',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Email tidak valid.',
            'email.email:dns' => 'Alamat email tidak valid.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'konf_password.required' => 'Konfirmasi Password harus diisi.',
            'konf_password.min' => 'Konfirmasi Password minimal 8 karakter.',
            'konf_password.same' => 'Konfirmasi Password harus sama dengan Password.',
            'nama_bisnis.required' => 'Nama Bisnis harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'jam_buka.required' => 'Jam Buka harus diisi.',
            'jam_tutup.required' => 'Jam Tutup harus diisi.',
            'jam_tutup.after' => 'Jam Tutup harus setelah Jam Buka.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'foto.required' => 'Foto harus diisi.',
            'foto.image' => 'Foto harus berupa file gambar.',
            'foto.mimes' => 'Format gambar yang diterima adalah JPEG, PNG, atau JPG.',
            'foto.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
            'foto.file' => 'Foto harus berupa file gambar.',
        ]);

        try {
            DB::beginTransaction();

            $akun = new User();
            $akun->email = $request->email;
            $akun->password = Hash::make($request->konf_password);
            $akun->role = 'penyedia';
            $akun->status = 'belum aktif';
            $akun->save();

            $penyedia = new penyedia_lapangan();
            $penyedia->id_user = $akun->id;
            $penyedia->nama_bisnis = $request->nama_bisnis;
            $penyedia->alamat = $request->alamat;
            $penyedia->jam_buka = $request->jam_buka;
            $penyedia->jam_tutup = $request->jam_tutup;
            $penyedia->no_hp = $request->no_hp;

            if ($request->hasFile('foto')) {
                $old_foto = $penyedia->foto;
                if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                    unlink('storage/'.$old_foto);
                }

                $foto = $request->file('foto')->store('public/profile_img');
                $foto = basename($foto);
                $penyedia->foto = $foto ? 'profile_img/' . $foto : null;
            }else{
                $foto = $penyedia->foto;
            }
            $penyedia->save();

            DB::commit();

            return redirect()->route('loginPage')->with([
                'notifikasi' => 'Berhasil membuat akun penyedia lapangan',
                'type' => 'success',
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->route('loginPage')->with([
                'notifikasi' => 'Gagal membuat akun penyedia lapangan',
                'type' => 'error',
            ]);
        }
    }
}
