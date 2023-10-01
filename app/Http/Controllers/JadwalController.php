<?php

namespace App\Http\Controllers;

use App\Models\jadwal_lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JadwalController extends Controller
{
    public function editJadwalLapangan(Request $request,$id_jadwal){
        $validatedData = $request->validate([
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'harga_lapangan' => 'required|numeric',
            'status' => 'required',
        ], [
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'jam_selesai.required' => 'Jam selesai harus diisi.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'harga_lapangan.required' => 'Harga Lapangan harus diisi.',
            'harga_lapangan.numeric' => 'Harga lapangan harus berupa angka.',
            'status.required' => 'Status harus diisi.',
        ]);

        $jadwal = jadwal_lapangan::where('id',$id_jadwal)->firstOrFail();
        $jadwal->jam_mulai =  $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->harga = $request->harga_lapangan;
        $jadwal->status = $request->status;

        if ($jadwal->isDirty()){
            if ($jadwal->save()) {
                return redirect()->back()->with([
                    'notifikasi'=>"Berhasil mengubah data jadwal lapangan!",
                    "type"=>"success"
                ]);
            }else{
                return redirect()->back()->with([
                    'notifikasi'=>"Gagal mengubah data jadwal lapangan!",
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

    public function hapusJadwalLapangan($id_jadwal){
        $jadwal = jadwal_lapangan::where('id',$id_jadwal);
        if ($jadwal->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($jadwal->first()->delete()) {
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
