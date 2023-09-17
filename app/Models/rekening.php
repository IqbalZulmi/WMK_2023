<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rekening extends Model
{
    use HasFactory;

    protected $table = 'rekenings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_bank',
        'id_penyedia_lapangan',
        'no_rekening',
        'nama_rekening',
    ];

    public function daftar_bank(){
        return $this->belongsTo(daftar_bank::class,'kode_bank');
    }

    public function penyedia_lapangan(){
        return $this->belongsTo(penyedia_lapangan::class,'id_penyedia_lapangan');
    }

}
