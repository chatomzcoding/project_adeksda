@extends('layouts.admin')

@section('title')
    Data Kontrak
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0 text-capitalize">Data Kontrak Fisik<br> <small>{{ $pekerjaan->nama_paket }}</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Detail Kontrak</li>
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
                {{-- <h3 class="card-title"></h3> --}}
                <a href="{{ url('kontrak?sesi=konsultan') }}" class="btn btn-outline-secondary btn-sm pop-info" title="kembali"><i class="fas fa-angle-double-left"></i> Kembali</a>
                <a href="#" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah Progress</a>

                    {{-- <div class="float-right">
                        <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a>
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a>
                    </div> --}}
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- <section class="mb-3">
                      <form action="{{ url($main['link']) }}" method="get">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <select name="kontrak" id="" class="form-control select2bs4"  style="width: 100%;" onchange="this.form.submit();">
                                    <option value="semua" selected="selected">-- Pilih Kontrak --</option>
                                    @foreach ($kontrak as $item)
                                        <option value="{{ $item->idkontrak }}" @if ($id == $item->idkontrak)
                                            selected
                                        @endif>{{ strtoupper($item->kode_kegiatan.' | '.$item->nama_kegiatan) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                  </section> --}}
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Aksi</th>
                                <th>Tanggal</th>
                                <th>Nilai Progress</th>
                                <th>Nilai Panjang</th>
                                <th>Dokumentasi</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($progress as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url($main['link'].'/'.$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm btn-flat">Aksi</button>
                                                <button type="button" class="btn btn-info btn-sm btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                  <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                  {{-- <a href="{{ url('kontrak/'.Crypt::encryptString($item->id)) }}" class="dropdown-item"><i class="fas fa-file text-primary" style="width: 25px"></i> DETAIL</a> --}}
                                                  <div class="dropdown-divider"></div>
                                                  <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button>
                                                </div>
                                            </div>
                                    </td>
                                      <td>{{ date_indo($item->tanggal) }}</td>                                        
                                      <td class="text-center">{{ $item->nilai }}%</td>                                        
                                      <td class="text-center">{{ $item->nilai_panjang }} m</td>                                        
                                      <td class="text-center">
                                          @if (!is_null($item->photo))
                                            <img src="{{ asset('img/konsultan/'.$item->photo) }}" alt="dokumentasi" width="100px">
                                         @endif
                                    </td>                                        
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5" class="font-italic">-- belum ada data --</td>
                                </tr>
                            @endforelse
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url('progress')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->id }}">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Progress</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tanggal Progress {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="date" name="tanggal" id="tanggal" maxlength="9" value="{{ old('tanggal') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nilai Progress (%) {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="number" name="nilai" id="nilai" maxlength="9" value="{{ old('nilai') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nilai Panjang (m){!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="number" name="nilai_panjang" id="nilai_panjang" maxlength="9" value="{{ old('nilai_panjang') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">photo (opsional)</label>
                        <div class="col-md-8 p-0">
                            <input type="file" name="photo" id="photo" class="form-control">
                        </div>
                    </div>
                </section>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    <!-- /.modal -->

    {{-- modal info --}}
    <div class="modal fade" id="info">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">INFORMASI</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                   ini contoh info
                </section>
            </div>
            <div class="modal-footer text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
        </div>
    </div>
    <!-- /.modal -->

    @section('script')
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy","excel"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            });
        </script>
    @endsection

    @endsection

