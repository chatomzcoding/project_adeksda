<?php

namespace App\View\Components;

use Illuminate\View\Component;

class listspkkonsultan extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $spk;

    public function __construct($spk)
    {
        $this->spk = $spk;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list   = [];
        $nomor  = 0;
        $judul  = [
            'tenagaahli' => 'Tenaga Ahli',
            'tenagapendukung' => 'Tenaga Pendukung',
            'biayasewa' => 'Biaya Sewa Peralatan dan Lapangan',
            'biayarapat' => 'Biaya Rapat',
            'biayakendaraan' => 'Biaya Kendaraan Operasinal',
            'biayapelaporan' => 'Biaya Pelaporan dan Pengadaan',
        ];

        $total = 0;
        foreach ($this->spk as $row) {
            if ($row->uraian <> '' || $row->uraian <> NULL) {
                $dharga = $row->harga;
                $dkuantitas     = $row->kuantitas;
                if (preg_match("/.00\z/i", $dharga)) {
                    $harga  = str_replace('.00','',$dharga);
                    $harga  = str_replace('.','',$harga);
                    $harga  = str_replace('.','',$harga);
                    $harga  = str_replace('.','',$harga);
                    $cek    = 1;
                } else {
                    $harga = $dharga;
                }
                if (preg_match('/,/', $dkuantitas)) {
                    $kuantitas  = str_replace(',','.',$dkuantitas);
                } else {
                    $kuantitas = $dkuantitas;
                }
                $mm         = $kuantitas;
                if (!is_null($row->durasi) AND $row->durasi <> "") {
                    $mm     = $row->durasi * $kuantitas;
                }
                $subtotal   = $harga * $mm;
                $list[$row->label][] = [ 
                    $row->uraian,
                    $kuantitas,
                    $row->durasi,
                    $row->satuan,
                    $mm,
                    norupiah($harga),
                    $subtotal,
                ];
                $total = $total + $subtotal;
            }
        }
        $personil   = [];
        $nonpersonil   = [];
        $no = 1;
        $nomor = 1;
        foreach ($judul as $key => $value) {
            if (isset($list[$key])) {
                $jumlah     = 0;
                foreach ($list[$key] as $row) {
                    $jumlah     = $jumlah + $row[6];
                }
                if ($key == 'tenagaahli' || $key == 'tenagapendukung') {
                    $personil[$key] = [
                        'no' => $no,
                        'data' => $list[$key],
                        'judul' => $value,
                        'jumlah' => $jumlah
                    ];
                    $no++;
                }else{
                    $nonpersonil[$key] = [
                        'no' => $nomor,
                        'data' => $list[$key],
                        'judul' => $value,
                        'jumlah' => $jumlah
                    ];
                    $nomor++;
                }
            }
        }
        $list   = [
            [
                'label' => 'A',
                'judul' => 'Biaya Langsung Personil',
                'data' => $personil
            ],
            [
                'label' => 'B',
                'judul' => 'Biaya Langsung Non Personil',
                'data' => $nonpersonil,
            ]
        ];

        $ppn        = 10/100 * $total;
        $nilai      = $total + $ppn;
        $bulat      = round($nilai);
        $bulat      = str_replace('.00','',$bulat);
        $batas      = strlen($bulat) - 3;
        $bulat      = substr($bulat,0,$batas).'000';
        $result     = [
            'jumlah' => norupiah($total),
            'ppn' => norupiah($ppn),
            'nilai' => norupiah($nilai),
            'bulat' => norupiah($bulat),
        ];
        return view('components.listspkkonsultan', compact('list','result'));
    }
}
