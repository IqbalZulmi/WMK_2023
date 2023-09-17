<?php

namespace App\Http\Controllers;

use App\Models\daftar_bank;
use App\Models\penyedia_lapangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyediaLapanganController extends Controller
{
    public function showProfile(){
        $auth = Auth::user()->penyedia_lapangan;

        $dataProfile = penyedia_lapangan::where('id',$auth->id)->firstOrFail();
        $daftarBank = daftar_bank::all();
        return view('penyedia_lapangan.profile-penyedia',[
            'dataProfile' => $dataProfile,
            'daftarBank' => $daftarBank,
        ]);
    }

    public function updateProfile(Request $request, $id_user){
        $validatedData = $request->validate([
            'nama_bisnis' => 'required',
            'email' => 'required|unique:users,email,'. $request->old_email . ',email|email:dns',
            'alamat' => 'required',
            'deskripsi_lapangan' => 'nullable',
            'jam_buka' => 'required',
            'jam_tutup' => 'required|after:jam_buka',
            'no_hp'=> 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|file',
        ], [
            'nama_bisnis.required' => 'Nama bisnis harus diisi.',
            'email.required' => 'Alamat email harus diisi.',
            'email.unique' => 'Alamat email sudah digunakan.',
            'email.email' => 'Alamat email tidak valid.',
            'email.dns' => 'Alamat email tidak valid.',
            'alamat.required' => 'Alamat harus diisi.',
            'jam_buka.required' => 'Jam buka harus diisi.',
            'jam_tutup.required' => 'Jam tutup harus diisi.',
            'jam_tutup.after' => 'Jam tutup harus setelah jam buka.',
            'no_hp.required' => 'Nomor HP harus diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'foto.image' => 'Foto harus berupa file gambar.',
            'foto.mimes' => 'Format file gambar yang diterima adalah JPEG, PNG, atau JPG.',
            'foto.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
            'foto.file' => 'Foto harus berupa file gambar.',
        ]);

        $user = User::where('id',$id_user)->firstOrFail();
        $user->email = $request->email;

        $penyedia = penyedia_lapangan::where('id_user',$id_user)->firstOrFail();
        $penyedia->nama_bisnis = $request->nama_bisnis;
        $penyedia->alamat = $request->alamat;
        $penyedia->deskripsi_lapangan = $request->deskripsi_lapangan;
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

        if($penyedia->isDirty() || $user->isDirty()){
            if($penyedia->save() || $user->save()){
                return redirect()->back()->with([
                    'notifikasi' => 'Berhasil mengubah profile',
                    'type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'notifikasi' => 'Gagal mengubah profile',
                    'type' => 'error'
                ]);
            }
        }else{
            return redirect()->back()->with([
                'notifikasi' => 'Tidak ada perubahan!',
                'type' => 'info'
            ]);
        }
    }
}
