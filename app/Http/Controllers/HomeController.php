<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendakian;
use App\Models\Anggota;

class HomeController extends Controller
{
    public function index()
    {
        $totalPendaftaran = Pendakian::count();
        $totalPendaki = Pendakian::whereRaw("MONTH(tanggal_berangkat) = '".date('m')."'")
            ->leftJoin('anggotas', 'pendakians.pendakian_id', '=', 'anggotas.pendakian_id')->count();

       $jenisKelamin =  Pendakian::selectRaw("SUM(CASE WHEN jenis_kelamin_anggota = 'Laki-laki' THEN 1 ELSE 0 END) jumlah_laki,SUM(CASE WHEN jenis_kelamin_anggota = 'Perempuan' THEN 1 ELSE 0 END) jumlah_perempuan")->whereRaw("MONTH(tanggal_berangkat) = '".date('m')."'")
            ->leftJoin('anggotas', 'pendakians.pendakian_id', '=', 'anggotas.pendakian_id')->first();
        
        

        $load['total_pendaftaran'] = $totalPendaftaran;
        $load['total_pendaki'] = $totalPendaki;
        $load['jenis_kelamin'] = $jenisKelamin;

        return view('pages.home.index',$load);
    }
}
