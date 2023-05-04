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
        $pendakians = Pendakian::where('user_id', Auth::user()->id)->get();

        $laod['pendakians'] = $pendakians;

        return view('pages.pendakian.index',$laod);
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
        if ($request->step == 0) {
            $this->validate($request, [
                'nama_kelompok' => 'required|string',
                'tanggal_berangkat' => 'required|date',
                'tanggal_pulang' => 'required|date',
                'jumlah_anggota' => 'required|integer',
            ]);

            $postVal['user_id'] = Auth::user()->id;
            $postVal['nama_kelompok'] = $request->nama_kelompok;
            $postVal['tanggal_berangkat'] = $request->tanggal_berangkat;
            $postVal['tanggal_pulang'] = $request->tanggal_pulang;
            $postVal['jumlah_anggota'] = $request->jumlah_anggota;
            $postVal['status'] = 'pengajuan';

            $create = Pendakian::create($postVal);

            return redirect()->route('pendakian.create', 'id=' . $create->pendakian_id . '&anggota=' . $request->jumlah_anggota . '&step=1');
        } elseif ($request->step == 1) {
            //dd($request->all());
            $this->validate($request, [
                'pendakian_id' => 'required',
                'nama_anggota.*' => 'required|string',
                'alamat_anggota.*' => 'required|string',
                'jenis_kelamin_anggota.*' => 'required|string',
                'tempat_lahir_anggota.*' => 'required|string',
                'tanggal_lahir_anggota.*' => 'required|date',
                'telepon_anggota.*' => 'required|string',
            ]);

            $postVal = [];
            foreach ($request->nama_anggota as $key => $value) {
                $postVal[$key]['pendakian_id'] = $request->pendakian_id;
                $postVal[$key]['nama_anggota'] = $value;
                $postVal[$key]['alamat_anggota'] = $request->alamat_anggota[$key];
                $postVal[$key]['jenis_kelamin_anggota'] = $request->jenis_kelamin_anggota[$key];
                $postVal[$key]['tempat_lahir_anggota'] = $request->tempat_lahir_anggota[$key];
                $postVal[$key]['tanggal_lahir_anggota'] = $request->tanggal_lahir_anggota[$key];
                $postVal[$key]['telepon_anggota'] = $request->telepon_anggota[$key];
            }
            //dd($postVal);
            Anggota::insert($postVal);

            return redirect()->route('pendakian.index');
        }
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
        $load['anggotas'] = Anggota::where('pendakian_id',$pendakian->pendakian_id)->get();
        $load['logistiks'] = Logistik::where('pendakian_id',$pendakian->pendakian_id)->get();

        

        //dd($laod);
        return view('pages.pendakian.show',$load);
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
        //
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
}
