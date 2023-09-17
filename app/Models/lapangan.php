<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_penyedia_lapangan',
        'id_jenis_lapangan',
        'nama_lapangan',
        'foto_lapangan',
    ];

    public function penyedia_lapangan(){
        return $this->belongsTo(penyedia_lapangan::class,'id_penyedia_lapangan');
    }

    public function jenis_lapangan(){
        return $this->belongsTo(jenis_lapangan::class,'id_jenis_lapangan');
    }

    public function jadwal_lapangan(){
        return $this->hasMany(jadwal_lapangan::class,'id_lapangan');
    }

    public function pemesanan(){
        return $this->hasMany(pemesanan::class,'id_lapangan');
    }
}
