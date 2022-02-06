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
        dd($request->uraian);
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
