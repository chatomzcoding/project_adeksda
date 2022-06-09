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
                  @if (count($kontrak) <> count($kontrakakses))
                    <section class="mb-3">
                        <form action="{{ url($main['link']) }}" method="get">
                          @csrf
                          <input type="hidden" name="sesi" value="konsultan">
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <select name="kontrak" id="" class="form-control select2bs4"  style="width: 100%;" onchange="this.form.submit();">
                                      <option value="semua" selected="selected">-- Pilih Kontrak --</option>
                                      @foreach ($kontrak as $item)
                                          <option value="{{ $item->id }}" @if ($id == $item->id)
                                              selected
                                          @endif>{{ strtoupper($item->nama_paket) }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                      </form>
                    </section>
                  @endif
                  @if ($dkontrak)
                  <section class="mb-3 p-3">
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
                          <label for="" class="small">No SPK</label>
                          <input type="text" id="no_spk" class="form-control" value="{{ $dkontrak->no_spk }}" disabled>
                        </div>
                        <div class="col-md-6">
                          <label for="" class="small">Tanggal SPK</label>
                          <input type="date" id="tgl_spk" class="form-control" value="{{ $dkontrak->tgl_spk }}" disabled>
                        </div>
                        <div class="col-md-12 mt-2">
                          <div class="form-group">
                            <label for="">Nama Perusahaan {!! ireq() !!}</label>
                            <input type="text" name="nama_perusahaan" class="form-control" required>
                          </div>
                          <div class="form-group text-right">
                            <button type="submit" class="btn btn-outline-primary">PILIH KONTRAK</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </section>
                  @else
                    <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead class="text-center">
                              <tr>
                                  <th width="5%">No</th>
                                  <th width="10%">Aksi</th>
                                  <th>Nama Paket</th>
                                  <th>Sub Kegiatan</th>
                                  <th>Nomor SPK</th>
                                  <th>Tanggal SPK</th>
                                  <th>Nilai Kontrak</th>
                                  <th>Nama Perusahaan</th>
                                  <th>Progress</th>
                              </tr>
                          </thead>
                          <tbody class="text-capitalize">
                              @forelse ($kontrakakses as $item)
                              <tr>
                                      <td class="text-center">{{ $loop->iteration}}</td>
                                      <td class="text-center">
                                          <form id="data-{{ $item->id }}" action="{{url('kontrakakses/'.$item->id)}}" method="post">
                                              @csrf
                                              @method('delete')
                                              </form>
                                              <div class="btn-group">
                                                  <button type="button" class="btn btn-info btn-sm btn-flat">Aksi</button>
                                                  <button type="button" class="btn btn-info btn-sm btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                  </button>
                                                  <div class="dropdown-menu" role="menu">
                                                    <a href="{{ url('kontrakakses/'.$item->idakses) }}" class="dropdown-item"><i class="fas fa-file text-primary" style="width: 25px"></i> DETAIL</a>
                                                    <div class="dropdown-divider"></div>
                                                    <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button>
                                                  </div>
                                              </div>
                                      </td>
                                        <td>{{ $item->nama_paket }}</td>                                        
                                        <td>{{ $item->sub_kegiatan }}</td>                                        
                                        <td>{{ $item->no_spk }}</td>                                        
                                        <td>{{ $item->tgl_spk }}</td>                                        
                                        <td>{{ $item->nilai_pekerjaan }}</td>                                        
                                        <td>{{ $item->nama_perusahaan }}</td>                                        
                                        <td class="text-center">
                                          @php
                                              $progress = App\Models\Progress::where('kontrak_id',$item->kontrak_id)->orderBy('id','DESC')->first()
                                          @endphp  
                                          @if ($progress)
                                              {{ $progress->nilai }}%
                                          @endif
                                        </td>                                        
                                  </tr>
                              @empty
                                  <tr class="text-center">
                                      <td colspan="9" class="font-italic">-- belum ada data --</td>
                                  </tr>
                              @endforelse
                      </table>
                    </div>
                  @endif
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

