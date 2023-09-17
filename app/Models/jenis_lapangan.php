<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_lapangan extends Model
{
    use HasFactory;

    protected $table = 'jenis_lapangans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jenis_lapangan',
    ];

    public function lapangan(){
        return $this->hasMany(lapangan::class,'id_jenis_lapangan');
    }
}
