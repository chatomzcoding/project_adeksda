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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                    <a href="{{ url($main['link']) }}" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru"><i class="fas fa-angle-double-left"></i> Kembali</a>
                    <a href="#" data-toggle="modal" data-target="#ubah" class="btn btn-outline-success btn-sm"><i class="fas fa-pen"></i> Edit BAST</a>
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
                                            <td>{{ $bast->kontrak->pekerjaan->nama_paket }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Perusahaan</th>
                                            <td>{{ $bast->kontrak->perusahaan->nama_perusahaan }}</td>
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
                                            <th>No PHP</th>
                                            <td>{{ $bast->no_php }}</td>
                                        </tr>
                                        <tr>
                                            <th>No LHPP</th>
                                            <td>{{ $bast->no_lhpp }}</td>
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
                                            <td>{{ $bast->kontrak->pekerjaan->jenis_pekerjaan }}</td>
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
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak->id).'?s=cetak&file=ringkasankontrak&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>BAST Hasil Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak->id).'?s=cetak&file=basthp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Lampiran Berita Acara Hasil Pemeriksaan Administrasi Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak->id).'?s=cetak&file=lpap&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Lampiran Berita Acara Hasil Pemeriksaan Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak->id).'?s=cetak&file=lpp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Laporan Hasil Pemeriksaan Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak->id).'?s=cetak&file=lhpp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Pemeriksaan Hasil Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak->id).'?s=cetak&file=php&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Laporan Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak->id).'?s=cetak&file=lp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
                                        </tr>
                                        <tr>
                                            <th>Permohonan Pemeriksaan Hasil Pekerjaan</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($bast->kontrak->id).'?s=cetak&file=pphp&sesi=bast') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK</a></td>
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
 {{-- modal edit --}}
 <div class="modal fade" id="ubah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('bast.update','test')}}" method="post">
            @csrf
            @method('patch')
        <div class="modal-header">
        <h4 class="modal-title">Edit Data BAST</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body p-3">
            <input type="hidden" name="id"  value="{{ $bast->id }}">
            <section class="p-3">
                <div class="form-group row">
                    <label for="" class="col-md-4">Tanggal Selesai Pekerjaan {!! ireq() !!}</label>
                    <input type="date" name="tgl_selesai_pekerjaan" value="{{ $bast->tgl_selesai_pekerjaan }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Tanggal Ringkasan Kontrak {!! ireq() !!}</label>
                    <input type="date" name="tgl_ringkasan_kontrak" value="{{ $bast->tgl_ringkasan_kontrak }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Progress Pekerjaan (%){!! ireq() !!}</label>
                    <input type="number" name="progress_pekerjaan" value="{{ $bast->progress_pekerjaan }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Tanggal BAST {!! ireq() !!}</label>
                    <input type="date" name="tgl_bast" value="{{ $bast->tgl_bast }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Nomor BAST {!! ireq() !!}</label>
                    <input type="text" name="no_bast" value="{{ $bast->no_bast }}" class="form-control col-md-8" readonly>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Tanggal Permohonan Ceklis {!! ireq() !!}</label>
                    <input type="date" name="tgl_permohonan_ceklis" value="{{ $bast->tgl_permohonan_ceklis }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Nomor Permohonan Ceklis {!! ireq() !!}</label>
                    <input type="text" name="no_permohonan_ceklis" value="{{ $bast->no_permohonan_ceklis }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Tanggal Surat PPK ke Tim Teknis {!! ireq() !!}</label>
                    <input type="date" name="tgl_surat_ppk" value="{{ $bast->tgl_surat_ppk }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Tanggal Surat Tim Teknis {!! ireq() !!}</label>
                    <input type="date" name="tgl_surat_tim" value="{{ $bast->tgl_surat_tim }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Tanggal DPA {!! ireq() !!}</label>
                    <input type="date" name="tgl_dpa" value="{{ $bast->tgl_dpa }}" class="form-control col-md-8" required>
                  </div>
                  <div class="form-group row">
                    <label for="" class="col-md-4">Nomor DPA {!! ireq() !!}</label>
                    <input type="text" name="no_dpa"  value="{{ $bast->no_dpa }}" class="form-control col-md-8" required>
                  </div>
                 
                  @if ($bast->kontrak->pekerjaan->jenis_pekerjaan == 'fisik')
                    <div class="form-group row">
                      <label for="" class="col-md-4">Konsultan Pengawas {!! ireq() !!}</label>
                      <input type="text" name="konsultan_pengawas" value="{{ $bast->konsultan_pengawas }}" class="form-control col-md-8" required>
                    </div>
                    <div class="form-group row">
                      <label for="" class="col-md-4">Direktur {!! ireq() !!}</label>
                      <input type="text" name="direktur"  value="{{ $bast->direktur }}" class="form-control col-md-8" required>
                    </div>
                  @endif
            </section>
        </div>
        <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
        </div>
        </form>
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

