<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function cetak()
    {
        $file   = 'public/file/kontrakfisik/cover-spk.rtf';
        // membaca data dari form
 
        // membaca isi dokumen tempate surat.rtf
        // isi dokumen dinyatakan dalam bentuk string
        $namafile   = 'Surat Keterangan Usaha '.tgl_sekarang();
        $document = file_get_contents($file);
        $gambar = file_get_contents($file);

        // dd($document);
        
        // mereplace tanda %%%NAMA% dengan data nama dari form
        $document = str_replace("[no_spk]", 'Firman Setiawan', $document);
        
        // mereplace tanda %%%ALAMAT% dengan data alamat dari form, dst
        $document = str_replace("[judul_surat]", 'Surat Keterangan Usaha', $document);
        
        // $document = str_replace("%%WAKTU%%", $waktu, $document);
        
        // header untuk membuka file output RTF dengan MS. Word
        // nama file output adalah undangan.rtf
        
        header("Content-type: application/msword");
        header("Content-disposition: inline; filename=".$namafile.".rtf");
        header("Content-length: " . strlen($document));
        echo $document;
    }
}
