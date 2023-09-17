<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pelanggan',
        'id_lapangan',
        'id_jadwal_lapangan',
        'tanggal_pemesanan',
        'total_harga',
        'komentar',
        'status',
    ];

    public function pelanggan(){
        return $this->belongsTo(pelanggan::class,'id_pelanggan');
    }

    public function lapangan(){
        return $this->belongsTo(lapangan::class,'id_lapangan');
    }

    public function jadwal_lapangan(){
        return $this->belongsTo(jadwal_lapangan::class,'id_jadwal_lapangan');
    }

    public function pembayaran(){
        return $this->hasOne(pembayaran::class,'id_pemesanan');
    }


}
