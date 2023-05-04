<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'pendakian_id',
        'nama_anggota',
        'alamat_anggota',
        'jenis_kelamin_anggota',
        'tempat_lahir_anggota',
        'tanggal_lahir_anggota',
        'telepon_anggota',
    ];
}
