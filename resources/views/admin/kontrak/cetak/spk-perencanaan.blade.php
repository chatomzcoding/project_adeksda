@php
    header('Content-Type: application/vnd.msword');
    header('Content-Disposition: attachment; filename="data spk perencanaan.doc"');
    header('Cache-Control: private, max-age=0, must-revalidate');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data SPK KONSULTAN</title>
    <style type="text/css">
        @page {
        /* size: f4 Portrait; */
        size: 21cm 33cm;
        mso-page-orientation:Portrait;
        margin: 1.25cm 1.5cm 1.5cm 1.5cm;
        font-family: Arial, Helvetica, sans-serif
    }
    @page Section1 {
        margin:0.75in 0.75in 0.75in 0.75in;
        size: 21cm 33cm;
        /* size:595.45pt 841.7pt; */
        mso-page-orientation:Portrait;
        mso-header-margin:0.5in;
        mso-header: h1;
        mso-footer-margin:0.5in;
        mso-footer: f1;
    }

    div.Section1 {page:Section1;}

    p.headerFooter { margin:0in; text-align: center; }
    body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.35cm;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
        }
        .text-danger {
            color: red;
        }
        .gambar {
            width: 50px;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .text-right {
            text-align: right;
        }
        .noborder table{
            border: 1px solid white;
        }
        .noborder th{
            border: 1px solid white;
        }
        .noborder td{
            border: 1px solid white;
        }
        .line {
            border-bottom: 3px solid black;
        }
        .f16 {
            font-size: 0.57cm;
        }
        .f14 {
            font-size: 0.5cm;
        }
        .f11 {
            font-size: 0.38cm;
        }
        .f10 {
            font-size: 0.35cm;
        }
        .garis {
            border-style: double;
            border-color: black;
            border-width: 2px;
            margin-bottom: 20px;
            margin-top: 0px;
        }
    </style>
</head>
<body>
    <div class=Section1>
        <table style='margin-left:50in;'>
            <tr style='height:1pt;mso-height-rule:exactly'>
                <td>
                    <div style='mso-element:header' id=h1>
                        <p class=headerFooter>
                            <table class="noborder" style="margin-bottom: 0px;">
                                <tr>
                                    <td width="20%" rowspan="2">
                                        <img src="{{ asset('img/logo-mini.png') }}" alt="" class="gambar">
                                    </td>
                                    <td class="text-center">
                                        <span class="f14">PEMERINTAH KOTA TASIKMALAYA </span> <br>
                                        <strong class="f16">DINAS PEKERJAAN UMUM DAN TATA RUANG </strong> <br>
                                        <span class="f10">Jalan Noenoeng, Trisnaputra No. 5 Telp/Faks. (265) 342631 <br>
                                        TASIKMALAYA </span>
                                    </td>
                                </tr>
                                <tr class="line">
                                    <td class="text-right f10" colspan="2">Kode Pos : 46115</td>
                                </tr>
                            </table>
                            <hr class="garis">
                        </p>
                    </div>
                    &nbsp;
                </td>
            </tr>
        </table>
        <main style="margin-top: 10px">
            <section>
                <table>
                    <tr>
                        <td colspan="5" width="50%" class="text-center">
                            <span class="f14">SURAT PERINTAH KERJA <br> (SPK) </span>
                        </td>
                        <td colspan="3" rowspan="2">
                                SATUAN KERJA PPK : <br>
                                BIDANG SUMBER DAYA AIR <br>
                                DINAS PEKERJAAN UMUM DAN TATA RUANG <br>
                                KOTA TASIKMALAYA
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="5">Halaman 1</td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            KEGIATAN : {{ $main['kontrak']->pekerjaan->nama_kegiatan }}
                        </td>
                        <td colspan="3">
                            <span>SURAT PERINTAH KERJA (SPK) Nomor : {{ $main['kontrak']->no_spk }} Tanggal {{ date_indo($main['kontrak']->tgl_spk) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" colspan="5" class="text-center">
                            <span class="f14">PAKET PEKERJAAN : {{ $main['kontrak']->pekerjaan->nama_paket }} </span>
                        </td>
                        <td colspan="3">
                            <span>
                                Dokumen Pengadaan Nomor : {{ $main['kontrak']->no_pengadaan }} Tanggal {{ date_indo($main['kontrak']->tgl_pengadaan) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span>Berita Acara Hasil Pemilihan Nomor : {{ $main['kontrak']->no_bahp }} Tanggal {{ date_indo($main['kontrak']->tgl_bahp) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-center">
                            <span>
                                SUMBER DANA : {{ $main['kontrak']->pekerjaan->sumber_dana }} Tahun Anggaran {{ $main['kontrak']->pekerjaan->tahun_anggaran }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-center">
                            <span>
                                WAKTU PELAKSANAAN PEKERJAAN : {{ $main['kontrak']->masa_kontrak }} ({{ terbilang($main['kontrak']->masa_kontrak) }}) hari kalender
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-center">
                            <span>
                                NILAI PEKERJAAN : Rp. {{ rupiah($main['kontrak']->nilai_pekerjaan) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Uraian Pekerjaan</th>
                        <th colspan="3">Volume</th>
                        <th rowspan="2">Satuan</th>
                        <th rowspan="2">Harga Satuan <br> (Rp)</th>
                        <th rowspan="2">Jumlah Biaya <br> (Rp)</th>
                    </tr>
                    <tr>
                        <th>Personil</th>
                        <th>Durasi</th>
                        <th>MM</th>
                    </tr>
                    @php
                        $nomor = 0;
                    @endphp
                    @foreach ($dataspk['data'] as $item)
                        <tr>
                            <th class="text-center">{{ $item['label'] }}</th>
                            <th colspan="7" class="text-left">{{ $item['judul'] }}</th>
                        </tr>
                        @foreach ($item['data'] as $i)
                            <tr>
                                <th>{{ $i['no'] }}</th>
                                <th colspan="7" class="text-left">{{ $i['judul'] }}</th>
                            </tr>
                            @foreach ($i['data'] as $j)
                                <tr>
                                    <td></td>
                                    <td>{{ $j[0] }}</td>
                                    <td class="text-center">{{ $j[1] }}</td>
                                    <td class="text-center">{{ $j[2] }}</td>
                                    <td class="text-center">{{ $j[3] }}</td>
                                    <td class="text-center">{{ $j[4] }}</td>
                                    <td class="text-right">{{ norupiah($j[5]) }}</td>
                                    <td class="text-right">{{ norupiah($j[6]) }}</td>
                                </tr>
                            @endforeach
                            <tr style="background-color: #bbb">
                                <th class="text-center" colspan="7">Jumlah {{ romawi($nomor) }}</th>
                                <th class="text-right">{{ norupiah($i['jumlah']) }}</th>
                            </tr>
                            @php
                                $nomor++
                            @endphp
                        @endforeach
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" class="text-center">Jumlah</td>
                        <td class="text-right">{{ $dataspk['hasil']['jumlah'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" class="text-center">PPN 10%</td>
                        <td class="text-right">{{ $dataspk['hasil']['jumlah'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" class="text-center">NILAI</td>
                        <td class="text-right">{{ $dataspk['hasil']['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" class="text-center">DIBULATKAN</td>
                        <td class="text-right">{{ norupiah($dataspk['hasil']['bulat']) }}</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-center">Terbilang : {{ ucwords(terbilang($dataspk['hasil']['bulat'])) }} Rupiah</td>
                    </tr>
                </table>
            </section>
        </main>
    </div>
{{-- <br clear=all style='mso-special-character:line-break; page-break-before:always'>
This is page 2 --}}
</body>
</html>
