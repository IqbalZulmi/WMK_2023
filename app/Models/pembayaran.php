<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pemesanan',
        'id_admin',
        'tanggal_pembayaran',
        'bukti_pembayaran',
    ];
    
    public function pemesanan(){
        return $this->belongsTo(pemesanan::class,'id_pemesanan');
    }

    public function admin(){
        return $this->belongsTo(admin::class,'id_admin');
    }

}
