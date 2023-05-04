<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendakian extends Model
{
    use HasFactory;

    protected $primaryKey = 'pendakian_id';

    protected $fillable = [
        'user_id',
        'nama_kelompok',
        'tanggal_berangkat',
        'tanggal_pulang',
        'jumlah_anggota',
        'status',
    ];
}
