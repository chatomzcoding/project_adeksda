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
            <li class="breadcrumb-item"><a href="{{ route('bast.index')}}">Daftar BAST</a></li>
            <li class="breadcrumb-item active">Detail BAST</li>
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
                    <a href="{{ url($main['link']) }}" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru"><i class="fas fa-angle-double-left"></i> Kembali</a>
                    <div class="float-right">
                        {{-- <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a>
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a> --}}
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <strong>INFORMASI BAST</strong>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th width="40%">Nama Paket</th>
                                            <td>{{ $bast->nama_paket }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Perusahaan</th>
                                            <td>{{ $bast->nama_perusahaan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Selesai Pekerjaan</th>
                                            <td>{{ date_indo($bast->tgl_selesai_pekerjaan) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Progress Pekerjaan</th>
                                            <td>{{ $bast->progress_pekerjaan }}</td>
                                        </tr>
                                        <tr>
                                            <th>No BAST</th>
                                            <td>{{ $bast->no_bast }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tangggal BAST</th>
                                            <td>{{ date_indo($bast->tgl_bast) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Pekerjaan</th>
                                            <td>{{ $bast->jenis_pekerjaan }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <strong>DOKUMEN BAST</strong>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Ringkasan Kontrak</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak_id).'?s=cetak&file=ringkasankontrak&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>BAST Hasil Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak_id).'?s=cetak&file=basthp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Lampiran Berita Acara Hasil Pemeriksaan Administrasi Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak_id).'?s=cetak&file=lpap&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Lampiran Berita Acara Hasil Pemeriksaan Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak_id).'?s=cetak&file=lpp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Lampiran Hasil Pemeriksaan Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak_id).'?s=cetak&file=lhpp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Pemeriksaan Hasil Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak_id).'?s=cetak&file=php&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Laporan Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak_id).'?s=cetak&file=lp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Permohonan Pemeriksaan Hasil Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak_id).'?s=cetak&file=pphp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
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

