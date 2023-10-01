<?php

namespace App\Http\Controllers;

use App\Models\jadwal_lapangan;
use App\Models\jenis_lapangan;
use App\Models\lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LapanganController extends Controller
{
    public function showLapanganPage(){
        $user = Auth::user()->penyedia;
        $jenisLapangan = jenis_lapangan::all();
        $lapangan = lapangan::where('id_penyedia_lapangan',$user->id)->get();
        return view('penyedia_lapangan.lapangan',[
            'jenisLapangan' => $jenisLapangan,
            'dataLapangan' => $lapangan,
        ]);
    }

    public function tambahLapangan(Request $request){
        $validatedData = $request->validate([
            'nama_lapangan' => 'required',
            'jenis_lapangan' => 'required',
            'harga_lapangan' => 'required|numeric',
            'foto_lapangan' => 'required|image|mimes:jpeg,png,jpg|max:2048|file',
        ], [
            'nama_lapangan.required' => 'Nama lapangan harus diisi.',
            'jenis_lapangan.required' => 'Jenis lapangan harus diisi.',
            'foto_lapangan.required' => 'Foto lapangan harus diunggah.',
            'foto_lapangan.image' => 'Foto lapangan harus berupa file gambar.',
            'foto_lapangan.mimes' => 'Format file gambar yang diterima adalah JPEG, PNG, atau JPG.',
            'foto_lapangan.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
            'foto_lapangan.file' => 'Foto lapangan harus berupa file gambar.',
        ]);

        try {
            DB::beginTransaction();

            $lapangan = new lapangan();
            $lapangan->id_penyedia_lapangan = Auth::user()->penyedia->id;
            $lapangan->id_jenis_lapangan = $request->jenis_lapangan;
            $lapangan->nama_lapangan = $request->nama_lapangan;

            if ($request->hasFile('foto_lapangan')) {
                $old_foto = $lapangan->foto_lapangan;
                if (!empty($old_foto) && is_file('storage/'.$old_foto)) {
                    unlink('storage/'.$old_foto);
                }

                $foto = $request->file('foto_lapangan')->store('public/lapangan_img');
                $foto = basename($foto);
                $lapangan->foto_lapangan = $foto ? 'lapangan_img/' . $foto : null;
            } else {
                $foto = $lapangan->foto_lapangan;
            }
            $lapangan->save();

            $jamBuka = Carbon::createFromFormat('H:i:s', Auth::user()->penyedia->jam_buka);
            $jamTutup = Carbon::createFromFormat('H:i:s', Auth::user()->penyedia->jam_tutup);

            $jamMulai = $jamBuka;

            while ($jamMulai->lt($jamTutup)) {
                $jadwal = new jadwal_lapangan();
                $jadwal->id_lapangan = $lapangan->id;
                $jadwal->jam_mulai = $jamMulai->format('H:i:s');

                $jamMulai->addHour();
                $jadwal->jam_selesai = $jamMulai->format('H:i:s');

                $jadwal->harga = $request->harga_lapangan;
                $jadwal->save();
            }

            DB::commit();

            return redirect()->back()->with([
                'notifikasi' => 'Berhasil menambahkan lapangan',
                'type' => 'success',
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with([
                'notifikasi' => 'Gagal menambahkan lapangan',
                'type' => 'error',
            ]);
        }

    }

    public function editLapangan(Request $request, $id_lapangan) {
        $validatedData = $request->validate([
            'nama_lapangan' => 'required',
            'jenis_lapangan' => 'required',
            'harga_lapangan' => 'nullable|numeric',
            'foto_lapangan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|file',
        ], [
            'nama_lapangan.required' => 'Nama lapangan harus diisi.',
            'jenis_lapangan.required' => 'Jenis lapangan harus diisi.',
            'foto_lapangan.image' => 'Foto lapangan harus berupa file gambar.',
            'foto_lapangan.mimes' => 'Format file gambar yang diterima adalah JPEG, PNG, atau JPG.',
            'foto_lapangan.max' => 'Ukuran file gambar tidak boleh lebih dari 2MB.',
            'foto_lapangan.file' => 'Foto lapangan harus berupa file gambar.',
        ]);

        try {
            DB::beginTransaction();

            $lapangan = lapangan::where('id', $id_lapangan)->firstOrFail();
            $lapangan->id_jenis_lapangan = $request->jenis_lapangan;
            $lapangan->nama_lapangan = $request->nama_lapangan;

            if ($request->hasFile('foto_lapangan')) {
                $old_foto = $lapangan->foto_lapangan;
                if (!empty($old_foto) && is_file('storage/' . $old_foto)) {
                    unlink('storage/' . $old_foto);
                }

                $foto = $request->file('foto_lapangan')->store('public/lapangan_img');
                $foto = basename($foto);
                $lapangan->foto_lapangan = $foto ? 'lapangan_img/' . $foto : null;
            } else {
                $foto = $lapangan->foto_lapangan;
            }

            $lapangan->save();

            if ($request->has('harga_lapangan')) {
                $hargaBaru = $request->harga_lapangan;
            } else {
                $hargaBaru = null;
            }

            if ($hargaBaru !== null) {
                $jadwalLapangan = jadwal_lapangan::where('id_lapangan', $id_lapangan)->get();
                foreach ($jadwalLapangan as $jadwal) {
                    $jadwal->harga = $hargaBaru;
                    $jadwal->save();
                }
            }

            DB::commit();

            return redirect()->back()->with([
                'notifikasi' => 'Berhasil mengedit lapangan',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with([
                'notifikasi' => 'Gagal mengedit lapangan',
                'type' => 'error',
            ]);
        }
    }

    public function hapusLapangan($id_lapangan){
        $lapangan = lapangan::where('id',$id_lapangan);
        if ($lapangan->count() < 1) {
            return redirect()->back()->with([
                'notifikasi' =>'Data tidak ditemukan!',
                'type'=>'error'
            ]);
        }
        if ($lapangan->first()->delete()) {
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
