@extends('layouts.admin')

@section('title')
    Data Kontrak Fisik
@endsection

@section('head')
  <!-- BS Stepper -->
  <link rel="stylesheet" href=" {{ asset('template/admin/lte/plugins/bs-stepper/css/bs-stepper.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href=" {{ asset('template/admin/lte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('template/admin/lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Kontrak Fisik</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('halaman/kontrakfisik')}}">Daftar Kontrak Fisik</a></li>
            <li class="breadcrumb-item active">Buat Kontrak Fisik</li>
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
                    <a href="{{ url('kontrak') }}" class="btn btn-outline-primary btn-sm pop-info" title="Kembali" ><i class="fas fa-long-arrow-alt-left"></i></a>
                    @if ($main['kontrak'])
                    <a href="{{ url('kontrak/'.Crypt::encryptString($main['kontrak']->id).'?s=rincian') }}" class="btn btn-outline-primary btn-sm pop-info" title="rincian kontrak" ><i class="fas fa-file-alt"></i> RINCIAN</a>
                    @endif
                    <div class="float-right">
                        <a href="#" data-toggle="modal" data-target="#cetak" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Dokumen"><i class="fas fa-print"></i> CETAK</a>
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a>
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- bagian dari kontrak --}}
                  <div class="accordion" id="accordionExample">
                    <div class="card">
                      <div class="card-header bg-info p-1" id="headingOne">
                        <h2 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <strong class="text-white">INFORMASI KONTRAK #1 </strong>
                          </button>
                        </h2>
                      </div>
                      
                      <div id="collapseOne" class="collapse @if ($main['collapse'] == 1)
                        show
                      @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                           {{-- data awal informasi kontrak --}}
                            @include('admin.kontrak.section.informasi')
                        </div>
                      </div>
                    </div>
                    @if ($main['kontrak'])
                        <div class="card">
                        <div class="card-header bg-info p-1" id="headingTwo">
                            <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <strong class="text-white">DATA PENDUKUNG #2</strong>
                            </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse @if ($main['collapse'] == 2)
                        show
                        @endif" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                {{-- data pendukung (tim lokus, pekerjaan, perusahaan) --}}
                                @include('admin.kontrak.section.pendukung')
                            </div>
                        </div>
                        </div>
                        <div class="card">
                        <div class="card-header bg-info p-1" id="headingThree">
                            <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <strong class="text-white">DOKUMEN #3</strong>
                            </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse @if ($main['collapse'] == 3)
                        show
                        @endif" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="card-body">
                             {{-- data dokumen (nomor dan tanggal) --}}
                             @include('admin.kontrak.section.dokumen')
                            </div>
                        </div>
                        </div>
                    @endif

                  </div>

              
                  
                  
              </div>
            </div>
          </div>
        </div>
    </div>

    @if ($main['kontrak'])
        <div class="modal fade" id="tambahtimlokus">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('timlokus')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Tim Lokus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <section class="p-3">
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Tambahkan Untuk {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <select name="posisi" id="" class="form-control">
                                    <option value="id_ketua">Ketua Teknis Kegiatan</option>
                                    <option value="id_sekretaris">Sekretaris Teknis Kegiatan</option>
                                    <option value="id_anggota">Anggota Teknis Kegiatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">NIP {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="nip" id="nip" maxlength="16" value="{{ old('nip') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Nama {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Jabatan {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">No SK</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="no_sk" id="no_sk" value="{{ old('no_sk') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Tanggal</label>
                            <div class="col-md-8 p-0">
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Perihal</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="perihal" id="perihal" value="{{ old('perihal') }}" class="form-control">
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

        <div class="modal fade" id="tambahpekerjaan">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('pekerjaan')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">

                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pekerjaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <section class="p-3">
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Kode Kegiatan {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="kode_kegiatan" id="kode_kegiatan" maxlength="16" value="{{ old('kode_kegiatan') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Kode Tender {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="kode_tender" id="kode_tender" value="{{ old('kode_tender') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Nama Kegiatan {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Sub Kegiatan {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="sub_kegiatan" id="sub_kegiatan" value="{{ old('sub_kegiatan') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Nama Paket {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="nama_paket" id="nama_paket" value="{{ old('nama_paket') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Kecamatan {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <select name="kecamatan" id="kecamatan" class="form-control" required>
                                    <option value="">-- pilih kecamatan --</option>
                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->nama }}">{{ strtoupper($item->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Kode Belanja {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="kode_belanja" id="kode_belanja" value="{{ old('kode_belanja') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Sumber Dana {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <select name="sumber_dana" id="sumber_dana" class="form-control" required>
                                    <option value="">-- pilih sumber dana --</option>
                                    @foreach ($sumberdana as $item)
                                        <option value="{{ $item->nama }}">{{ strtoupper($item->keterangan) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Tahun Anggaran {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="tahun_anggaran" id="tahun_anggaran" value="{{ old('tahun_anggaran') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Jenis Pekerjaan {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <select name="jenis_pekerjaan" id="jenis_pekerjaan" class="form-control" required>
                                    <option value="">-- pilih jenis pekerjaan --</option>
                                    @foreach ($jenispekerjaan as $item)
                                        <option value="{{ $item->nama }}">{{ strtoupper($item->nama) }}</option>
                                    @endforeach
                                </select>
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

        <div class="modal fade" id="tambahperusahaan">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ url('perusahaan')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Perusahaan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3">
                    <section class="p-3">
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Nama Perusahaan {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="nama_perusahaan" id="nama_perusahaan" maxlength="16" value="{{ old('nama_perusahaan') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Nama Direktur {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="direktur" id="direktur" value="{{ old('direktur') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Alamat {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Nama Bank {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="bank" id="bank" value="{{ old('bank') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Kantor Cabang {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="kantor_cabang" id="kantor_cabang" value="{{ old('kantor_cabang') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">No Rekening {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="no_rek" id="no_rek" value="{{ old('no_rek') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">NPWP {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="npwp" id="npwp" value="{{ old('npwp') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">No Akta {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="no_akta" id="no_akta" value="{{ old('no_akta') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Tanggal Akta {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="date" name="tanggal_akta" id="tanggal_akta" value="{{ old('tanggal_akta') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 p-2">Nama Notaris {!! ireq() !!}</label>
                            <div class="col-md-8 p-0">
                                <input type="text" name="nama_notaris" id="nama_notaris" value="{{ old('nama_notaris') }}" class="form-control" required>
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
        {{-- modal cetak --}}
        <div class="modal fade" id="cetak">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">CETAK DOKUMEN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body p-3">
                    <section class="p-3 row">
                        <div class="col-md-6">
                            <div class="list-group">
                                <a href="{{ asset('file/cover-spk.rtf') }}" class="list-group-item list-group-item-action"><i class="far fa-file-word"></i> Cover SPK</a>
                                <a href="{{ asset('file/spk.rtf') }}" class="list-group-item list-group-item-action"><i class="far fa-file-word"></i> SPK</a>
                                <a href="{{ asset('file/sp.rtf') }}" class="list-group-item list-group-item-action"><i class="far fa-file-word"></i> SP</a>
                                <a href="{{ asset('file/spmk.rtf') }}" class="list-group-item list-group-item-action"><i class="far fa-file-word"></i> SPMK</a>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-group">
                                <a href="{{ asset('file/spl.rtf') }}" class="list-group-item list-group-item-action"><i class="far fa-file-word"></i> SPL</a>
                                <a href="{{ asset('file/barpk.rtf') }}" class="list-group-item list-group-item-action"><i class="far fa-file-word"></i> BARPK</a>
                                <a href="{{ asset('file/sppbj.rtf') }}" class="list-group-item list-group-item-action"><i class="far fa-file-word"></i> SPPBJ</a>
                                <a href="{{ asset('file/sskk.rtf') }}" class="list-group-item list-group-item-action"><i class="far fa-file-word"></i> SSKK-BANPROV</a>
                              </div>
                        </div>
                    </section>
                </div>
                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
            </div>
        </div>
        <!-- /.modal -->
        
    @endif

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
                   <i class="far fa-file-word"></i>
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
        <!-- BS-Stepper -->
      <script src=" {{ asset('template/admin/lte/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
      <!-- Select2 -->
<script src=" {{ asset('template/admin/lte/plugins/select2/js/select2.full.min.js')}}"></script>
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": false, "lengthChange": false, "autoWidth": true,
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
              // BS-Stepper Init
            document.addEventListener('DOMContentLoaded', function () {
              window.stepper = new Stepper(document.querySelector('.bs-stepper'))
            });
        </script>
        <script>
          $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
          })
        </script>

    @endsection

    @endsection

