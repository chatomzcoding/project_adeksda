@extends('layouts.admin')

@section('title')
    Data Rekap
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Rekap</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Rekap</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
   
@section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Kontrak</span>
                  <span class="info-box-number">
                        {{ $main['statistik']['total']}}
                  </span>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Rekap</span>
                  <span class="info-box-number">
                    {{ $main['statistik']['kontrakakses']}}
                  </span>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DAFTAR REKAP PROGRESS</h3>
                    {{-- <a href="{{ url($main['link'].'/create') }}" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru"><i class="fas fa-plus"></i> Tambah Kontrak</a> --}}
                    <div class="float-right">
                        {{-- <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a>
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a> --}}
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <section class="mb-3">
                      <form action="{{ url($main['link']) }}" method="get">
                        <input type="hidden" name="sesi" value="rekap">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <select name="user_id" id="" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- nama konsultan --</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == $main['f']['user_id'])
                                            selected
                                        @endif>{{ strtoupper($item->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                  </section>
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Aksi</th>
                                <th>Nama Paket</th>
                                <th>Nilai Kontrak</th>
                                <th>Nomor SPK</th>
                                <th>Kontraktor Pelaksana</th>
                                <th>Tanggal SPK</th>
                                <th>Masa Pelaksanaan</th>
                                <th>Tanggal Akhir Kontrak</th>
                                <th>Progress Fisik</th>
                                <th>Panjang</th>
                                <th>Nama Konsultan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kontrak as $item)
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
                                                  <a href="{{ url('kontrak/'.Crypt::encryptString($item->kontrak_id).'?s=rincian') }}" class="dropdown-item"><i class="fas fa-file text-primary" style="width: 25px"></i> DETAIL</a>
                                                  <a href="{{ url('kontrak/'.Crypt::encryptString($item->kontrak_id).'?s=rincian') }}" class="dropdown-item"><i class="fas fa-file text-primary" style="width: 25px"></i> Progress Fisik</a>
                                                  {{-- <div class="dropdown-divider"></div>
                                                  <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button> --}}
                                                </div>
                                            </div>
                                    </td>
                                    <td>{{ $item->nama_paket }}</td>                                        
                                    <td>{{ rupiah($item->nilai_pekerjaan) }}</td>                                        
                                    <td>{{ $item->no_spk }}</td>                                        
                                    <td>{{ $item->nama_perusahaan }}</td>          
                                    <td>{{ date_indo($item->tgl_spk) }}</td>
                                    <td>{{ $item->masa_kontrak }} HK</td>
                                    <td> {{ date_indo(tgl_akhir_kontrak($item->tgl_spk,$item->masa_kontrak)) }} </td>                                        
                                    @php
                                            $progress = App\Models\Progress::where('kontrak_id',$item->kontrak_id)->orderBy('id','DESC')->first()
                                            @endphp  
                                      <td class="text-center">
                                        @if ($progress)
                                        {{ $progress->nilai }}% <br>
                                        @endif
                                      </td>                                 
                                      <td class="text-center">
                                        @if ($progress)
                                        {{ $progress->nilai_panjang }} m
                                        @endif
                                      </td>                                 
                                      <td>{{ $item->name }}</td>                                        
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
                "buttons": ["copy","excel","pdf"]
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

