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
            {{-- end col --}}
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Kontrak Proses</span>
                  <span class="info-box-number">
                        {{ $main['statistik']['proses']}}
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
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                <a href="{{ url('kontrak') }}" class="btn btn-outline-secondary btn-sm pop-info" title="kembali Daftar"><i class="fas fa-angle-double-left"></i> Kembali</a>
                <a href="{{ url($main['link'].'/create') }}" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru"><i class="fas fa-plus"></i> Tambah Kontrak</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Aksi</th>
                                <th>Tanggal</th>
                                <th>Nilai Kontrak</th>
                                <th>Kode Kegitan</th>
                                <th>Sub Kegiatan</th>
                                <th>Nama Paket</th>
                                <th>Alamat</th>
                                <th>Sumber Dana</th>
                                <th>Tahun Anggaran</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
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
                                                <a href="{{ url('kontrak/'.Crypt::encryptString($item->id)) }}" class="dropdown-item"><i class="fas fa-file text-primary" style="width: 25px"></i> DETAIL</a>
                                                <div class="dropdown-divider"></div>
                                                <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button>
                                              </div>
                                          </div>
                                    </td>
                                    <td>{{ $item->created_at }}</td>                                        
                                    <td>{{ rupiah($item->nilai_pekerjaan) }}</td>                                        
                                    @if (is_null($item->pekerjaan_id))
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @else
                                        @php
                                            $pekerjaan = DbSistem::showtablefirst('pekerjaan',['id',$item->pekerjaan_id])
                                        @endphp
                                        <td>{{ $pekerjaan->kode_kegiatan }}</td>                                        
                                        <td>{{ $pekerjaan->sub_kegiatan }}</td>                                        
                                        <td>{{ $pekerjaan->nama_paket }}</td>                                        
                                        <td>Kec. {{ $pekerjaan->kecamatan }}, Kab/Kota Tasikmalaya</td>                                        
                                        <td>{{ $pekerjaan->sumber_dana }}</td>                                        
                                        <td>{{ $pekerjaan->tahun_anggaran }}</td>                                        
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

