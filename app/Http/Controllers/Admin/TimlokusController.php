<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'link' => 'timlokus'
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
        Timlokus::create($request->all());

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
