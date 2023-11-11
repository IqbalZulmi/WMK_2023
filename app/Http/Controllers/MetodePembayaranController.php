<?php

namespace App\Http\Controllers;

use App\Models\metode_pembayaran;
use Illuminate\Http\Request;

class MetodePembayaranController extends Controller
{
    public function showMetodePembayaran(){
        $metodePembayaran = metode_pembayaran::all();

        $kategori = [];
        foreach ($metodePembayaran as $key => $value) {
            $kategori[] = $value->kategori;
        }

        $kategoriUnik = array_unique($kategori);

        return view("superadmin.metode_pembayaran", [
            "dataMetode"=> $metodePembayaran,
            'dataKategori' => $kategoriUnik,
        ]);

    }

    public function getMetodePembayaran(){
        try{
            $dompetDigital = metode_pembayaran::where('kategori','Dompet digital')->get();
            $bank = metode_pembayaran::where('kategori','Bank')->get();

            return response()->json([
                'notifikasi' => 'data berhasil diambil!',
                'type' => 'success',
                'dataDigital' => $dompetDigital,
                'dataBank' => $bank
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'notifikasi' => 'data gagal diambil!',
                'type' => 'danger',
                'errors'=> $e->getMessage()
            ],500);
        }
    }

    public function tambahMetodePembayaran(Request $request){
        $validatedData = $request->validate([
            'nama_metode' => 'required',
            'no_rekening' => 'required|numeric',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048|file',
            'kategori' => 'required'
        ], [
            'nama_metode.required' => 'Nama metode pembayaran harus diisi.',
            'no_rekening.required' => 'Nomor rekening harus diisi.',
            'kategori' => 'Kategori harus diisi.',
            'no_rekening.numeric' => 'Nomor rekening harus berupa angka.',
            'foto.required' => 'Foto harus diunggah.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto hanya boleh dalam format jpeg, png, atau jpg.',
            'foto.max' => 'Foto tidak boleh lebih besar dari 2MB.',
            'foto.file' => 'File yang diunggah harus berupa file yang valid.',
        ]);

        $metode = new metode_pembayaran();
        $metode->nama_metode = $request->nama_metode;
        $metode->no_rekening = $request->no_rekening;
        $metode->kategori = $request->kategori;
        if ($request->hasFile('foto')) {
            $old_foto = $metode->foto;
            if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                unlink('storage/'.$old_foto);
            }

            $foto = $request->file('foto')->store('public/metode_img');
            $foto = basename($foto);
            $metode->foto = $foto ? 'metode_img/' . $foto : null;
        }else{
            $foto = $metode->foto;
        }

        if ($metode->save()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil menambahkan metode!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal menambahkan metode!",
                "type"=>"error",
            ]);
        }
    }

    public function editMetodePembayaran(Request $request,$id_metode_pembayaran){
        $validatedData = $request->validate([
            'nama_metode' => 'required',
            'no_rekening' => 'required|numeric',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048|file',
            'kategori' => 'required'
        ], [
            'nama_metode.required' => 'Nama metode pembayaran harus diisi.',
            'no_rekening.required' => 'Nomor rekening harus diisi.',
            'kategori' => 'Kategori harus diisi.',
            'no_rekening.numeric' => 'Nomor rekening harus berupa angka.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Foto hanya boleh dalam format jpeg, png, atau jpg.',
            'foto.max' => 'Foto tidak boleh lebih besar dari 2MB.',
            'foto.file' => 'File yang diunggah harus berupa file yang valid.',
        ]);

        $metode = metode_pembayaran::where('id',$id_metode_pembayaran)->first();
        $metode->nama_metode = $request->nama_metode;
        $metode->no_rekening = $request->no_rekening;
        $metode->kategori = $request->kategori;
        if ($request->hasFile('foto')) {
            $old_foto = $metode->foto;
            if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                unlink('storage/'.$old_foto);
            }

            $foto = $request->file('foto')->store('public/metode_img');
            $foto = basename($foto);
            $metode->foto = $foto ? 'metode_img/' . $foto : null;
        }else{
            $foto = $metode->foto;
        }

        if ($metode->save()) {
            return redirect()->back()->with([
                'notifikasi'=>"Berhasil mengubah metode!",
                "type"=>"success"
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi'=>"Gagal mengubah metode!",
                "type"=>"error",
            ]);
        }
    }

    public function hapusMetodePembayaran($id_metode_pembayaran){
        $metode = metode_pembayaran::where('id',$id_metode_pembayaran);
        if ($metode->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($metode->first()->delete()) {
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
