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
                    <a href="{{ url('halaman/kontrakfisik') }}" class="btn btn-outline-primary btn-sm pop-info" title="Kembali" ><i class="fas fa-long-arrow-alt-left"></i></a>
                    <div class="float-right">
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a>
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-default">
                        <div class="card-header">
                          <h3 class="card-title">Data Pendukung</h3>
                        </div>
                        <div class="card-body p-0">
                          <div class="bs-stepper">
                            <div class="bs-stepper-header" role="tablist">
                              <!-- your steps here -->
                              <div class="step" data-target="#pegawai">
                                <button type="button" class="step-trigger" role="tab" aria-controls="pegawai" id="pegawai-trigger">
                                  <span class="bs-stepper-circle">1</span>
                                  <span class="bs-stepper-label">Pegawai</span>
                                </button>
                              </div>
                              <div class="line"></div>
                              <div class="step" data-target="#pekerjaan">
                                <button type="button" class="step-trigger" role="tab" aria-controls="pekerjaan" id="pekerjaan-trigger">
                                  <span class="bs-stepper-circle">2</span>
                                  <span class="bs-stepper-label">Pekerjaan</span>
                                </button>
                              </div>
                              <div class="line"></div>
                              <div class="step" data-target="#perusahaan">
                                <button type="button" class="step-trigger" role="tab" aria-controls="perusahaan" id="perusahaan-trigger">
                                  <span class="bs-stepper-circle">3</span>
                                  <span class="bs-stepper-label">Perusahaan</span>
                                </button>
                              </div>
                            </div>
                            <div class="bs-stepper-content">
                              <!-- your steps content here -->
                              <div id="pegawai" class="content" role="tabpanel" aria-labelledby="pegawai-trigger">
                                <div class="form-group">
                                  <div class="row">
                                    <div class="col-md-8">
                                    <label>Nama Tim Lokus</label>
                                      <select class="form-control select2bs4" style="width: 100%;">
                                        <option value="" selected="selected">-- pilih tim lokus --</option>
                                        @foreach (list_timlokus() as $item)
                                          <option value="{{ $item['id'] }}">{{ ucwords($item['nama']) }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="col-md-4">
                                      <label>Jika belum ada data!</label><br>
                                      <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#tambahtimlokus">Tambah Tim Lokus Baru</a>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
                              </div>

                              <div id="pekerjaan" class="content" role="tabpanel" aria-labelledby="pekerjaan-trigger">
                                <div class="form-group">
                                  <label for="exampleInputFile">File input</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="exampleInputFile">
                                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                      <span class="input-group-text">Upload</span>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                <button class="btn btn-primary" onclick="stepper.next()">Selanjutnya</button>
                              </div>
                              <div id="perusahaan" class="content" role="tabpanel" aria-labelledby="perusahaan-trigger">
                                <div class="form-group">
                                  <label for="exampleInputFile">File input</label>
                                  <div class="input-group">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="exampleInputFile">
                                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                      <span class="input-group-text">Upload</span>
                                    </div>
                                  </div>
                                </div>
                                <button class="btn btn-primary" onclick="stepper.previous()">Sebelumnya</button>
                                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
                        </div>
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="tambahtimlokus">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url($main['link'])}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Tim Lokus Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">NIS {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="text" name="nis" id="nis" maxlength="9" value="{{ old('nis') }}" class="form-control" required>
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
    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url($main['link'])}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Siswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">
                <section class="p-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">NIS {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="text" name="nis" id="nis" maxlength="9" value="{{ old('nis') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Nama Siswa {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Tanggal Lahir {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="date" name="tgl_lahir" id="tgl_lahir" value="{{ old('tgl_lahir') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Alamat {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">No Telp {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Jk {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="">-- jenis kelamin --</option>
                                <option value="laki-laki">Laki - Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-2">Photo {!! ireq() !!}</label>
                        <div class="col-md-8 p-0">
                            <input type="file" name="photo" id="photo" value="{{ old('photo') }}" class="form-control" required>
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

