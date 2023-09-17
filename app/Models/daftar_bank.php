<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daftar_bank extends Model
{
    use HasFactory;

    protected $table = 'daftar_banks';
    protected $primaryKey = 'kode_bank';
    protected $fillable = [
        'kode_bank',
        'nama_bank',
    ];

    public function rekening(){
        return $this->hasMany(rekening::class,'kode_bank');
    }

    protected $casts = [
        'kode_bank' => 'string',
    ];

}
