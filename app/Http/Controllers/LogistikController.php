<?php

namespace App\Http\Controllers;

use App\Models\Logistik;
use Illuminate\Http\Request;

class LogistikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'pendakian_id' => 'required|string',
            'nama_barang' => 'required|string',
            'jumlah_barang' => 'required|string',
        ]);

        Logistik::create($request->all());

        return redirect()->route('pendakian.show', $request->pendakian_id)->withSuccess('Tambah Logistik Berhasil');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function show(Logistik $logistik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function edit(Logistik $logistik)
    {
        dd($logistik);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logistik $logistik)
    {
        $this->validate($request, [
            
            'nama_barang' => 'required|string',
            'jumlah_barang' => 'required|string',
        ]);
 
        $logistik->update($request->all());

        return redirect()->route('pendakian.show', $logistik->pendakian_id)->withSuccess('Edit Logistik Berhasil');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistik  $logistik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logistik $logistik)
    {
        $logistik->delete();
        return redirect()->route('pendakian.show', $logistik->pendakian_id)->withSuccess('Hapus Logistik Berhasil');;
    }
}
