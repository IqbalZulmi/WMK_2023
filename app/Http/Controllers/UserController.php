<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showLandingPage(){
        return view("landingPage");
    }

    public function updateKataSandi(Request $request, $id_user){
        $validatedData = $request->validate([
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

        if (!Hash::check($request->password_lama, auth()->user()->password)) {
            return redirect()->back()->withErrors(['password_lama' => 'Password salah.'])->withInput();
        }

        $user = User::where('id',$id_user)->firstOrFail();
        $user->password = Hash::make($request->password_baru);
        if ($user->save()) {
            return redirect()->back()->with([
                'notifikasi' => 'Password berhasil diperbarui!',
                'type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Password gagal diperbarui!',
                'type' => 'error'
            ]);
        }
    }

    public function updateStatus(Request $request,$id_user){
        $validatedData = $request->validate([
            'status' => 'required',
        ], [
            'status.required' => 'Status harus diisi.',
        ]);

        $user = User::where('id',$id_user)->firstOrFail();
        $user->status = $request->status;
        if($user->isDirty()){
            if ($user->save()) {
                return redirect()->back()->with([
                    'notifikasi' => 'status berhasil diperbarui!',
                    'type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'notifikasi' => 'status gagal diperbarui!',
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
