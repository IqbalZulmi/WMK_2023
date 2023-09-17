<?php

namespace App\Http\Controllers;

use App\Models\rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function updateRekeningPenyedia(Request $request, $id_penyedia_lapangan){
        $validatedData = $request->validate([
            'kode_bank' => 'required',
            'no_rekening' => 'required|numeric',
            'nama_rekening' => 'required',
        ], [
            'kode_bank.required' => 'Kode bank harus diisi.',
            'no_rekening.required' => 'Nomor rekening harus diisi.',
            'no_rekening.numeric' => 'Nomor rekening harus berupa angka.',
            'nama_rekening.required' => 'Nama rekening harus diisi.',
        ]);

        $rekening = Rekening::updateOrCreate(
            ['id_penyedia_lapangan' => $id_penyedia_lapangan],
            [
                'kode_bank' => $request->kode_bank,
                'no_rekening' => $request->no_rekening,
                'nama_rekening' => $request->nama_rekening,
            ]
        );

        if ($rekening->wasRecentlyCreated) {
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil menambahkan rekening',
                'type' => 'success'
            ]);
        } elseif ($rekening->wasChanged()) {
            if ($rekening->save()) {
                return redirect()->back()->with([
                    'notifikasi' => 'Berhasil mengubah rekening',
                    'type' => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    'notifikasi' => 'Gagal mengubah rekening',
                    'type' => 'error'
                ]);
            }
        } else {
            return redirect()->back()->with([
                'notifikasi' => 'Tidak ada perubahan!',
                'type' => 'info'
            ]);
        }
    }


}
