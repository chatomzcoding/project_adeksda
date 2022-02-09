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
        $menu = '';
        $dokumenspk = Dokumenspk::all(['uraian','kuantitas','satuan','harga']);
        return view('index', compact('menu','dokumenspk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = '';
        return view('tambah', compact('menu'));
        
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
        $datapekerjaan = json_decode($request->data1);
        for ($i=0; $i < count($datapekerjaan); $i++) { 
            if ($datapekerjaan[0] <> '') {
                Dokumenspk::create([
                    'kontrak_id' => $request->kontrak_id,
                    'label' => 'persiapan',
                    'uraian' => $datapekerjaan[$i][0],
                    'satuan' => $datapekerjaan[$i][1],
                    'kuantitas' => $datapekerjaan[$i][2],
                    'harga' => $datapekerjaan[$i][3],
                ]);
            }
        }
        // save untuk pekerjaan pelaksana
        $datapelaksanaan = json_decode($request->data2);
        for ($i=0; $i < count($datapelaksanaan); $i++) { 
            if ($datapelaksanaan[0] <> '') {
                Dokumenspk::create([
                    'kontrak_id' => $request->kontrak_id,
                    'label' => 'pelaksanaan',
                    'uraian' => $datapelaksanaan[$i][0],
                    'satuan' => $datapelaksanaan[$i][1],
                    'kuantitas' => $datapelaksanaan[$i][2],
                    'harga' => $datapelaksanaan[$i][3],
                ]);
            }
        }
        // save untuk pekerjaan pembantu
        $datapembantu = json_decode($request->data2);
        for ($i=0; $i < count($datapembantu); $i++) { 
            if ($datapembantu[0] <> '') {
                Dokumenspk::create([
                    'kontrak_id' => $request->kontrak_id,
                    'label' => 'pembantu',
                    'uraian' => $datapembantu[$i][0],
                    'satuan' => $datapembantu[$i][1],
                    'kuantitas' => $datapembantu[$i][2],
                    'harga' => $datapembantu[$i][3],
                ]);
            }
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
