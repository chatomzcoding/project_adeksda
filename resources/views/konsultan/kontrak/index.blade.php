@extends('layouts.admin')

@section('title')
    Data Kontrak
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Kontrak</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Kontrak</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
   
@section('content')
    
    <div class="container-fluid">
        <div class="row">
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Kontrak</span>
                  <span class="info-box-number">
                        {{ count($kontrak)}}
                  </span>
                </div>
              </div>
            </div>
            {{-- end col --}}
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Kontrak yang dipegang</span>
                  <span class="info-box-number">
                        {{ count($kontrakakses) }}
                  </span>
                </div>
              </div>
            </div>
            {{-- end col --}}
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-4">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Kontrak Selesai</span>
                  <span class="info-box-number">
                        0
                  </span>
                </div>
              </div>
            </div>
            {{-- end col --}}
            {{-- end col --}}
        </div>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                    <div class="float-right">
                        <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a>
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a>
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <section class="mb-3">
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
                  </section>
                  @if ($dkontrak)
                  <section class="mb-3">
                    <form action="{{ url('kontrakakses') }}" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{ $dkontrak->idkontrak }}">
                      <div class="row">
                        <div class="col-md-12">
                          <label for="" class="small">Nama Paket</label>
                          <input type="text" id="nama_paket" class="form-control" value="{{ $dkontrak->nama_paket }}" disabled>
                          <label for="" class="small">Sub Kegiatan</label>
                          <input type="text" id="sub_kegiatan" class="form-control" value="{{ $dkontrak->sub_kegiatan }}" disabled>
                        </div>
                        <div class="col-md-6">
                          <label for="" class="small">Kode Tender</label>
                          <input type="text" id="kode_tender" class="form-control" value="{{ $dkontrak->kode_tender }}" disabled>
                          <label for="" class="small">Kode Belanja</label>
                          <input type="text" id="kode_belanja" class="form-control" value="{{ $dkontrak->kode_belanja }}" disabled>
                          <label for="" class="small">Kecamatan</label>
                          <input type="text" id="kecamatan" class="form-control" value="{{ $dkontrak->kecamatan }}" disabled>
                        </div>
                        <div class="col-md-6">
                          <label for="" class="small">Sumber Dana</label>
                          <input type="text" id="sumber_dana" class="form-control" value="{{ $dkontrak->sumber_dana }}" disabled>
                          <label for="" class="small">Tahun Anggaran</label>
                          <input type="text" id="tahun_anggaran" class="form-control" value="{{ $dkontrak->tahun_anggaran }}" disabled>
                          <label for="" class="small">Jenis Pekerjaan</label>
                          <input type="text" id="jenis_pekerjaan" class="form-control" value="{{ $dkontrak->jenis_pekerjaan }}" disabled>
                        </div>
                        <div class="col-md-12 text-right">
                          <button type="submit" class="btn btn-outline-primary">PILIH KONTRAK</button>
                        </div>
                      </div>
                    </form>
                  </section>
                  @endif
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Aksi</th>
                                <th>Kode Kegitan</th>
                                <th>Sub Kegiatan</th>
                                <th>Nama Paket</th>
                                <th>Kode Tender</th>
                                <th>Alamat</th>
                                <th>Sumber Dana</th>
                                <th>Tahun Anggaran</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($kontrakakses as $item)
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
                                                  <a href="{{ url('kontrak/'.Crypt::encryptString($item->id)) }}" class="dropdown-item"><i class="fas fa-file text-primary" style="width: 25px"></i> DETAIL</a>
                                                  <div class="dropdown-divider"></div>
                                                  <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button>
                                                </div>
                                            </div>
                                    </td>
                                    @php
                                        $pekerjaan = DbSistem::showtablefirst('pekerjaan',['id',$item->pekerjaan_id])
                                    @endphp
                                    @if ($pekerjaan)
                                      <td>{{ $pekerjaan->kode_kegiatan }}</td>                                        
                                      <td>{{ $pekerjaan->sub_kegiatan }}</td>                                        
                                      <td>{{ $pekerjaan->nama_paket }}</td>                                        
                                      <td>{{ $pekerjaan->kode_tender }}</td>                                        
                                      <td>Kec. {{ $pekerjaan->kecamatan }}, Kab/Kota Tasikmalaya</td>                                        
                                      <td>{{ $pekerjaan->sumber_dana }}</td>                                        
                                      <td>{{ $pekerjaan->tahun_anggaran }}</td>                                        
                                    @else
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                    @endif
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="9" class="font-italic">-- belum ada data --</td>
                                </tr>
                            @endforelse
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

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

