@extends('layouts.admin')

@section('title')
    Data Perusahaan
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
                    <a href="{{ url('dokumenspk/create') }}" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru" ><i class="fas fa-plus"></i> Tambah</a>
                    <div class="float-right">
                        {{-- <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a> --}}
                        {{-- <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a> --}}
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div id="spreadsheet"></div>
                 
              </div>
            </div>
          </div>
        </div>
    </div>

    @endsection

    @section('script')
    // step 2: include aset-aset jExcel
    <script src="https://bossanova.uk/jexcel/v3/jexcel.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v3/jexcel.css" type="text/css"/>
    <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css"/>

    <script>


      // step 3: ubah data dari Controller menjadi JSON
      var data = @json($dokumenspk);

      // step 4: instansiasi jExcel dan definisikan kolom      
      $('#spreadsheet').jexcel({
        data: data,
        columns: [
          {type: 'text', title: 'Uraian', width: 200},
          {type: 'text', title: 'kuantitas', width: 200},
          {type: 'text', title: 'satuan', width: 200},
          {type: 'numeric', title: 'Harga', width: 300, mask: 'Rp#.##,00', decimal: ','},
        ]
      });
    </script>
    @endsection
