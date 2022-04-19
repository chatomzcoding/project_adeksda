<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Datapokok;
use App\Models\Timlokus;
use Illuminate\Http\Request;

class DatapokokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu       = 'datapokok';
        $datapokok  = Datapokok::first();
        $tim       = Timlokus::all();
        return view('admin.datapokok', compact('menu','datapokok','tim'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Datapokok  $datapokok
     * @return \Illuminate\Http\Response
     */
    public function show(Datapokok $datapokok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Datapokok  $datapokok
     * @return \Illuminate\Http\Response
     */
    public function edit(Datapokok $datapokok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Datapokok  $datapokok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Datapokok $datapokok)
    {
        Datapokok::where('id',$datapokok->id)->update([
            'nama_instansi' => $request->nama_instansi,
            'alamat_instansi' => $request->alamat_instansi,
            'kode_pos' => $request->kode_pos,
            'no_keputusan' => $request->no_keputusan,
            'tgl_keputusan' => $request->tgl_keputusan,
            'id_ppk' => $request->id_ppk,
            'id_pptk' => $request->id_pptk,
        ]);

        return back()->with('du','data pokok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Datapokok  $datapokok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Datapokok $datapokok)
    {
        //
    }
}
