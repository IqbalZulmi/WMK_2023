<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_lapangan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_lapangans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_lapangan',
        'jam_mulai',
        'jam_selesai',
        'harga',
        'status',
    ];

    public function pemesanan(){
        return $this->hasMany(rekening::class,'id_jadwal_lapangan');
    }

    public function lapangan(){
        return $this->belongsTo(lapangan::class,'id_lapangan');
    }
}
