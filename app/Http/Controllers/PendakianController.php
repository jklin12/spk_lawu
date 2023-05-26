<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Logistik;
use App\Models\MasterLogistik;
use App\Models\Pendakian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendakianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user()->is_admin) {
            $pendakians = Pendakian::get();
        } else {
            $pendakians = Pendakian::where('user_id', Auth::user()->id)->get();
        }


        $laod['pendakians'] = $pendakians;

        return view('pages.pendakian.index', $laod);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $laod['step'] = $request->step ?? 0;
        $laod['id'] = $request->id ?? '';
        $laod['anggota'] = $request->anggota ?? '';
        $laod['cities'] = \Indonesia::allCities();
        //dd($laod);

        return view('pages.pendakian.create', $laod);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        /*$this->validate($request, [
            'nama_kelompok' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'tanggal_pulang' => 'required|date',
            'jumlah_anggota' => 'required|integer',
        ]);
        $this->validate($request, [
            'pendakian_id' => 'required',
            'nama_anggota.*' => 'required|string',
            'alamat_anggota.*' => 'required|string',
            'jenis_kelamin_anggota.*' => 'required|string',
            'tempat_lahir_anggota.*' => 'required|string',
            'tanggal_lahir_anggota.*' => 'required|date',
            'telepon_anggota.*' => 'required|string',
        ]);*/
		
        $cekJadwal = Pendakian::where('tanggal_berangkat', $request->tanggal_berangkat)
            ->leftJoin('anggotas', 'pendakians.pendakian_id', '=', 'anggotas.pendakian_id')->count();
        //dd($cekJadwal);
        $postPendakian['user_id'] = Auth::user()->id;
        $postPendakian['ketua_nama'] = $request->data_pendakian['ketua_nama'];
        $postPendakian['ketua_jenis_kelamin'] = $request->data_pendakian['ketua_jenis_kelamin'];
        $postPendakian['ketua_telepon'] = $this->waFormat($request->data_pendakian['ketua_telepon']);
        $postPendakian['ketua_tempat_lahir'] = $request->data_pendakian['ketua_tempat_lahir'];
        $postPendakian['ketua_tgl_lahir'] = $request->data_pendakian['ketua_tgl_lahir'];
        $postPendakian['tanggal_berangkat'] = $request->data_pendakian['tanggal_berangkat'];
        $postPendakian['tanggal_pulang'] = $request->data_pendakian['tanggal_pulang'];
        $postPendakian['jumlah_anggota'] = $request->data_pendakian['jumlah_anggota'];
        $postPendakian['status'] = $cekJadwal <= 10 ?  'pengajuan' : 'ditolak';


        $create = Pendakian::create($postPendakian);

        $jumlahArrAnggota = $request->data_pendakian['jumlah_anggota'];
        $postAnggota = [];
        for ($i = 0; $i < $jumlahArrAnggota; $i++) {
            foreach ($request->data_anggota as $key => $value) {
                $postAnggota[$i]['pendakian_id'] = $create->pendakian_id;
                $postAnggota[$i][$key] = $value[$i];
                $postAnggota[$i]['telepon_anggota'] = $this->waFormat($value[$i]);
            }
        }
        Anggota::insert($postAnggota);

        //dd($postPendakian, $postAnggota);

       

        return redirect()->route('pendakian.index')->withSuccess('Tambah Pendakian Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendakian  $pendakian
     * @return \Illuminate\Http\Response
     */
    public function show(Pendakian $pendakian)
    {
        $load['pendakian'] = $pendakian;
        $anggotas = Anggota::where('pendakian_id', $pendakian->pendakian_id)
            ->leftJoin('indonesia_cities', 'anggotas.tempat_lahir_anggota', '=', 'indonesia_cities.id')->get();
        $load['anggotas'] = $anggotas;
        $logistiks = Logistik::where('pendakian_id', $pendakian->pendakian_id)
            ->leftJoin('master_logistiks', 'logistiks.nama_barang', '=', 'master_logistiks.master_logistik_id')->get();
        $load['logistiks'] = $logistiks;

        $kota  = \Indonesia::findCity($pendakian->ketua_tempat_lahir, $with = null);
        $load['kota'] = $kota;
        $load['master_logistik'] = MasterLogistik::get();

        if (Auth::user()->is_admin) {
            $listWajib = MasterLogistik::where('master_logistik_wajib', 1)
                ->leftJoin('logistiks', 'master_logistiks.master_logistik_id', '=', 'logistiks.nama_barang')
                ->get();
            $pesanLogistik = "<p>Data logistik calon pendaki belum lengkap :</p><ul>";
            foreach ($listWajib as $key => $value) {
                if (!$value->id) {
                    $pesanLogistik .= '<li>' . $value->master_logistik_nama . ' Belum ada </li>';
                } elseif ($value->id && $value->master_logistik_jenis == 'Individu' && $value->jumlah_barang < $pendakian->jumlah_anggot) {
                    $pesanLogistik .= '<li> Jumlah ' . $value->master_logistik_nama . ' masih kurang ' . ($pendakian->jumlah_anggot - $value->jumlah_barang) . '</li>';
                }
            }
            $pesanLogistik .= "</ul>";
            //echo ($pesanLogistik);die;
            $load['pesan_logistik'] = $pesanLogistik;
        }

        //dd($laod);
        return view('pages.pendakian.show', $load);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendakian  $pendakian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendakian $pendakian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendakian  $pendakian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendakian $pendakian)
    {
        $pendakian->update($request->all());

        return redirect()->route('pendakian.show', $pendakian->pendakian_id)->withSuccess('Update Pendakianp Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendakian  $pendakian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendakian $pendakian)
    {
        //
    }

    public function ticket($id)
    {
        $pendakian = Pendakian::find($id);
        $anggotas = Anggota::where('pendakian_id', $pendakian->pendakian_id)
        	->leftJoin('indonesia_cities', 'anggotas.tempat_lahir_anggota', '=', 'indonesia_cities.id')->get();
	    return view('pages.pendakian.ticket', compact('pendakian', 'anggotas'));
  
    }

    private function waFormat($phoneNumber)
    {

        if (substr($phoneNumber, 0, 1) === '0' || substr($phoneNumber, 0, 1) != '62' ) {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        } else {
            $phoneNumber = $phoneNumber;
        }

        return $phoneNumber;
    }
}
