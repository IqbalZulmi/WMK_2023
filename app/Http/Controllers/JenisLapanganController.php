<?php

namespace App\Http\Controllers;

use App\Models\jenis_lapangan;
use Illuminate\Http\Request;

class JenisLapanganController extends Controller
{
    public function showJenisLapangan(){
        $jenisLapangan = jenis_lapangan::latest()->get();

        return view('superadmin.jenis-lapangan',[
            'dataJenisLapangan' => $jenisLapangan,
        ]);
    }

    public function tambahJenisLapangan(Request $request){
        $validatedData = $request->validate([
            'jenis_lapangan' => 'required',
        ], [
            'jenis_lapangan.required' => 'Jenis lapangan wajib diisi.',
        ]);

        $jenisLapangan = new jenis_lapangan();
        $jenisLapangan->jenis_lapangan = $request->jenis_lapangan;

        if ($jenisLapangan->save()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil menambahkan Jenis Lapangan!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal menambahkan Jenis Lapangan!",
                "type"=>"error",
            ]);
        }
    }

    public function editJenisLapangan(Request $request,$id_jenis_lapangan){
        $validatedData = $request->validate([
            'jenis_lapangan' => 'required',
        ], [
            'jenis_lapangan.required' => 'Jenis lapangan wajib diisi.',
        ]);

        $jenisLapangan = jenis_lapangan::where('id',$id_jenis_lapangan)->firstOrFail();
        $jenisLapangan->jenis_lapangan = $request->jenis_lapangan;

        if ($jenisLapangan->isDirty()){
            if ($jenisLapangan->save()) {
                return redirect()->back()->with([
                    'notifikasi'=>"Berhasil mengubah data jenis lapangan!",
                    "type"=>"success"
                ]);
            }else{
                return redirect()->back()->with([
                    'notifikasi'=>"Gagal mengubah data jenis lapangan!",
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

    public function hapusJenisLapangan($id_jenis_lapangan){
        $jenisLapangan = jenis_lapangan::where('id',$id_jenis_lapangan);

        if ($jenisLapangan->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($jenisLapangan->first()->delete()) {
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
