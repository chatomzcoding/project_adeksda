<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumenspk;
use Illuminate\Http\Request;

class DokumenspkController extends Controller
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
        $cekdokumenspk  = Dokumenspk::where('kontrak_id',$request->kontrak_id)->first();
        if ($cekdokumenspk) {
            Dokumenspk::where('kontrak_id',$request->kontrak_id)->delete();
        }
        // save untuk pekerjaan persiapan
        for ($i=0; $i < count($request->uraian1); $i++) { 
            Dokumenspk::create([
                'kontrak_id' => $request->kontrak_id,
                'label' => 'persiapan',
                'uraian' => $request->uraian1[$i],
                'satuan' => $request->satuan1[$i],
                'kuantitas' => $request->kuantitas1[$i],
                'harga' => $request->harga1[$i],
            ]);
        }
        // save untuk pekerjaan pelaksana
        for ($i=0; $i < count($request->uraian2); $i++) { 
            Dokumenspk::create([
                'kontrak_id' => $request->kontrak_id,
                'label' => 'pelaksana',
                'uraian' => $request->uraian2[$i],
                'satuan' => $request->satuan2[$i],
                'kuantitas' => $request->kuantitas2[$i],
                'harga' => $request->harga2[$i],
            ]);
        }
        // save untuk pekerjaan pembantu
        for ($i=0; $i < count($request->uraian3); $i++) { 
            Dokumenspk::create([
                'kontrak_id' => $request->kontrak_id,
                'label' => 'pembantu',
                'uraian' => $request->uraian3[$i],
                'satuan' => $request->satuan3[$i],
                'kuantitas' => $request->kuantitas3[$i],
                'harga' => $request->harga3[$i],
            ]);
        }

        return back()->with('successv2','Dokumen SPK sudah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokumenspk  $dokumenspk
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumenspk $dokumenspk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumenspk  $dokumenspk
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumenspk $dokumenspk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumenspk  $dokumenspk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumenspk $dokumenspk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumenspk  $dokumenspk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumenspk $dokumenspk)
    {
        //
    }
}
