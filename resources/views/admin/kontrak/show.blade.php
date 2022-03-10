@extends('layouts.admin')

@section('title')
    Data Kontrak
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
        <h1 class="m-0 text-capitalize">Data Kontrak @if ($main['datapekerjaan'])
            | {{  $main['datapekerjaan']->jenis_pekerjaan }}
        @endif</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('kontrak')}}">Daftar Kontrak</a></li>
            <li class="breadcrumb-item active">Rincian Kontrak</li>
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
                    <a href="{{ url('kontrak/'.Crypt::encryptString($main['kontrak']->id)) }}" class="btn btn-outline-success btn-sm pop-info" title="rincian kontrak" ><i class="fas fa-pen"></i> PERUBAHAN DATA</a>
                    @endif
                    <div class="float-right">
                        {{-- <a href="#" data-toggle="modal" data-target="#cetak" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Dokumen"><i class="fas fa-print"></i> CETAK</a> --}}
                        {{-- <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a> --}}
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
                                <strong>INFORMASI UMUM</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th width="30%">Nama Paket</th>
                                        <td>{{ $main['datapekerjaan']->nama_paket }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Kegiatan / Tender</th>
                                        <td>{{ $main['datapekerjaan']->kode_kegiatan.' / '.$main['datapekerjaan']->kode_tender }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Belanja</th>
                                        <td>{{ $main['datapekerjaan']->kode_belanja }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Kegiatan</th>
                                        <td>{{ $main['datapekerjaan']->nama_kegiatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sub Kegiatan</th>
                                        <td>{{ $main['datapekerjaan']->sub_kegiatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Pekerjaan</th>
                                        <td>Kecamatan {{ $main['datapekerjaan']->kecamatan }}, Kota Tasikmalaya</td>
                                    </tr>
                                    <tr>
                                        <th>Sumber Dana</th>
                                        <td>{{ $main['datapekerjaan']->sumber_dana }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Anggaran</th>
                                        <td>{{ $main['datapekerjaan']->tahun_anggaran }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
                                <strong>DOKUMEN KONTRAK</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    @php
                                        $cetak = ['coverspk' => 'Cover SPK','sp'=>'SP','spmk' => 'SPMK','spl'=>'SPL']
                                    @endphp
                                    @foreach ($cetak as $item => $judul)
                                        <tr>
                                            <th width="60%">{{ $judul }}</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($main['kontrak']->id).'?s=cetak&file='.$item) }}" target="_blank" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK DOKUMEN</a></td>
                                        </tr>
                                    @endforeach
                                    @if ($main['datapekerjaan']->jenis_pekerjaan == 'fisik')
                                        <tr>
                                            <th>BARPK</th>
                                            <td><a href="{{ url('kontrak/'.Crypt::encryptString($main['kontrak']->id).'?s=cetak&file=barpk') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK DOKUMEN</a></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>SPK</th>
                                        <td><a href="#" class="btn btn-outline-warning btn-sm"><i class="fas fa-print"></i> DALAM PROSES</a></td>
                                    </tr>
                                    <tr>
                                        <th>SPPBJ</th>
                                        <td><a href="{{ url('kontrak/'.Crypt::encryptString($main['kontrak']->id).'?s=cetak&file=sppbj')}}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK DOKUMEN</a></td>
                                    </tr>
                                    <tr>
                                        <th>SSKK-BANPROV</th>
                                        <td><a href="{{ url('kontrak/'.Crypt::encryptString($main['kontrak']->id).'?s=cetak&file=sskk')}}" class="btn btn-outline-info btn-sm"><i class="fas fa-print"></i> CETAK DOKUMEN</a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                      <div class="col-md-6">
                          <div class="card">
                              <div class="card-header bg-primary">
                                  <strong>INFORMASI KONTRAK</strong>
                              </div>
                              <div class="card-body">
                                  <table class="table">
                                    <tr>
                                        <th>Masa Kontrak</th>
                                        <td>{{ $main['kontrak']->masa_kontrak }} Hari Kalender</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Penawaran</th>
                                        <td>Rp {{ rupiah($main['kontrak']->nilai_penawaran) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Terkoreksi</th>
                                        <td>Rp {{ rupiah($main['kontrak']->nilai_terkoreksi) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Negosiasi</th>
                                        <td>Rp {{ rupiah($main['kontrak']->nilai_negosiasi) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Pekerjaan</th>
                                        <td>Rp {{ rupiah($main['kontrak']->nilai_pekerjaan) }}</td>
                                    </tr>
                                  </table>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="card">
                              <div class="card-header bg-primary">
                                  <strong>INFORMASI ADENDUM</strong>
                              </div>
                              <div class="card-body">
                                  <table class="table">
                                    <tr>
                                        <th>No Adendum</th>
                                        <td>{{ $main['kontrak']->no_adendum }}</td>
                                    </tr>

                                    <tr>
                                        <th>Tanggal Adendum</th>
                                        <td>{{ date_indo($main['kontrak']->tgl_adendum) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nilai</th>
                                        <td>{{ $main['kontrak']->nilai }}%</td>
                                    </tr>
                                    <tr>
                                        <th>Masa Kontrak</th>
                                        <td>{{ $main['kontrak']->masakontrak_adendum }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Akhir Kontrak</th>
                                        <td>{{ date_indo($main['kontrak']->tgl_akhir_kontrak) }}</td>
                                    </tr>
                                  </table>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
                                <strong>RINCIAN</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Nomor Pengadaan</th>
                                        <td>{{ $main['kontrak']->no_pengadaan.' / '.$main['kontrak']->tgl_pengadaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor BAHP</th>
                                        <td>{{ $main['kontrak']->no_bahp.' / '.$main['kontrak']->tgl_bahp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor SPPBJ</th>
                                        <td>{{ $main['kontrak']->no_sppbj.' / '.$main['kontrak']->tgl_sppbj }}</td>
                                    </tr>
                                    @if ($main['datapekerjaan']->jenis_pekerjaan == 'fisik')
                                        <tr>
                                            <th>Nomor BARPK</th>
                                            <td>{{ $main['kontrak']->no_barpk.' / '.$main['kontrak']->tgl_barpk }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Nomor SPK</th>
                                        <td>{{ $main['kontrak']->no_spk.' / '.$main['kontrak']->tgl_spk }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor SPMK</th>
                                        <td>{{ $main['kontrak']->no_spmk.' / '.$main['kontrak']->tgl_spmk }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor SPL</th>
                                        <td>{{ $main['kontrak']->no_spl.' / '.$main['kontrak']->tgl_spl }}</td>
                                    </tr>
                                    @if ($main['datapekerjaan']->jenis_pekerjaan <> 'fisik')
                                        <tr>
                                            <th>Nomor SPP</th>
                                            <td>{{ $main['kontrak']->no_spp.' / '.$main['kontrak']->tgl_spp }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">
                                <strong>INFORMASI PERUSAHAAN</strong>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th width="40%">Nama Perusahaan</th>
                                        <td>{{ $main['dataperusahaan']->nama_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Direktur</th>
                                        <td>{{ $main['dataperusahaan']->direktur }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Perusahaan</th>
                                        <td>{{ $main['dataperusahaan']->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bank</th>
                                        <td>{{ $main['dataperusahaan']->bank.' / '.$main['dataperusahaan']->kantor_cabang }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Rekening Bank</th>
                                        <td>{{ $main['dataperusahaan']->no_rek }}</td>
                                    </tr>
                                    <tr>
                                        <th>No NPWP</th>
                                        <td>{{ $main['dataperusahaan']->npwp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Akta No/Tanggal</th>
                                        <td>{{ $main['dataperusahaan']->no_akta.'/'. date_indo($main['dataperusahaan']->tanggal_akta) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Notaris</th>
                                        <td>{{ $main['dataperusahaan']->nama_notaris }}</td>
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

    @if ($main['kontrak'])
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

