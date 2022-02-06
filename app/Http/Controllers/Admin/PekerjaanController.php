<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Kontrak;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu   = 'pekerjaan';
        $main   = [
            'link' => 'pekerjaan'
        ];
        $pekerjaan  = Pekerjaan::all();
        $kecamatan  = Kategori::where('label','kecamatan')->orderBy('nama','ASC')->get();
        $jenispekerjaan  = Kategori::where('label','jenis pekerjaan')->orderBy('nama','ASC')->get();
        $sumberdana  = Kategori::where('label','sumber dana')->orderBy('keterangan','ASC')->get();

        return view('admin.pekerjaan.index', compact('menu','main','pekerjaan','kecamatan','sumberdana','jenispekerjaan'));
        
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
        Pekerjaan::create([
            'kode_kegiatan' => $request->kode_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'kode_tender' => $request->kode_tender,
            'nama_paket' => $request->nama_paket,
            'sub_kegiatan' => $request->sub_kegiatan,
            'kecamatan' => $request->kecamatan,
            'kode_belanja' => $request->kode_belanja,
            'sumber_dana' => $request->sumber_dana,
            'tahun_anggaran' => $request->tahun_anggaran,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
        ]);

        // cek jika ditambahkan di create kontrak maka otomatis kontrak diupdate field pekerjaan_id
        $pekerjaan  = Pekerjaan::where('kode_kegiatan',$request->kode_kegiatan)->where('kode_tender',$request->kode_tender)->where('kode_belanja',$request->kode_belanja)->orderBy('id','DESC')->first();
        if (isset($request->id)) {
            Kontrak::where('id',$request->id)->update([
                'pekerjaan_id' => $pekerjaan->id
            ]);
            return back()->with('swalsuccess','Pekerjaan dengan Kode Kegiatan '.$request->kode_kegiatan.' dan nama kegiatan '.$request->nama_kegiatan.' telah ditambahkan pada kontrak');
        }
        return back()->with('ds','Pekerjaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        //
    }
}
