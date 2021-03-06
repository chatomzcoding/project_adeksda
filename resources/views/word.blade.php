@php
    header('Content-Type: application/vnd.msword');
    header('Content-Disposition: attachment; filename="data spk fisik.doc"');
    header('Cache-Control: private, max-age=0, must-revalidate');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data SPK FISIK</title>
    <style>
        @page {
            size: f4 landscape;
            margin: 1.25cm 1.5cm 1.5cm 1.5cm;
            font-family: Arial, Helvetica, sans-serif
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 0.38cm;
        }
        table {
            /* border-collapse: collapse; */
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
        .Break {
        clear:all;
        page-break-before:always;
        mso-special-character:line-break;
        }
        </style>
</head>
<body>
    <div class="container">
        <table class="noborder" style="margin-bottom: 0px;">
            <tr>
                <td width="20%">
                    <img src="{{ asset('img/logo-mini.png') }}" alt="" class="gambar">
                </td>
                <td class="text-center">
                    <span class="f14">PEMERINTAH KOTA TASIKMALAYA </span> <br>
                    <strong class="f16">DINAS PEKERJAAN UMUM DAN TATA RUANG </strong> <br>
                    <span class="f10">Jalan Noenoeng, Trisnaputra No. 5 Telp/Faks. (265) 342631 <br>
                    TASIKMALAYA </span>
                </td>
            </tr>
        </table>
        <hr class="garis">
        <main style="margin-top: 10px">
            <section>
                <table>
                    <tr>
                        <td rowspan="2" colspan="4" width="50%" class="text-center">
                            <span class="f16">SURAT PERINTAH KERJA <br> (SPK) </span> <br> <br>
                            <span>Halaman 1 dari 2</span>
                        </td>
                        <td colspan="3">
                            <span>
                                SATUAN KERJA PPK : <br>
                                BIDANG SUMBER DAYA AIR <br>
                                DINAS PEKERJAAN UMUM DAN TATA RUANG <br>
                                KOTA TASIKMALAYA
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span>SURAT PERINTAH KERJA (SPK) Nomor : {{ $main['kontrak']->no_spk }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" colspan="4" class="text-center">
                            <span class="f16">PAKET PEKERJAAN : <br> {{ $main['kontrak']->pekerjaan->nama_paket }} </span>
                        </td>
                        <td colspan="3">
                            <span>
                                Dokumen Pengadaan Nomor : {{ $main['kontrak']->no_pengadaan }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <span>Berita Acara Hasil Pelelangan Nomor : {{ $main['kontrak']->no_bahp }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <span>
                                SUMBER DANA : {{ $main['kontrak']->pekerjaan->sumber_dana }} Tahun Anggaran {{ $main['kontrak']->pekerjaan->tahun_anggaran }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <span>
                                WAKTU PELAKSANAAN PEKERJAAN : {{ $main['kontrak']->masa_kontrak }} ({{ terbilang($main['kontrak']->masa_kontrak) }}) hari kalender
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <span>
                                NILAI PEKERJAAN : {{ rupiah($main['kontrak']->nilai_pekerjaan) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Uraian Pekerjaan</th>
                        <th>Kuantitas</th>
                        <th>Satuan Ukuran</th>
                        <th>Harga Satuan <br> (Rp)</th>
                        <th>Sub Total <br> (Rp)</th>
                        <th>Total <br> (Rp)</th>
                    </tr>
                    @foreach ($dataspk['data'] as $item)
                        <tr>
                            <th colspan="6" class="text-left">{{ $item['judul'] }}</th>
                            <th class="text-right">{{ $item['total'] }}</th>
                        </tr>
                        @foreach ($item['data'] as $i)
                            <tr class="f11">
                                <td class="text-center">{{ $i[0] }}</td>
                                <td>{{ $i[1] }}</td>
                                <td class="text-center">{{ $i[2] }}</td>
                                <td class="text-center">{{ $i[3] }}</td>
                                <td class="text-right">{{ norupiah($i[4]) }}</td>
                                <td class="text-right">{{ norupiah($i[5]) }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2">Jumlah</td>
                        <td>{{ $dataspk['hasil']['jumlah'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2">PPN 10%</td>
                        <td>{{ $dataspk['hasil']['jumlah'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2">NILAI</td>
                        <td>{{ $dataspk['hasil']['nilai'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2">DIBULATKAN</td>
                        <td>{{ $dataspk['hasil']['bulat'] }}</td>
                    </tr>
                </table>
            </section>
            <div class="Break"></div>
            <section>
                
            </section>
        </main>

    </div>
</body>
</html>
