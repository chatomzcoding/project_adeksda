<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumenspk;
use App\Models\Kategori;
use App\Models\Kontrak;
use App\Models\Kontrakakses;
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
        $user               = Auth::user();
        $totalkontrak       = Kontrak::count();
        $totalkontrakproses = Kontrak::where('status','proses')->count();
        $kontrak    = Kontrak::orderBy('id','DESC')->get();
        $kecamatan  = Kategori::where('label','kecamatan')->orderBy('nama','ASC')->get();
        $jenispekerjaan  = Kategori::where('label','jenis pekerjaan')->orderBy('nama','ASC')->get();
        $sumberdana  = Kategori::where('label','sumber dana')->orderBy('keterangan','ASC')->get();
        $perusahaan     = Perusahaan::all();

        $sesi = (isset($_GET['sesi'])) ? $_GET['sesi'] : 'admin' ;
        switch ($sesi) {
            case 'admin':
                $kontrak    = DB::table('kontrak')
                                ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                                ->where('kontrak.status','selesai')
                                ->select('kontrak.*','pekerjaan.*','kontrak.id as idkontrak')
                                ->orderByDesc('kontrak.id')
                                ->get();
                $main   = [
                    'link' => 'kontrak',
                    'statistik' => [
                        'total' => $totalkontrak,
                        'proses' => $totalkontrakproses
                    ]
                ];
                return view('admin.kontrak.index', compact('menu','main','kontrak','kecamatan','jenispekerjaan','sumberdana','perusahaan'));
                break;
            case 'proses':
                $kontrak    = Kontrak::where('status','proses')->orderBy('id','DESC')->get();
                $main   = [
                    'link' => 'kontrak',
                    'statistik' => [
                        'total' => $totalkontrak,
                        'proses' => $totalkontrakproses
                    ]
                ];
                return view('admin.kontrak.proses', compact('menu','main','kontrak'));
                break;
            case 'konsultan':
                $id = (isset($_GET['kontrak'])) ? $_GET['kontrak'] : NULL ;
                $dkontrak       = DB::table('kontrak')
                                    ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                                    ->where('kontrak.id',$id)
                                    ->select('pekerjaan.*','kontrak.*','kontrak.id as idkontrak')
                                    ->first();
                $kontrak        = DB::table('kontrak')
                                    ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                                    ->select('pekerjaan.nama_paket','kontrak.id')
                                    ->where('kontrak.status','selesai')
                                    ->where('pekerjaan.jenis_pekerjaan','fisik')
                                    ->get();
                $kontrakakses   = DB::table('kontrak_akses')
                                    ->join('kontrak','kontrak_akses.kontrak_id','=','kontrak.id')
                                    ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                                    ->where('kontrak_akses.user_id',$user->id)
                                    ->select('pekerjaan.*','kontrak.*','kontrak_akses.*','kontrak_akses.id as idakses')
                                    ->get();
                $main   = [
                    'link' => 'kontrak'
                ];
                
                return view('konsultan.kontrak.index', compact('menu','main','kontrak','kontrakakses','dkontrak','id'));
                break;
            case 'rekap':
                $menu       = 'rekap';
                $user       = User::where('level','konsultan')->get();
                $user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : 'semua' ;
                if ($user_id == 'semua') {
                    $kontrak    = DB::table('kontrak_akses')
                                    ->join('kontrak','kontrak_akses.kontrak_id','=','kontrak.id')
                                    ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                                    ->join('users','kontrak_akses.user_id','=','users.id')
                                    ->get();
                } else {
                    $kontrak    = DB::table('kontrak_akses')
                                    ->join('kontrak','kontrak_akses.kontrak_id','=','kontrak.id')
                                    ->join('pekerjaan','kontrak.pekerjaan_id','=','pekerjaan.id')
                                    ->join('users','kontrak_akses.user_id','=','users.id')
                                    ->where('users.id',$user_id)
                                    ->get();
                }
                
                $main   = [
                    'link' => 'kontrak',
                    'statistik' => [
                        'total' => Kontrak::count(),
                        'kontrakakses' => Kontrakakses::count()
                    ],
                    'f' => [
                        'user_id' => $user_id
                    ]
                ];
                return view('admin.kontrak.rekap', compact('menu','main','kontrak','user'));
                break;
            
            default:
                return redirect('dashboard','warningv2');
                break;
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
                return redirect('kontrak/'.Crypt::encryptString($kontrak->id))->with('success','Informasi kontak sudah tersimpan, selanjutnya memilih tim Teknis, pekerjaan dan perusahaan');
                break;
            case 'pendukung':
                $kontrak   = Kontrak::find($request->id);
                if (is_null($kontrak->no_sppbj)) {
                    // penambahan nomor 
                    $nomor          = self::kodeNomor($request->id,$request->pekerjaan_id);
                    $barpk = (isset($nomor['BARPK'])) ? $nomor['BARPK'] : NULL ;
                    $spp = (isset($nomor['SPP'])) ? $nomor['SPP'] : NULL ;
                    Kontrak::where('id',$request->id)->update([
                        'pekerjaan_id' => $request->pekerjaan_id,
                        'perusahaan_id' => $request->perusahaan_id,
                        'id_ketua' => $request->id_ketua,
                        'id_sekretaris' => $request->id_sekretaris,
                        'id_anggota' => $request->id_anggota,
                        'no_sppbj' => $nomor['SPPBJ'],
                        'no_barpk' => $barpk,
                        'no_spk' => $nomor['SPK'],
                        'no_spmk' => $nomor['SPMK'],
                        'no_spl' => $nomor['SPL'],
                        'no_spp' => $spp,
                    ]);
                } else {
                    Kontrak::where('id',$request->id)->update([
                        'pekerjaan_id' => $request->pekerjaan_id,
                        'perusahaan_id' => $request->perusahaan_id,
                        'id_ketua' => $request->id_ketua,
                        'id_sekretaris' => $request->id_sekretaris,
                        'id_anggota' => $request->id_anggota,
                    ]);
                }
                
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
                    'status' => 'selesai',
                ]);
                return redirect('kontrak/'.Crypt::encryptString($request->id).'?s=rincian')->with('successv2','Kontrak telah selesai dibuat. Berikut Rincian Kontrak tersebut');
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
                    'nama_kegiatan' => $pekerjaan->nama_kegiatan,
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
            'persiapan' => Dokumenspk::where('kontrak_id',$kontrak->id)->where('label','persiapan')->get(['uraian','satuan','kuantitas','harga']),
            'pelaksanaan' => Dokumenspk::where('kontrak_id',$kontrak->id)->where('label','pelaksanaan')->get(['uraian','satuan','kuantitas','harga']),
            'pembantu' => Dokumenspk::where('kontrak_id',$kontrak->id)->where('label','pembantu')->get(['uraian','satuan','kuantitas','harga']),
        ];

        if ($collapse == 4) {
            $collapse = (count($dokumenspk['persiapan']) > 0) ? 5 : 4 ;
        }

        // khusus SPK
        $kolomkosong    =  [['','','','','',], ['','','','','',], ['','','','','',]];
        $spkpersiapan = (count($dokumenspk['persiapan']) > 0) ? $dokumenspk['persiapan'] : $kolomkosong ;
        $spkpelaksanaan = (count($dokumenspk['pelaksanaan']) > 0) ? $dokumenspk['pelaksanaan'] : $kolomkosong ;
        $spkpembantu = (count($dokumenspk['pembantu']) > 0) ? $dokumenspk['pembantu'] : $kolomkosong ;

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
            'dokumenspk' => $dokumenspk,
            'spk' => [
                'persiapan' => $spkpersiapan,
                'pelaksanaan' => $spkpelaksanaan,
                'pembantu' => $spkpembantu,
            ]
        ];

        $kecamatan  = Kategori::where('label','kecamatan')->orderBy('nama','ASC')->get();
        $jenispekerjaan  = Kategori::where('label','jenis pekerjaan')->orderBy('nama','ASC')->get();
        $sumberdana  = Kategori::where('label','sumber dana')->orderBy('keterangan','ASC')->get();
        $s = (isset($_GET['s'])) ? $_GET['s'] : 'index' ;
        switch ($s) {
            case 'rincian':
                return view('admin.kontrak.show', compact('menu','main','kecamatan','jenispekerjaan','sumberdana'));
                break;
            case 'cetak':
                return self::cetak($kecamatan,$main,$jenispekerjaan,$sumberdana);
                break;
            
            default:
                return view('admin.kontrak.create', compact('menu','main','kecamatan','jenispekerjaan','sumberdana'));
                break;
        }
        

    }

    public static function cetak($kecamatan,$main,$jenispekerjaan,$sumberdana)
    {
        $folder     = 'kontrakfisik';
        if ($main['datapekerjaan']->jenis_pekerjaan == 'konsultan-pengawas') {
            $folder = 'kontrakpengawas';
        }
        switch ($_GET['file']) {
            case 'coverspk':
                $file   = 'public/file/'.$folder.'/cover-spk.rtf';
                $namafile   = 'Cover SPK '.tgl_sekarang();
                break;
            case 'spk':
                $file   = 'public/file/'.$folder.'/spk.rtf';
                $namafile   = 'SPK '.tgl_sekarang();
                break;
            case 'sp':
                $file   = 'public/file/'.$folder.'/sp.rtf';
                $namafile   = 'SP '.tgl_sekarang();
                break;
            case 'spmk':
                $file   = 'public/file/'.$folder.'/spmk.rtf';
                $namafile   = 'SPMK '.tgl_sekarang();
                break;
            case 'spl':
                $file   = 'public/file/'.$folder.'/spl.rtf';
                $namafile   = 'SPL '.tgl_sekarang();
                break;
            case 'barpk':
                $file   = 'public/file/'.$folder.'/barpk.rtf';
                $namafile   = 'BARPK '.tgl_sekarang();
                break;
            case 'sppbj':
                $file   = 'public/file/'.$folder.'/sppbj.rtf';
                $namafile   = 'SPPBJ '.tgl_sekarang();
                break;
            case 'sskk':
                $file   = 'public/file/'.$folder.'/sskk.rtf';
                $namafile   = 'SSKK-BANPROV '.tgl_sekarang();
                break;
                
            default:
                # code...
                break;
        }
        $document = file_get_contents($file);
        // kata / kalimat yang akan di ubah
        // KONTRAK 
        $document = str_replace("[masa_kontrak]", $main['kontrak']->masa_kontrak, $document);
        $document = str_replace("[terbilang_masakontrak]", terbilang($main['kontrak']->masa_kontrak), $document);
        $document = str_replace("[nilai_pekerjaan]", norupiah($main['kontrak']->nilai_pekerjaan), $document);
        $document = str_replace("[nilai_terkoreksi]", norupiah($main['kontrak']->nilai_terkoreksi), $document);
        $document = str_replace("[nilai_penawaran]", norupiah($main['kontrak']->nilai_penawaran), $document);
        $document = str_replace("[nilai_negosiasi]", norupiah($main['kontrak']->nilai_negosiasi), $document);
        $document = str_replace("[terbilang]", terbilang($main['kontrak']->nilai_pekerjaan), $document);
        $document = str_replace("[no_spk]", $main['kontrak']->no_spk, $document);
        $document = str_replace("[no_spp]", $main['kontrak']->no_spp, $document);
        $document = str_replace("[no_spl]", $main['kontrak']->no_spl, $document);
        $document = str_replace("[no_bahp]", $main['kontrak']->no_bahp, $document);
        $document = str_replace("[no_sppbj]", $main['kontrak']->no_sppbj, $document);
        $document = str_replace("[no_spmk]", $main['kontrak']->no_spmk, $document);
        $document = str_replace("[no_barpk]", $main['kontrak']->no_barpk, $document);
        $document = str_replace("[tgl_spk]", date_indo($main['kontrak']->tgl_spk), $document);
        $document = str_replace("[tgl_spp]", date_indo($main['kontrak']->tgl_spp), $document);
        $document = str_replace("[tgl_bahp]", date_indo($main['kontrak']->tgl_bahp), $document);
        $document = str_replace("[tgl_sppbj]", date_indo($main['kontrak']->tgl_sppbj), $document);
        $document = str_replace("[tgl_spmk]", date_indo($main['kontrak']->tgl_spmk), $document);
        $document = str_replace("[tgl_spl]", date_indo($main['kontrak']->tgl_spl), $document);
        $document = str_replace("[tgl_barpk]", date_indo($main['kontrak']->tgl_barpk), $document);
        $document = str_replace("[hari_tglspl]", 'Minggu', $document);
        $document = str_replace("[hari_tglspk]", 'Minggu', $document);
        $document = str_replace("[hari_tglbarpk]", 'Minggu', $document);
        $document = str_replace("[terbilang_tglbarpk]", 'terbilang tanggal barpk', $document);
        $document = str_replace("[terbilang_tglspl]", 'terbilang tanggal spl', $document);
        $document = str_replace("[terbilang_tglspk]", 'terbilang tanggal spk', $document);
        $document = str_replace("[nama_ketua]", $main['dataketua']->nama, $document);
        $document = str_replace("[nama_sekretaris]", $main['datasekretaris']->nama, $document);
        $document = str_replace("[nama_anggota]", $main['dataanggota']->nama, $document);
        // SSKK
        $nilai40  = $main['kontrak']->nilai_pekerjaan * 40/100;
        $nilai35  = $main['kontrak']->nilai_pekerjaan * 35/100;
        $nilai20  = $main['kontrak']->nilai_pekerjaan * 20/100;
        $nilai5  = $main['kontrak']->nilai_pekerjaan * 5/100;
        $document = str_replace("[nilai_pekerjaan40]", norupiah($nilai40), $document);
        $document = str_replace("[nilai_pekerjaan35]", norupiah($nilai35), $document);
        $document = str_replace("[nilai_pekerjaan20]", norupiah($nilai20), $document);
        $document = str_replace("[nilai_pekerjaan5]", norupiah($nilai5), $document);
        
        // PEKERJAAN
        $document = str_replace("[kode_kegiatan]", $main['datapekerjaan']->kode_kegiatan, $document);
        $document = str_replace("[kode_tender]", $main['datapekerjaan']->kode_tender, $document);
        $document = str_replace("[nama_kegiatan]", $main['datapekerjaan']->nama_kegiatan, $document);
        $document = str_replace("[sub_kegiatan]", $main['datapekerjaan']->sub_kegiatan, $document);
        $document = str_replace("[nama_paket]", $main['datapekerjaan']->nama_paket, $document);
        $document = str_replace("[kecamatan]", $main['datapekerjaan']->kecamatan, $document);
        $document = str_replace("[sumber_dana]", $main['datapekerjaan']->sumber_dana, $document);
        $document = str_replace("[tahun_anggaran]", $main['datapekerjaan']->tahun_anggaran, $document);
        
        // PERUSAHAAN
        $document = str_replace("[nama_perusahaan]", $main['dataperusahaan']->nama_perusahaan, $document);
        $document = str_replace("[direktur]", $main['dataperusahaan']->direktur, $document);
        $document = str_replace("[alamat]", $main['dataperusahaan']->alamat, $document);
        $document = str_replace("[bank]", $main['dataperusahaan']->bank, $document);
        $document = str_replace("[kantor_cabang]", $main['dataperusahaan']->kantor_cabang, $document);
        $document = str_replace("[no_rek]", $main['dataperusahaan']->no_rek, $document);
        $document = str_replace("[no_akta]", $main['dataperusahaan']->no_akta, $document);
        $document = str_replace("[tanggal_akta]", $main['dataperusahaan']->tanggal_akta, $document);
        $document = str_replace("[nama_notaris]", $main['dataperusahaan']->nama_notaris, $document);
        
        // MASTER
        $ppk    = Timlokus::where('status','ppk')->first();
        if ($ppk) {
            $nama_ppk = $ppk->nama;
            $nip_ppk = $ppk->nip;
        } else {
            $nama_ppk = 'nama ppk';
            $nip_ppk = 'nip ppk';
        }
        $document = str_replace("[nama_ppk]", $nama_ppk, $document);
        $document = str_replace("[nama_pptk]", 'Nama PPTK', $document);
        $document = str_replace("[nip_ppk]", $nip_ppk, $document);
        $document = str_replace("[no_keputusan]", '900/Kep.29 - BPKAD/2021', $document);
        $document = str_replace("[tgl_keputusan]", date_indo('2021-01-28'), $document);
        $document = str_replace("[hari_akhirkontrak]", 'Senin', $document);
        $document = str_replace("[tgl_akhirkontrak]", date_indo('2021-01-28'), $document);
        $document = str_replace("[status_uangmuka]", "YA/TIDAK", $document);
        


        // output
        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=".$namafile.".rtf");
        header("Content-length: " . strlen($document));
        echo $document;
    }

    public static function kodeNomor($kontrak_id,$pekerjaan_id)
    {
        $pekerjaan      = Pekerjaan::find($pekerjaan_id);
        $kode_kegiatan  = $pekerjaan->kode_kegiatan;
        $kontrakterakhir    = Kontrak::where('id','<>',$kontrak_id)->where('no_bahp','<>',NULL)->orderBy('id','DESC')->first();
        if ($pekerjaan->jenis_pekerjaan == 'fisik') {
            $list           = ['SPPBJ','BARPK','SPK','SPMK','SPL'];
        } else {
            $list           = ['SPPBJ','SPP','SPK','SPMK','SPL'];
        }
        $nomor          = [];
        if ($kontrakterakhir) {
            $nomorspp       = explode('/',$kontrakterakhir->no_spl);
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
                $nomor[$list[$i]] = '610/'.$urutan.'/'.$list[$i].'-'.$kode_kegiatan.'/SDA/'.$pekerjaan->tahun_anggaran;
            }
        } else {
            for ($i=0; $i < count($list); $i++) {
                $no         = $i + 1; 
                $nomor[$list[$i]] = '610/000'.$no.'/'.$list[$i].'-'.$kode_kegiatan.'/SDA/'.$pekerjaan->tahun_anggaran;
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
