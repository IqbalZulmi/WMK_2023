<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user',
        'nama',
        'no_hp',
        'foto',
    ];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }

    public function pemesanan(){
        return $this->hasMany(pemesanan::class,'id_pelanggan');
    }
}
