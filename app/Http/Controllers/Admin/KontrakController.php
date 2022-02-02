<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use App\Models\Pekerjaan;
use App\Models\Perusahaan;
use App\Models\Timlokus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KontrakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu   = 'kontrak';
        $main   = [
            'link' => 'kontrak'
        ];
        $kontrak    = Kontrak::all();

        return view('admin.kontrak.index', compact('menu','main','kontrak'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu   = 'kontrak';
        $main   = [
            'link' => 'kontrak',
            'kontrak' => FALSE,
            'collapse' => '1'
        ];

        return view('admin.kontrak.create', compact('menu','main'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->sesi) {
            case 'informasi':
                Kontrak::create([
                    'masa_kontrak' => $request->masa_kontrak,
                    'nilai_penawaran' => default_nilai($request->nilai_penawaran),
                    'nilai_terkoreksi' => default_nilai($request->nilai_terkoreksi),
                    'nilai_negosiasi' => default_nilai($request->nilai_negosiasi),
                    'nilai_pekerjaan' => default_nilai($request->nilai_pekerjaan),
                ]);
                $kontrak    = Kontrak::latest()->first();
                return redirect('kontrak/'.Crypt::encryptString($kontrak->id))->with('success','Informasi kontak sudah tersimpan, selanjutnya memilih tim lokus, pekerjaan dan perusahaan');
                break;
            case 'pendukung':
                Kontrak::where('id',$request->id)->update([
                    'pekerjaan_id' => $request->pekerjaan_id,
                    'perusahaan_id' => $request->perusahaan_id,
                    'id_ketua' => $request->id_ketua,
                    'id_sekretaris' => $request->id_sekretaris,
                    'id_anggota' => $request->id_anggota,
                ]);
                return redirect('kontrak/'.Crypt::encryptString($request->id))->with('success','Informasi pendukung sudah tersimpan');
                break;
            
            default:
                return 'sesi tidak ada';
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function show($kontrak)
    {
        $menu       = 'kontrak';
        $kontrak    = Kontrak::find(Crypt::decryptString($kontrak));
        $collapse   = 2;
        $collapse = ($kontrak->id_anggota <> NULL) ? 3 : 2 ;
        $main       = [
            'link' => 'kontrak/'.$kontrak,
            'kontrak' => $kontrak,
            'collapse' => $collapse,
            'timlokus' => Timlokus::all(),
            'pekerjaan' => Pekerjaan::all(),
            'perusahaan' => Perusahaan::all()
        ];

        return view('admin.kontrak.create', compact('menu','main'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrak $kontrak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontrak $kontrak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontrak  $kontrak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontrak $kontrak)
    {
        //
    }
}
