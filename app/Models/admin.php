<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
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

    public function pembayaran(){
        return $this->hasMany(pembayaran::class,'id_admin');
    }

    public function penarikan(){
        return $this->hasMany(penarikan::class,'id_admin');
    }

}
