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
            'file' => 'required|file',
        ]);
	   

        $filename = '';
        if ($request->hasfile('file')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('file')->getClientOriginalName());
            $request->file('file')->move(public_path('logistik_file'), $filename);
        }
        $postVal['pendakian_id'] = $request->pendakian_id;
        $postVal['nama_barang'] = $request->nama_barang;
        $postVal['jumlah_barang'] = $request->jumlah_barang;
        $postVal['foto_barang'] = $filename;

        //dd($postVal);
        Logistik::create($postVal);

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
            //'file' => 'required|file',
        ]);



        $filename = '';
        if ($request->hasfile('file')) {
            $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $request->file('file')->getClientOriginalName());
            $request->file('file')->move(public_path('logistik_file'), $filename);
            $postVal['foto_barang'] = $filename;
        }

        $postVal['nama_barang'] = $request->nama_barang;
        $postVal['jumlah_barang'] = $request->jumlah_barang;

        $logistik->update($postVal);

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
