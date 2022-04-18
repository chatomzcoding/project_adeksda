<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bast;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu   = 'bast';
        $id = (isset($_GET['kontrak_id'])) ? $_GET['kontrak_id'] : NULL ;
        $bast   = DB::table('bast')
                    ->join('kontrak','bast.kontrak_id','=','kontrak.id')
                    ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                    ->join('perusahaan','kontrak.perusahaan_id','=','perusahaan.id')
                    ->select('bast.*','pekerjaan.nama_paket','perusahaan.nama_perusahaan')
                    ->orderBy('bast.id','DESC')
                    ->get();
                    $kontrak   = DB::table('kontrak')
                    ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                    ->select('kontrak.id','pekerjaan.nama_paket')
                    ->where('kontrak.status','selesai')
                    ->orderBy('pekerjaan.nama_paket','ASC')
                    ->get();
                    $dkontrak   = DB::table('kontrak')
                    ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                    ->select('kontrak.*','pekerjaan.*','kontrak.id as kontrak_id')
                    ->where('kontrak.id',$id)
                    ->first();
        $main   = [
            'link' => 'bast',
            'statistik' => [
                'total' => count($bast),
                'kontrak' => count($kontrak)
            ]
        ];
        $nomorbast  = self::nobast();
        return view('admin.bast.index', compact('menu','main','bast','kontrak','dkontrak','id','nomorbast'));
    }

    public static function nobast()
    {
        // cek nomor terakhir kontrak
        $kontrak    = Kontrak::where('no_bahp','<>',NULL)->orderBy('id','DESC')->first();
        $nomor      = explode('/',$kontrak->no_spl);
        $no_kontrak = $nomor[1];
        $no_kontrak = $no_kontrak + 0;
        $bast       = Bast::orderBy('id','DESC')->first();
        if ($bast) {
            $nomor      = explode('/',$bast->no_bast);
            $no_bast = $nomor[1];
            $no_bast = $no_bast + 0;
            if ($no_kontrak > $no_bast) {
                $no_urut = $no_kontrak;
            } else {
                $no_urut = $no_bast;
            }
        } else {
            $no_urut = $no_kontrak;
        }

        $no_urut = $no_urut + 1;

        if ($no_urut > 0 AND $no_urut < 10) {
            $urutan = '000'.$no_urut;
        }elseif ($no_urut > 9 AND $no_urut < 100) {
            $urutan = '00'.$no_urut;
        }elseif ($no_urut > 99 AND $no_urut < 1000) {
            $urutan = '0'.$no_urut;
        } else {
            $urutan = $no_urut;
        }
        $nomor = "610/".$urutan."/BAST/SDA";
        return $nomor;
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
        Bast::create($request->all());
        $bast   = Bast::where('no_bast',$request->no_bast)->first();
        return redirect('bast/'.$bast->id)->with('successv2','BAST berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bast  $bast
     * @return \Illuminate\Http\Response
     */
    public function show(Bast $bast)
    {
        $menu   = 'bast';
        $main   = [
            'link' => 'bast'
        ];
        $bast   = DB::table('bast')
            ->join('kontrak','bast.kontrak_id','=','kontrak.id')
            ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
            ->join('perusahaan','kontrak.perusahaan_id','=','perusahaan.id')
            ->select('bast.*','pekerjaan.*','perusahaan.*')
            ->where('bast.id',$bast->id)
            ->orderBy('bast.id','DESC')
            ->first();
        return view('admin.bast.show', compact('menu','main','bast'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bast  $bast
     * @return \Illuminate\Http\Response
     */
    public function edit(Bast $bast)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bast  $bast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bast $bast)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bast  $bast
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bast $bast)
    {
        $bast->delete();

        return back()->with('dd','BAST');
    }
}
