<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLogistik extends Model
{
    use HasFactory;
    protected $primaryKey = 'master_logistik_id';

    protected $fillable = [ 
        'master_logistik_jenis',
        'master_logistik_wajib',
        'master_logistik_nama', 
    ];
}
