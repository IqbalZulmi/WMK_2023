<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penyedia_lapangan extends Model
{
    use HasFactory;

    protected $table = 'penyedia_lapangans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user',
        'nama_bisnis',
        'alamat',
        'deskripsi_lapangan',
        'jam_buka',
        'jam_tutup',
        'no_hp',
        'foto',
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function rekening(){
        return $this->hasOne(rekening::class,'id_penyedia_lapangan');
    }

    public function penarikan(){
        return $this->hasMany(penarikan::class,'id_penyedia_lapangan');
    }

    public function lapangan(){
        return $this->hasMany(lapangan::class,'id_penyedia_lapangan');
    }
}
