<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu   = 'perusahaan';
        $perusahaan     = Perusahaan::orderBy('id','DESC')->get();
        $main   = [
            'link' => 'perusahaan',
            'statistik' => [
                'total' => count($perusahaan)
            ]
        ];

        return view('admin.perusahaan.index', compact('menu','main','perusahaan'));
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
        Perusahaan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'direktur' => $request->direktur,
            'alamat' => $request->alamat,
            'bank' => $request->bank,
            'kantor_cabang' => $request->kantor_cabang,
            'no_rek' => $request->no_rek,
            'npwp' => $request->npwp,
            'no_akta' => $request->no_akta,
            'tanggal_akta' => $request->tanggal_akta,
            'nama_notaris' => $request->nama_notaris,
        ]);
         // cek jika ditambahkan di create kontrak maka otomatis kontrak diupdate field pekerjaan_id
         $perusahaan  = Perusahaan::where('nama_perusahaan',$request->nama_perusahaan)->orderBy('id','DESC')->first();
         if (isset($request->id)) {
             Kontrak::where('id',$request->id)->update([
                 'perusahaan_id' => $perusahaan->id
             ]);
             return back()->with('swalsuccess','Nama Perusahaan '.$request->nama_perusahaan.' telah ditambahkan pada kontrak');
         }
        return back()->with('ds','Perusahaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Perusahaan::where('id',$request->id)->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'direktur' => $request->direktur,
            'alamat' => $request->alamat,
            'bank' => $request->bank,
            'kantor_cabang' => $request->kantor_cabang,
            'no_rek' => $request->no_rek,
            'npwp' => $request->npwp,
            'no_akta' => $request->no_akta,
            'tanggal_akta' => $request->tanggal_akta,
            'nama_notaris' => $request->nama_notaris,
        ]);

        return back()->with('successv2','Perusahaan berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();
        return back()->with('successv2','Perusahaan berhasil dihapus');
    }
}
