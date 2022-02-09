@extends('layouts.admin')

@section('title')
    Data Perusahaan
@endsection

@section('head')
<script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Perusahaan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Perusahaan</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
   
@section('content')
    
    <div class="container-fluid">
  
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                    <a href="#" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah</a>
                    <div class="float-right">
                        {{-- <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a> --}}
                        {{-- <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a> --}}
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <form action="{{  route('dokumenspk.store')}}" method="post" id="formMobil">
                        @csrf
                        <input type="hidden" name="data1" id="datapersiapan">
                        <input type="hidden" name="data2" id="datapelaksanaan">
                        <input type="hidden" name="data3" id="datapembantu">
                        <h2 class="ui header">Pekerjaan Persiapan</h2>
                        <div id="spreadsheet1"></div>
                        <div class="ui divider hidden"></div>
                        <h2 class="ui header">Pekerjaan Pelaksanaan</h2>
                        <div id="spreadsheet2"></div>
                        <div class="ui divider hidden"></div>
                        <h2 class="ui header">Pekerjaan Pembantu</h2>
                        <div id="spreadsheet3"></div>
                        <div class="ui divider hidden"></div>
                        <button type="submit" class="btn btn-primary">SIMPAN DATA</button>
                    </form>
              </div>
            </div>
          </div>
        </div>
    </div>

    @endsection

    @section('script')
    <script>
        var data1 = [
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
        // [ 'Crayons Crayola only (No Rose Art)', 2, 5.01, '=B1*C1' ],
        // [ 'Total', '=SUM(B1:B8)', '=ROUND(SUM(C1:C8), 2)', '' ],
        ];
        var data2 = [
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
        ];
        var data3 = [
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
            ['','','','',''],
        ];
 
        jspreadsheet(document.getElementById('spreadsheet1'), {
            data:data1,
            columns: [
                { type: 'text', title:'Uraian', width:'300' },
                { type: 'numeric', title:'kuantitas', width:'80' },
                { type: 'text', title:'Satuan', width:'80' },
                { type: 'text', title:'Harga', width:'120' },
                { type: 'text', title:'Sub Total', width:'200' },
            ],
            updateTable:function(instance, cell, col, row, val, label, cellName) {
                if (cell.innerHTML == 'Total') {
                    cell.parentNode.style.backgroundColor = '#fffaa3';
                }
                if (col == 1) {
                    kuantitas = cell.innerText;
                }
                if (col == 3) {
                    nilaiharga = cell.innerText;
                    nilaiharga = nilaiharga.replace(".00",'');
                    nilaiharga = nilaiharga.replace("Rp",'');
                    nilaiharga = nilaiharga.replace(/,/g,'');
                    // cell.innerHTML = formatRupiah(nilaiharga);
                    cell.innerHTML = nilaiharga;
                }
                if (col == 4) {
                    subtotal = kuantitas * nilaiharga;
                    cell.innerHTML = subtotal;
                }
            },
            columnSorting:false,
        });
        jspreadsheet(document.getElementById('spreadsheet2'), {
            data:data2,
            columns: [
                { type: 'text', title:'Uraian', width:'300' },
                { type: 'numeric', title:'kuantitas', width:'80' },
                { type: 'text', title:'Satuan', width:'80' },
                { type: 'text', title:'Harga', width:'120' },
                { type: 'text', title:'Sub Total', width:'200' },
            ],
            updateTable:function(instance, cell, col, row, val, label, cellName) {
                if (cell.innerHTML == 'Total') {
                    cell.parentNode.style.backgroundColor = '#fffaa3';
                }
                if (col == 1) {
                    kuantitas = cell.innerText;
                }
                if (col == 3) {
                    nilaiharga = cell.innerText;
                    nilaiharga = nilaiharga.replace(".00",'');
                    nilaiharga = nilaiharga.replace("Rp",'');
                    nilaiharga = nilaiharga.replace(/,/g,'');
                    // cell.innerHTML = formatRupiah(nilaiharga);
                    cell.innerHTML = nilaiharga;
                }
                if (col == 4) {
                    subtotal = kuantitas * nilaiharga;
                    cell.innerHTML = subtotal;
                }
            },
            columnSorting:false,
        });
        jspreadsheet(document.getElementById('spreadsheet3'), {
            data:data3,
            columns: [
                { type: 'text', title:'Uraian', width:'300' },
                { type: 'numeric', title:'kuantitas', width:'80' },
                { type: 'text', title:'Satuan', width:'80' },
                { type: 'text', title:'Harga', width:'120' },
                { type: 'text', title:'Sub Total', width:'200' },
            ],
            updateTable:function(instance, cell, col, row, val, label, cellName) {
                if (cell.innerHTML == 'Total') {
                    cell.parentNode.style.backgroundColor = '#fffaa3';
                }
                if (col == 1) {
                    kuantitas = cell.innerText;
                }
                if (col == 3) {
                    nilaiharga = cell.innerText;
                    nilaiharga = nilaiharga.replace(".00",'');
                    nilaiharga = nilaiharga.replace("Rp",'');
                    nilaiharga = nilaiharga.replace(/,/g,'');
                    // cell.innerHTML = formatRupiah(nilaiharga);
                    cell.innerHTML = nilaiharga;
                }
                if (col == 4) {
                    subtotal = kuantitas * nilaiharga;
                    cell.innerHTML = subtotal;
                }
            },
            columnSorting:false,
        });

        $(function () {
          $('#formMobil').submit(function (event) {
            $('#datapersiapan').val(JSON.stringify(data1));
            $('#datapelaksanaan').val(JSON.stringify(data2));
            $('#datapembantu').val(JSON.stringify(data3));
          });
        });
    </script>
    @endsection

