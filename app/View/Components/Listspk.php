<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Listspk extends Component
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
        $judul  = ['I. Pekerjaan Persiapan','II. Pekerjaan Pelaksanaan','III. Pekerjaan Pembantu'];
        $jumlah = 0;
        foreach ($this->spk as $sesi) {
            $data   = [];
            $total  = 0;
            $no     = 1;
            foreach ($sesi as $key) {
                $harga  = str_replace('.00','',$key->harga);
                $harga  = str_replace(',','',$harga);
                $subtotal = $harga * $key->kuantitas;
                $data[] = [
                    $no,
                    $key->uraian,
                    $key->kuantitas,
                    $key->satuan,
                    norupiah($harga),
                    // $harga,
                    norupiah($subtotal),
                    // $subtotal,
                ];
                $total  = $total + $subtotal;
                $no++;
            }
            $list[] = [
                'judul' => $judul[$nomor],
                'data' => $data,
                'total' => norupiah($total)
            ];
            $jumlah = $jumlah + $total;
            $nomor++;
        }
        $ppn        = 10/100 * $jumlah;
        $nilai      = $jumlah + $ppn;
        $bulat      = round($nilai);
        $bulat      = str_replace('.00','',$bulat);
        $batas      = strlen($bulat) - 3;
        $bulat      = substr($bulat,0,$batas).'000';
        $result     = [
            'jumlah' => norupiah($jumlah),
            'ppn' => norupiah($ppn),
            'nilai' => norupiah($nilai),
            'bulat' => norupiah($bulat),
        ];
        return view('components.listspk', compact('list','result'));
    }
}
