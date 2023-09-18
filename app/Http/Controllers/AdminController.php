<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function tambahAdmin(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:users,email|email:dns',
            'password' => 'required|min:8',
            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Email tidak valid.',
            'email.email:dns' => 'Email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg.',
            'foto.max' => 'Ukuran gambar maksimum adalah 2 MB.',
        ]);

        try {
            DB::beginTransaction();

            $akun = new User();
            $akun->email = $request->email;
            $akun->password = Hash::make($request->password);
            $akun->role = 'admin';
            $akun->save();

            $admin = new admin();
            $admin->id_user = $akun->id;
            $admin->nama = $request->nama;
            $admin->no_hp = $request->no_hp;

            if ($request->hasFile('foto')) {
                $old_foto = $admin->foto;
                if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                    unlink('storage/'.$old_foto);
                }

                $foto = $request->file('foto')->store('public/profile_img');
                $foto = basename($foto);
                $admin->foto = $foto ? 'profile_img/' . $foto : null;
            }else{
                $foto = $admin->foto;
            }
            $admin->save();

            DB::commit();

            return redirect()->back()->with([
                'notifikasi' => 'Berhasil menambahkan admin',
                'type' => 'success',
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with([
                'notifikasi' => 'Gagal menambahkan admin',
                'type' => 'error',
            ]);
        }
    }

    public function editAdmin(Request $request,$id_user){
        $validatedData = $request->validate([
            'email' => 'required|unique:users,email,'. $request->old_email . ',email|email:dns',
            'password' => 'nullable|min:8',
            'status' => 'required',
            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Email tidak valid.',
            'email.email:dns' => 'Email tidak valid.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.mimes' => 'Format gambar yang diizinkan: jpeg, png, jpg.',
            'foto.max' => 'Ukuran gambar maksimum adalah 2 MB.',
        ]);

        try {
            DB::beginTransaction();

            $akun = User::where('id',$id_user)->firstOrFail();
            $akun->email = $request->email;
            if (!empty($request->password)) {
                $akun->password = Hash::make($request->password);
            }
            $akun->status = $request->status;


            $admin = admin::where('id_user',$id_user)->firstOrFail();
            $admin->nama = $request->nama;
            $admin->no_hp = $request->no_hp;

            if ($request->hasFile('foto')) {
                $old_foto = $admin->foto;
                if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                    unlink('storage/'.$old_foto);
                }

                $foto = $request->file('foto')->store('public/profile_img');
                $foto = basename($foto);
                $admin->foto = $foto ? 'profile_img/' . $foto : null;
            }else{
                $foto = $admin->foto;
            }

            if($akun->isDirty() || $admin->isDirty()){
                $akun->save();
                $admin->save();
                DB::commit();

                return redirect()->back()->with([
                    'notifikasi' => 'Berhasil mengedit admin',
                    'type' => 'success',
                ]);
            }else{
                return redirect()->back()->with([
                    'notifikasi' => 'tidak ada perubahan',
                    'type' => 'info',
                ]);
            }

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengedit admin' ,
                'type' => 'error',
            ]);
        }
    }

    public function hapusAdmin($id_user){
        $admin = User::where('id',$id_user);
        if ($admin->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($admin->first()->delete()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil menghapus data!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal menghapus data!",
                "type"=>"error",
            ]);
        }
    }
}
