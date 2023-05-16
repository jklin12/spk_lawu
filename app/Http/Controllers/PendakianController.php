<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Logistik;
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
        $postPendakian['ketua_telepon'] = $request->data_pendakian['ketua_telepon'];
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
            }
        }
        Anggota::insert($postAnggota);

        dd($postPendakian, $postAnggota);
      
        foreach ($request->data_anggota as $key => $value) {
            $postVal[$key]['pendakian_id'] = $request->pendakian_id;
            $postVal[$key]['nama_anggota'] = $value;
            $postVal[$key]['alamat_anggota'] = $request->alamat_anggota[$key];
            $postVal[$key]['jenis_kelamin_anggota'] = $request->jenis_kelamin_anggota[$key];
            $postVal[$key]['tempat_lahir_anggota'] = $request->tempat_lahir_anggota[$key];
            $postVal[$key]['tanggal_lahir_anggota'] = $request->tanggal_lahir_anggota[$key];
            $postVal[$key]['telepon_anggota'] = $request->telepon_anggota[$key];

            //dd($postVal);
           
        }
       

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
        $load['anggotas'] = Anggota::where('pendakian_id', $pendakian->pendakian_id)
        ->leftJoin('indonesia_cities','anggotas.tempat_lahir_anggota','=','indonesia_cities.id')->get();
        $load['logistiks'] = Logistik::where('pendakian_id', $pendakian->pendakian_id)->get();

        $kota  = \Indonesia::findCity($pendakian->ketua_tempat_lahir, $with = null);
        $load['kota'] = $kota;

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

        return redirect()->route('pendakian.show', $pendakian->pendakian_id)->withSuccess('Update Pendakianp Berhasil');;;;
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
        $anggotas = Anggota::where('pendakian_id', $id)->get();
        return view('pages.pendakian.ticket', compact('pendakian', 'anggotas'));
    }
}
