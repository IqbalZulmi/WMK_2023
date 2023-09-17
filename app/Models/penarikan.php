<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penarikan extends Model
{
    use HasFactory;

    protected $table = 'penarikans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_penyedia_lapangan',
        'id_admin',
        'jumlah_penarikan',
        'bukti_pembayaran',
        'komentar',
        'status',
    ];

    public function penyedia_lapangan(){
        return $this->belongsTo(penyedia_lapangan::class,'id_penyedia_lapangan');
    }

    public function admin(){
        return $this->belongsTo(admin::class,'id_admin');
    }
}
