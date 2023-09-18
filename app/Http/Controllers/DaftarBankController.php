<?php

namespace App\Http\Controllers;

use App\Models\daftar_bank;
use Illuminate\Http\Request;

class DaftarBankController extends Controller
{
    public function showDaftarBank(){
        $bank = daftar_bank::latest()->get();

        return view('superadmin.daftar-bank',[
            'dataBank' => $bank,
        ]);
    }

    public function tambahDaftarBank(Request $request){
        $validatedData = $request->validate([
            'kode_bank' => 'required|unique:daftar_banks,kode_bank|numeric',
            'nama_bank' => 'required',
        ], [
            'kode_bank.required' => 'kode bank wajib diisi.',
            'kode_bank.unique' => 'kode bank sudah digunakan.',
            'kode_bank.numeric' => 'kode bank harus berupa angka.',
            'nama_bank.required' => 'Nama Bank wajib diisi.',
        ]);

        $bank = new daftar_bank();
        $bank->kode_bank = $request->kode_bank;
        $bank->nama_bank = $request->nama_bank;

        if ($bank->save()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil menambahkan bank!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal menambahkan bank!",
                "type"=>"error",
            ]);
        }
    }

    public function editDaftarBank(Request $request,$kode_bank){
        $validatedData = $request->validate([
            'kode_bank' => 'required|unique:daftar_banks,kode_bank,'.$request->old_kode_bank.',kode_bank|numeric',
            'nama_bank' => 'required',
        ], [
            'kode_bank.required' => 'kode bank wajib diisi.',
            'kode_bank.unique' => 'kode bank sudah digunakan.',
            'kode_bank.numeric' => 'kode bank harus berupa angka.',
            'nama_bank.required' => 'Nama Bank wajib diisi.',
        ]);

        $bank = daftar_bank::where('kode_bank',$kode_bank)->firstOrFail();
        $bank->kode_bank = $request->kode_bank;
        $bank->nama_bank = $request->nama_bank;

        if ($bank->isDirty()){
            if ($bank->save()) {
                return redirect()->back()->with([
                    'notifikasi'=>"Berhasil mengubah data bank!",
                    "type"=>"success"
                ]);
            }else{
                return redirect()->back()->with([
                    'notifikasi'=>"Gagal mengubah data bank!",
                    "type"=>"error",
                ]);
            }
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Tidak Ada perubahan",
                "type"=>"info",
            ]);
        }
    }

    public function hapusDaftarBank($kode_bank){
        $bank = daftar_bank::where('kode_bank',$kode_bank);
        if ($bank->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($bank->first()->delete()) {
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
