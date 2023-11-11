<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metode_pembayaran extends Model
{
    use HasFactory;

    protected $table = 'metode_pembayarans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_metode',
        'no_rekening',
        'kategori',
        'foto',
    ];

    public function pemesanan(){
        return $this->hasMany(pembayaran::class,'id_metode_pembayaran');
    }

}
