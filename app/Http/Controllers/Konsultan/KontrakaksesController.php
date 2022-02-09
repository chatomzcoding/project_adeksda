<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use App\Models\Kontrakakses;
use App\Models\Pekerjaan;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrakaksesController extends Controller
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
        Kontrakakses::create([
            'user_id' => Auth::user()->id,
            'kontrak_id' => $request->id,
            'tgl_ambil' => tgl_sekarang(),
            'nama_perusahaan' => $request->nama_perusahaan,
        ]);

        $kontrakakses   = Kontrakakses::where('kontrak_id',$request->id)->first();

        return redirect('/kontrakakses/'.$kontrakakses->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontrakakses  $kontrakakses
     * @return \Illuminate\Http\Response
     */
    public function show($kontrakakses)
    {
        $menu   = 'kontrak';
        $main   = [
            'link' => 'progress'
        ];
        $kontrakakses   = Kontrakakses::find($kontrakakses);
        $kontrak    = Kontrak::find($kontrakakses->kontrak_id);
        $pekerjaan  = Pekerjaan::find($kontrak->pekerjaan_id);
        $progress   = Progress::where('kontrak_id',$kontrak->id)->orderby('id','DESC')->get();

        return view('konsultan.kontrak.show', compact('menu','main','kontrakakses','kontrak','progress','pekerjaan'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontrakakses  $kontrakakses
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrakakses $kontrakakses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontrakakses  $kontrakakses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontrakakses $kontrakakses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontrakakses  $kontrakakses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontrakakses $kontrakakses)
    {
        //
    }
}
