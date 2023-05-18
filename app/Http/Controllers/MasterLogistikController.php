<?php

namespace App\Http\Controllers;

use App\Models\MasterLogistik;
use Illuminate\Http\Request;

class MasterLogistikController extends Controller
{
    public function index()
    {
        $logistiks = MasterLogistik::get();


        return view('pages.master_logistik.index')->with(compact('logistiks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.master_logistik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'master_logistik_nama' => 'required',
            'master_logistik_wajib' => 'required',
            'master_logistik_jenis' => 'required',
        ]);

        MasterLogistik::create($request->all());

        return redirect(route('master_logistik.index'))->withSuccess('Tambah Master Logistik Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $logistik = MasterLogistik::find($id)->first();
        return view('pages.master_logistik.edit')->with(compact('logistik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'master_logistik_nama' => 'required',
            'master_logistik_wajib' => 'required',
            'master_logistik_jenis' => 'required',
        ]);

        MasterLogistik::find($id)->update($request->all());

        return redirect(route('master_logistik.index'))->withSuccess('Update Master Logistik Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MasterLogistik::find($id)->delete();

        return redirect(route('master_logistik.index'))->withSuccess('Hapus Master Logistik Berhasil');
    }
}
