<?php
// keuangan progress
if (! function_exists('keuanganprogress')) {
    function keuanganprogress($kontrak,$progress)
    {
        $nilai = $kontrak * $progress/100;
        return norupiah($nilai);
    }
}
// sisa anggaran
if (! function_exists('sisaanggaran')) {
    function sisaanggaran($kontrak,$progress)
    {
        $nilai = $kontrak * $progress/100;
        $nilai = $kontrak - $nilai;
        return norupiah($nilai);
    }
}
// fungsi untuk menampilkan notifikasi bahwa input wajib di isi 
if (! function_exists('cekvalue')) {
    function cekvalue($data,$field)
    {
        $result = NULL;
        if (isset($data->$field)) {
            $result     = $data->$field;
        }
        return $result;
    }
}
// fungsi untuk menampilkan notifikasi bahwa input wajib di isi 
if (! function_exists('cekpendukung')) {
    function cekpendukung($data)
    {
        $result = '<i class="fas fa-sync-alt"></i>';
        if (!is_null($data)) {
            $result     = '<i class="fas fa-check-circle"></i>';
        }
        return $result;
    }
}
// fungsi untuk menampilkan notifikasi bahwa input wajib di isi 
if (! function_exists('tgl_akhir_kontrak')) {
    function tgl_akhir_kontrak($tgl,$masakontrak)
    {
        $masakontrak    = $masakontrak - 1;
        $tgl = date('Y-m-d', strtotime('+'.$masakontrak.' days', strtotime($tgl))); //operasi penjumlahan tanggal sebanyak 6 hari
        return $tgl;
    }
}
// fungsi untuk menampilkan nip
if (! function_exists('nip')) {
    function nip($nip)
    {
        if (!is_null($nip)) {
            $result = substr($nip,0,8).' '.substr($nip,8,6).' '.substr($nip,14,1).' '.substr($nip,15,3);
            return $result;
        }
    }
}
// cek nilai angka
if (! function_exists('cek_nilai')) {
    function cek_nilai($angka)
    {
        $nilai  = str_replace(',','.',$angka);
        return $nilai;
    }
}

// fungsi untuk menampilkan notifikasi bahwa input wajib di isi 
if (! function_exists('datafilter')) {
    function datafilter($datalist,$datafilter)
    {
        $filter     = [];        
        $list       = $datalist;
        for ($i=0; $i < count($datafilter); $i++) { 
            // filter
            $f  = $datafilter[$i];
            $dfilter    = (isset($_GET[$f])) ? $_GET[$f] : 'semua' ;
            $filter[$f] = $dfilter;
            
            if ($dfilter <> 'semua') {
                $listbaru   = [];
                foreach ($list as $item) {
                    if ($item->$f == $dfilter) {
                        $listbaru[] = $item;
                    }
                }
                $list   = $listbaru;
            }
        }

        $result     = [
            'list' => $list,
            'filter' => $filter,
        ];
        return $result;
    }
}
// fungsi untuk menampilkan notifikasi bahwa input wajib di isi 
if (! function_exists('datafilterbaru')) {
    function datafilterbaru($datalist,$datafilter)
    {
        $filter     = [];        
        $list       = $datalist;
        for ($i=0; $i < count($datafilter); $i++) { 
            // filter
            $f  = $datafilter[$i];
            $dfilter    = (isset($_GET[$f])) ? $_GET[$f] : 'semua' ;
            $filter[$f] = $dfilter;
            
            if ($dfilter <> 'semua') {
                $listbaru   = [];
                foreach ($list as $item) {
                    // if ($item->$f == $dfilter) {
                    //     $listbaru[] = $item;
                    // }
                    // sumber dana
                    switch ($f) {
                        case 'tahun_anggaran':
                            if ($item->pekerjaan->tahun_anggaran == $dfilter) {
                                $listbaru[] = $item;
                            }
                            break;
                        case 'sumber_dana':
                            if ($item->pekerjaan->sumber_dana == $dfilter) {
                                $listbaru[] = $item;
                            }
                            break;
                        case 'jenis_pekerjaan':
                            if ($item->pekerjaan->jenis_pekerjaan == $dfilter) {
                                $listbaru[] = $item;
                            }
                            break;
                        case 'kecamatan':
                            if ($item->pekerjaan->kecamatan == $dfilter) {
                                $listbaru[] = $item;
                            }
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                }
                $list   = $listbaru;
            }
        }

        $result     = [
            'list' => $list,
            'filter' => $filter,
        ];
        return $result;
    }
}

