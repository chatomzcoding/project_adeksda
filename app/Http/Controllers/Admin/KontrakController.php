<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
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
        $kecamatan  = Kategori::where('label','kecamatan')->orderBy('nama','ASC')->get();
        $jenispekerjaan  = Kategori::where('label','jenis pekerjaan')->orderBy('nama','ASC')->get();
        $sumberdana  = Kategori::where('label','sumber dana')->orderBy('keterangan','ASC')->get();
        $perusahaan     = Perusahaan::all();

        return view('admin.kontrak.index', compact('menu','main','kontrak','kecamatan','jenispekerjaan','sumberdana','perusahaan'));
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
            case 'updateinformasi':
                Kontrak::where('id',$request->id)->update([
                    'masa_kontrak' => $request->masa_kontrak,
                    'nilai_penawaran' => default_nilai($request->nilai_penawaran),
                    'nilai_terkoreksi' => default_nilai($request->nilai_terkoreksi),
                    'nilai_negosiasi' => default_nilai($request->nilai_negosiasi),
                    'nilai_pekerjaan' => default_nilai($request->nilai_pekerjaan),
                ]);
                return redirect('kontrak/'.Crypt::encryptString($request->id))->with('success','Informasi kontrak sudah tersimpan');
                break;
            case 'dokumen':
                Kontrak::where('id',$request->id)->update([
                    'no_pengadaan' => $request->no_pengadaan,
                    'tgl_pengadaan' => $request->tgl_pengadaan,
                    'no_bahp' => $request->no_bahp,
                    'tgl_bahp' => $request->tgl_bahp,
                    'no_sppbj' => $request->no_sppbj,
                    'tgl_sppbj' => $request->tgl_sppbj,
                    'no_barpk' => $request->no_barpk,
                    'tgl_barpk' => $request->tgl_barpk,
                    'no_spk' => $request->no_spk,
                    'tgl_spk' => $request->tgl_spk,
                    'no_spmk' => $request->no_spmk,
                    'tgl_spmk' => $request->tgl_spmk,
                    'no_spl' => $request->no_spl,
                    'tgl_spl' => $request->tgl_spl,
                    'no_spp' => $request->no_spp,
                    'tgl_spp' => $request->tgl_spp,
                ]);
                return redirect('kontrak/'.Crypt::encryptString($request->id))->with('success','Informasi dokumen sudah tersimpan');
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
        $nomor  = self::kodeNomor($kontrak);
        $main       = [
            'link' => 'kontrak/'.$kontrak,
            'kontrak' => $kontrak,
            'nomor' => $nomor,
            'collapse' => $collapse,
            'timlokus' => Timlokus::all(),
            'pekerjaan' => Pekerjaan::all(),
            'perusahaan' => Perusahaan::all(),
            'datapekerjaan' => Pekerjaan::find($kontrak->pekerjaan_id),
            'dataperusahaan' => Perusahaan::find($kontrak->perusahaan_id),
            'dataketua' => Timlokus::find($kontrak->id_ketua),
            'datasekretaris' => Timlokus::find($kontrak->id_sekretaris),
            'dataanggota' => Timlokus::find($kontrak->id_anggota),
        ];

        $kecamatan  = Kategori::where('label','kecamatan')->orderBy('nama','ASC')->get();
        $jenispekerjaan  = Kategori::where('label','jenis pekerjaan')->orderBy('nama','ASC')->get();
        $sumberdana  = Kategori::where('label','sumber dana')->orderBy('keterangan','ASC')->get();
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'index' ;
        switch ($s) {
            case 'rincian':
                return view('admin.kontrak.show', compact('menu','main','kecamatan','jenispekerjaan','sumberdana'));
                break;
            
            default:
                return view('admin.kontrak.create', compact('menu','main','kecamatan','jenispekerjaan','sumberdana'));
                break;
        }
        

    }

    public static function kodeNomor($kontrak)
    {
        if (is_null($kontrak->no_pengadaan)) {
            $kontrakterakhir    = Kontrak::where('id','<>',$kontrak->id)->where('no_pengadaan','<>',NULL)->latest()->first();
            if ($kontrakterakhir) {
                $nomor  = [
                    'sppbj' => '610/0007/SPPBJ-/SDA',
                    'barpk' => '610/0008/BARPK-/SDA',
                    'spk' => '610/0009/SPK-/SDA',
                    'spmk' => '610/0010/SPMK-/SDA',
                    'spl' => '610/0011/SPL-/SDA',
                    'spp' => '610/0012/SPP-/SDA',
                ];
            } else {
                $nomor  = [
                    'sppbj' => '610/0001/SPPBJ-/SDA',
                    'barpk' => '610/0002/BARPK-/SDA',
                    'spk' => '610/0003/SPK-/SDA',
                    'spmk' => '610/0004/SPMK-/SDA',
                    'spl' => '610/0005/SPL-/SDA',
                    'spp' => '610/0006/SPP-/SDA',
                ];
            }
        } else {
            $nomor  = [
                'sppbj' => $kontrak->no_sppbj,
                'barpk' => $kontrak->no_barpk,
                'spk' => $kontrak->no_spk,
                'spmk' => $kontrak->no_spmk,
                'spl' => $kontrak->no_spl,
                'spp' => $kontrak->no_spp,
            ];
        }
        

        return $nomor;
        
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
