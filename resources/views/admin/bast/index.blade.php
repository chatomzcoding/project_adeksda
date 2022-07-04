@extends('layouts.admin')

@section('title')
    Data BAST
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data BAST</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar BAST</li>
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
                  <span class="info-box-text">Total BAST</span>
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
                  <span class="info-box-text">Total Kontrak</span>
                  <span class="info-box-number">
                    {{ $main['statistik']['kontrak']}}

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
                @if ($dkontrak)
                  <a href="{{ url('bast') }}" class="btn btn-outline-secondary btn-sm pop-info" title="Kembali ke daftar BAST"><i class="fas fa-angle-left"></i> Kembali</a>
                @endif
                    <div class="float-right">
                        {{-- <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a>
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a> --}}
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <section class="mb-3">
                      <form action="{{ url($main['link']) }}" method="get">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <select name="kontrak_id" id="" class="form-control select2bs4" onchange="this.form.submit();">
                                    <option value="semua">-- Nama Paket --</option>
                                    @foreach ($kontrak as $item)
                                        @if (!DbSistem::showtablefirst('bast',['kontrak_id',$item->id]))
                                          <option value="{{ $item->id }}" @if ($id == $item->id)
                                              selected
                                          @endif>{{ strtoupper($item->nama_paket) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                  </section>
                  @if ($dkontrak)
                  <section class="mb-3 p-3">
                    <form action="{{ url('bast') }}" method="post">
                      @csrf
                      <input type="hidden" name="kontrak_id" value="{{ $dkontrak->kontrak_id }}">
                      <div class="row">
                        <div class="col-md-12">
                          <label for="" class="small">Nama Paket</label>
                          <input type="text" id="nama_paket" class="form-control" value="{{ $dkontrak->nama_paket }}" disabled>
                          <label for="" class="small">Sub Kegiatan</label>
                          <input type="text" id="sub_kegiatan" class="form-control" value="{{ $dkontrak->sub_kegiatan }}" disabled>
                        </div>
                        <div class="col-md-4">
                          <label for="" class="small">No SPK</label>
                          <input type="text" id="no_spk" class="form-control" value="{{ $dkontrak->no_spk }}" disabled>
                        </div>
                        <div class="col-md-4">
                          <label for="" class="small">Tanggal SPK</label>
                          <input type="date" id="tgl_spk" class="form-control" value="{{ $dkontrak->tgl_spk }}" disabled>
                        </div>
                        <div class="col-md-4">
                          <label for="" class="small">Jenis Pekerjaan</label>
                          <input type="text" id="tgl_spk" class="form-control" value="{{ $dkontrak->jenis_pekerjaan }}" disabled>
                        </div>
                        <div class="col-md-4 mt-2">
                          <div class="form-group">
                            <label for="">Tanggal Selesai Pekerjaan {!! ireq() !!}</label>
                            <input type="date" name="tgl_selesai_pekerjaan" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Tanggal Ringkasan Kontrak {!! ireq() !!}</label>
                            <input type="date" name="tgl_ringkasan_kontrak" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Progress Pekerjaan (%){!! ireq() !!}</label>
                            <input type="number" name="progress_pekerjaan" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Nomor PHP {!! ireq() !!}</label>
                            <input type="text" name="no_php" value="{{ $nomor['php'] }}" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Nomor LHPP {!! ireq() !!}</label>
                            <input type="text" name="no_lhpp" value="{{ $nomor['lhpp'] }}" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Tanggal BAST {!! ireq() !!}</label>
                            <input type="date" name="tgl_bast" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Nomor BAST {!! ireq() !!}</label>
                            <input type="text" name="no_bast" value="{{ $nomor['bast'] }}" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-4 mt-2">
                          <div class="form-group">
                            <label for="">Tanggal Permohonan Ceklis {!! ireq() !!}</label>
                            <input type="date" name="tgl_permohonan_ceklis" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Nomor Permohonan Ceklis {!! ireq() !!}</label>
                            <input type="text" name="no_permohonan_ceklis" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Tanggal Surat PPK ke Tim Teknis {!! ireq() !!}</label>
                            <input type="date" name="tgl_surat_ppk" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Tanggal Surat Tim Teknis {!! ireq() !!}</label>
                            <input type="date" name="tgl_surat_tim" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-4 mt-2">
                          <div class="form-group">
                            <label for="">Tanggal DPA {!! ireq() !!}</label>
                            <input type="date" name="tgl_dpa" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="">Nomor DPA {!! ireq() !!}</label>
                            <input type="text" name="no_dpa" value="" class="form-control" required>
                          </div>
                         
                          @if ($dkontrak->jenis_pekerjaan == 'fisik')
                            <div class="form-group">
                              <label for="">Konsultan Pengawas {!! ireq() !!}</label>
                              <input type="text" name="konsultan_pengawas" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="">Direktur {!! ireq() !!}</label>
                              <input type="text" name="direktur" class="form-control" required>
                            </div>
                          @endif
                          <div class="form-group text-right">
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save"></i> SIMPAN BAST</button>
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
                                <th>Perusahaan</th>
                                <th>Tanggal Selesai</th>
                                <th>Nomor BAST</th>
                                <th>Tanggal BAST</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($bast as $item)
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
                                                  <a href="{{ url('bast/'.$item->id) }}" class="dropdown-item"><i class="fas fa-file text-primary" style="width: 25px"></i> CETAK</a>
                                                  {{-- <a href="{{ url('kontrak/'.Crypt::encryptString($item->id)) }}" class="dropdown-item"><i class="fas fa-pen text-success" style="width: 25px"></i> EDIT</a> --}}
                                                  <div class="dropdown-divider"></div>
                                                  <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button>
                                                </div>
                                            </div>
                                    </td>
                                      <td>{{ $item->nama_paket }}</td> 
                                      <td>{{ $item->nama_perusahaan }}</td> 
                                      <td>{{ date_indo($item->tgl_selesai_pekerjaan) }}</td>                                       
                                      <td>{{ $item->no_bast }}</td> 
                                      <td>{{ date_indo($item->tgl_bast) }}</td>                                       
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

