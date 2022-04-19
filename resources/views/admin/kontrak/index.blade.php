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
                  <span class="info-box-text">Kontrak dalam proses</span>
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
                    <a href="{{ url($main['link'].'/create') }}" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru"><i class="fas fa-plus"></i> Tambah Kontrak</a>
                    <a href="{{ url($main['link'].'?sesi=proses') }}" class="btn btn-outline-primary btn-sm pop-info" title="List Dalam Proses"><i class="fas fa-sync"></i> Kontrak Dalam Proses</a>
                    <a href="{{ url($main['link']) }}" class="btn btn-outline-info btn-sm pop-info" title="List Dalam Proses"><i class="fas fa-sync"></i> Bersihkan Filter</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <section class="mb-3">
                      <form action="{{ url($main['link']) }}" method="get">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <select name="sumber_dana" id="" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- sumber dana --</option>
                                    @foreach ($sumberdana as $item)
                                        <option value="{{ $item->nama }}" @if ($main['f']['sumber_dana'] == $item->nama)
                                            selected
                                        @endif>{{ strtoupper($item->keterangan) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select name="kecamatan" id="" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- kecamatan --</option>
                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->nama }}" @if ($main['f']['kecamatan'] == $item->nama)
                                            selected
                                        @endif>{{ strtoupper($item->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="jenis_pekerjaan" id="" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- jenis pekerjaan --</option>
                                    @foreach ($jenispekerjaan as $item)
                                        <option value="{{ $item->nama }}" @if ($main['f']['jenis_pekerjaan'] == $item->nama)
                                            selected
                                        @endif>{{ strtoupper($item->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select name="tahun_anggaran" id="" class="form-control" onchange="this.form.submit();">
                                  <option value="semua">-- tahun anggaran --</option>
                                  @for ($i = ambil_tahun(); $i > 2010; $i--)
                                      <option value="{{ $i }}" @if ($main['f']['tahun_anggaran'] == $i)
                                          selected
                                      @endif>{{ $i }}</option>
                                  @endfor
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
                                <th>Kode Kegitan</th>
                                <th>Sub Kegiatan</th>
                                <th>Nama Paket</th>
                                <th>Jenis Pekerjaan</th>
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
                                      <form id="data-{{ $item->id }}" action="{{url($main['link'].'/'.$item->idkontrak)}}" method="post">
                                          @csrf
                                          @method('delete')
                                          </form>
                                          <div class="btn-group">
                                              <button type="button" class="btn btn-info btn-sm btn-flat">Aksi</button>
                                              <button type="button" class="btn btn-info btn-sm btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                              </button>
                                              <div class="dropdown-menu" role="menu">
                                                <a href="{{ url('kontrak/'.Crypt::encryptString($item->idkontrak).'?s=rincian') }}" class="dropdown-item"><i class="fas fa-file text-primary" style="width: 25px"></i> DETAIL</a>
                                                <div class="dropdown-divider"></div>
                                                <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button>
                                              </div>
                                          </div>
                                    </td>
                                    <td>{{ $item->kode_kegiatan }}</td>                                        
                                    <td>{{ $item->sub_kegiatan }}</td>                                        
                                    <td>{{ $item->nama_paket }}</td>                                        
                                    <td>{{ $item->jenis_pekerjaan }}</td>                                        
                                    <td>Kec. {{ $item->kecamatan }}, Kab/Kota Tasikmalaya</td>                                        
                                    <td>{{ $item->sumber_dana }}</td>                                        
                                    <td class="text-center">{{ $item->tahun_anggaran }}</td>                                        
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

