<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use App\Models\Timlokus;
use Illuminate\Http\Request;

class TimlokusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu       = 'timlokus';
        $timlokus   = Timlokus::all();
        $main       = [
            'link' => 'timteknis'
        ];
        return view('admin.timlokus.index', compact('menu','timlokus','main'));
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
        Timlokus::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'no_sk' => $request->no_sk,
            'tanggal' => $request->tanggal,
            'perihal' => $request->perihal,
        ]);

        // cek jika ditambahkan di create kontrak maka otomatis kontrak diupdate field timlokus_id
        $timlokus  = Timlokus::where('nip',$request->nip)->first();
        if (isset($request->id)) {
            Kontrak::where('id',$request->id)->update([
                $request->posisi => $timlokus->id
            ]);
            return back()->with('swalsuccess','Tim Lokus dengan NIP '.$request->nip.' atas nama '.$request->nama.' telah ditambahkan pada kontrak');
        }

        return back()->with('ds','Tim Lokus');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timlokus  $timlokus
     * @return \Illuminate\Http\Response
     */
    public function show(Timlokus $timlokus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timlokus  $timlokus
     * @return \Illuminate\Http\Response
     */
    public function edit(Timlokus $timlokus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timlokus  $timlokus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timlokus $timlokus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timlokus  $timlokus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timlokus $timlokus)
    {
        //
    }
}
