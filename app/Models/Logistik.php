<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistik extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendakian_id',
        'nama_barang',
        'jumlah_barang', 
        'foto_barang', 
    ];
}
