<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumenspk;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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

    public static function setbilangan($bilangan)
    {
        $bilangan   = str_replace('Rp. ','',$bilangan);
        $bilangan   = str_replace(',','',$bilangan);
        $bilangan   = str_replace('.','',$bilangan);
        $bilangan   = trim($bilangan);
        $bilangan   = str_split($bilangan);
        $hasil      = NULL;
        $batas      = count($bilangan) - 3;
        for ($i=0; $i < count($bilangan); $i++) { 
            $hasil .= $bilangan[$i];
            if ($i == $batas) {
                $hasil .= '.';
            }
        }
        return trim($hasil);
    }
    
    public static function kuantitas($bilangan)
    {
        $bilangan = str_replace(',','.',$bilangan);
        return trim($bilangan);
    }
    public function store(Request $request)
    {
        $cekdokumenspk  = Dokumenspk::where('kontrak_id',$request->kontrak_id)->first();
        if ($cekdokumenspk) {
            Dokumenspk::where('kontrak_id',$request->kontrak_id)->delete();
        }
        $pekerjaan        = Kontrak::find($request->kontrak_id)->pekerjaan;
        if ($pekerjaan->jenis_pekerjaan == 'fisik') {
            // save untuk fisik
            $excel  = ['persiapan' => $request->data1,'pelaksanaan' => $request->data2,'pembantu' => $request->data3];
            foreach ($excel as $key => $value) {
                $data = json_decode($value);
                for ($i=0; $i < count($data); $i++) { 
                    if ($data[$i][0] <> '') {
                        Dokumenspk::create([
                            'kontrak_id' => $request->kontrak_id,
                            'label' => $key,
                             'uraian' => $data[$i][0],
                            'kuantitas' => self::kuantitas($data[$i][2]),
                            'satuan' => $data[$i][1],
                            'harga' => self::setbilangan($data[$i][3]),
                        ]);
                    }
                }
            }
        } else {
            // save untuk pekerjaan pelaksana
            $excel  = ['tenagaahli' => $request->data11,'tenagapendukung' => $request->data12,'biayasewa' => $request->data21,'biayarapat' => $request->data22,'biayakendaraan' => $request->data23,'biayapelaporan' => $request->data24];
            foreach ($excel as $key => $value) {
                $data = json_decode($value);
                for ($i=0; $i < count($data); $i++) { 
                    if ($data[$i][0] <> '' AND $data[$i][1] <> '' AND $data[$i][2] <> '' AND $data[$i][3] <> '' AND $data[$i][4] <> '') {
                        Dokumenspk::create([
                            'kontrak_id' => $request->kontrak_id,
                            'label' => $key,
                            'uraian' => $data[$i][0],
                            'kuantitas' => self::kuantitas($data[$i][1]),
                            'durasi' => self::kuantitas($data[$i][2]),
                            'satuan' => $data[$i][3],
                            'harga' => self::setbilangan($data[$i][4]),
                        ]);
                    }
                }
            }
        }
        $kontrak    = Kontrak::find($request->kontrak_id);
        if ($kontrak->status == 'selesai') {
            return redirect('kontrak/'.Crypt::encryptString($request->kontrak_id).'?s=rincian')->with('successv2','Dokumen SPK sudah ditambahkan');
        } else {
            return back()->with('successv2','Dokumen SPK sudah ditambahkan');
        }
        
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
