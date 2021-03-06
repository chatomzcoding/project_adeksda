<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
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
        if (isset($request->photo)) {
             // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('photo');
            $photo = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'public/img/konsultan';
            // isi dengan nama folder tempat kemana file diupload
            $file->move($tujuan_upload,$photo);

            Progress::create([
                'kontrak_id' => $request->kontrak_id,
                'nilai' => $request->nilai,
                'nilai_panjang' => $request->nilai_panjang,
                'tanggal' => $request->tanggal,
                'photo' => $photo,
            ]);
        } else {
            Progress::create([
                'kontrak_id' => $request->kontrak_id,
                'nilai' => $request->nilai,
                'nilai_panjang' => $request->nilai_panjang,
                'tanggal' => $request->tanggal,
            ]);
        }

        return back()->with('ds','Progress');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function show(Progress $progress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function edit(Progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progress $progress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progress $progress)
    {
        deletefile('img/konsultan/'.$progress->photo);
        $progress->delete();
        return back()->with('dd','Progress');
    }
}
