<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumenspk;
use App\Models\Kategori;
use App\Models\Kontrak;
use App\Models\Pekerjaan;
use App\Models\Perusahaan;
use App\Models\Timlokus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

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
        $user       = Auth::user();
        $kontrak    = Kontrak::orderBy('id','DESC')->get();
        $kecamatan  = Kategori::where('label','kecamatan')->orderBy('nama','ASC')->get();
        $jenispekerjaan  = Kategori::where('label','jenis pekerjaan')->orderBy('nama','ASC')->get();
        $sumberdana  = Kategori::where('label','sumber dana')->orderBy('keterangan','ASC')->get();
        $perusahaan     = Perusahaan::all();

        if ($user->level == 'admin') {
            return view('admin.kontrak.index', compact('menu','main','kontrak','kecamatan','jenispekerjaan','sumberdana','perusahaan'));
            # code...
        } else {
            $id = (isset($_GET['kontrak'])) ? $_GET['kontrak'] : NULL ;
            $dkontrak       = DB::table('kontrak')
                                ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                                ->where('kontrak.id',$id)
                                ->select('pekerjaan.*','kontrak.id as idkontrak')
                                ->first();
            $kontrak        = DB::table('kontrak')
                                ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                                ->select('pekerjaan.*','kontrak.id as idkontrak')
                                ->get();
            $kontrakakses   = DB::table('kontrak_akses')
                                ->join('kontrak','kontrak_akses.kontrak_id','=','kontrak.id')
                                ->where('kontrak_akses.user_id',$user->id)
                                ->get();
            
            return view('konsultan.kontrak.index', compact('menu','main','kontrak','kontrakakses','dkontrak','id'));
        }
        

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
                // penambahan nomor 

                $nomor          = self::kodeNomor($request->id,$request->pekerjaan_id);
                Kontrak::where('id',$request->id)->update([
                    'pekerjaan_id' => $request->pekerjaan_id,
                    'perusahaan_id' => $request->perusahaan_id,
                    'id_ketua' => $request->id_ketua,
                    'id_sekretaris' => $request->id_sekretaris,
                    'id_anggota' => $request->id_anggota,
                    'no_sppbj' => $nomor[0],
                    'no_barpk' => $nomor[1],
                    'no_spk' => $nomor[2],
                    'no_spmk' => $nomor[3],
                    'no_spl' => $nomor[4],
                    'no_spp' => $nomor[5],
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
            case 'adendum':
                Kontrak::where('id',$request->id)->update([
                    'no_adendum' => $request->no_adendum,
                    'tgl_adendum' => $request->tgl_adendum,
                    'nilai' => $request->nilai,
                    'masakontrak_adendum' => $request->masakontrak_adendum,
                    'tgl_akhir_kontrak' => $request->tgl_akhir_kontrak,
                ]);
                return redirect('kontrak/'.Crypt::encryptString($request->id))->with('success','Kontrak telah selesai dibuat');
                break;
            
            default:
                return 'sesi tidak ada';
                break;
        }
    }

    public function ajax($sesi)
    {
        switch ($sesi) {
            case 'perusahaan':
                $perusahaan     = Perusahaan::find($_GET['id']);
                $result         = [
                    'direktur' => $perusahaan->direktur,
                    'alamat' => $perusahaan->alamat,
                    'bank' => $perusahaan->bank.' / '.$perusahaan->kantor_cabang,
                    'akta' => $perusahaan->no_akta.' / '.$perusahaan->tanggal_akta,
                    'npwp' => $perusahaan->npwp,
                    'notaris' => $perusahaan->nama_notaris,
                    'no_rek' => $perusahaan->no_rek,
                ];
                break;
            case 'pekerjaan':
                $pekerjaan     = Pekerjaan::find($_GET['id']);
                $result         = [
                    'kode_tender' => $pekerjaan->kode_tender,
                    'nama_paket' => $pekerjaan->nama_paket,
                    'sub_kegiatan' => $pekerjaan->sub_kegiatan,
                    'kode_belanja' => $pekerjaan->kode_belanja,
                    'kecamatan' => $pekerjaan->kecamatan,
                    'sumber_dana' => $pekerjaan->sumber_dana,
                    'tahun_anggaran' => $pekerjaan->tahun_anggaran,
                    'jenis_pekerjaan' => $pekerjaan->jenis_pekerjaan,
                ];
                break;
            
            default:
                $result = NULL;
                break;
        }
        echo json_encode($result);
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
        if ($collapse == 3) {
            $collapse = ($kontrak->tgl_bahp <> NULL) ? 4 : 3 ;
        }
        $dokumenspk     = [
            'persiapan' => Dokumenspk::where('kontrak_id',$kontrak->id)->where('label','persiapan')->get(),
            'pelaksana' => Dokumenspk::where('kontrak_id',$kontrak->id)->where('label','pelaksana')->get(),
            'pembantu' => Dokumenspk::where('kontrak_id',$kontrak->id)->where('label','pembantu')->get(),
        ];

        if ($collapse == 4) {
            $collapse = (count($dokumenspk['persiapan']) > 0) ? 5 : 4 ;
        }

        $main       = [
            'link' => 'kontrak/'.$kontrak,
            'kontrak' => $kontrak,
            'collapse' => $collapse,
            'timlokus' => Timlokus::all(),
            'pekerjaan' => Pekerjaan::all(),
            'perusahaan' => Perusahaan::all(),
            'datapekerjaan' => Pekerjaan::find($kontrak->pekerjaan_id),
            'dataperusahaan' => Perusahaan::find($kontrak->perusahaan_id),
            'dataketua' => Timlokus::find($kontrak->id_ketua),
            'datasekretaris' => Timlokus::find($kontrak->id_sekretaris),
            'dataanggota' => Timlokus::find($kontrak->id_anggota),
            'dokumenspk' => $dokumenspk
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

    public static function kodeNomor($kontrak_id,$pekerjaan_id)
    {
        $pekerjaan      = Pekerjaan::find($pekerjaan_id)->first();
        $kode_kegiatan  = $pekerjaan->kode_kegiatan;
        $kontrakterakhir    = Kontrak::where('id','<>',$kontrak_id)->where('no_spp','<>',NULL)->orderBy('id','DESC')->first();
        $list           = ['SPPBJ','BARPK','SPK','SPMK','SPL','SPP'];
        $nomor          = [];
        if ($kontrakterakhir) {
            $nomorspp       = explode('/',$kontrakterakhir->no_spp);
            $no_akhir       = $nomorspp[1];
            $no_akhir       = $no_akhir + 1;
            for ($i=0; $i < count($list); $i++) { 
                $no = $no_akhir + $i;
                if ($no > 0 AND $no < 10) {
                    $urutan = '000'.$no;
                }elseif ($no > 9 AND $no < 100) {
                    $urutan = '00'.$no;
                }elseif ($no > 99 AND $no < 1000) {
                    $urutan = '0'.$no;
                } else {
                    $urutan = $no;
                }
                $nomor[] = '610/'.$urutan.'/'.$list[$i].'-'.$kode_kegiatan.'/SDA';
            }
        } else {
            for ($i=0; $i < count($list); $i++) {
                $no         = $i + 1; 
                $nomor[] = '610/000'.$no.'/'.$list[$i].'-'.$kode_kegiatan.'/SDA';
            }
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
        $kontrak->delete();

        return back()->with('dd','Kontrak');
    }
}
