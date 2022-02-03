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
                        <a href="#" data-toggle="modal" data-target="#cetak" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Dokumen"><i class="fas fa-print"></i> CETAK</a>
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a>
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama Rincian</th>
                                <th>Isi Rincian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Masa Kontrak</td>
                                <td>{{ $main['kontrak']->masa_kontrak }} Hari Kalender</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Nilai Penawaran</td>
                                <td>{{ rupiah($main['kontrak']->nilai_penawaran) }}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Nilai Terkoreksi</td>
                                <td>{{ rupiah($main['kontrak']->nilai_terkoreksi) }}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Nilai Negosiasi</td>
                                <td>{{ rupiah($main['kontrak']->nilai_negosiasi) }}</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Nilai Pekerjaan</td>
                                <td>{{ rupiah($main['kontrak']->nilai_pekerjaan) }}</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Nomor Pengadaan</td>
                                <td>{{ $main['kontrak']->no_pengadaan.' / '.$main['kontrak']->tgl_pengadaan }}</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Nomor BAHP</td>
                                <td>{{ $main['kontrak']->no_bahp.' / '.$main['kontrak']->tgl_bahp }}</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Nomor SPPBJ</td>
                                <td>{{ $main['kontrak']->no_sppbj.' / '.$main['kontrak']->tgl_sppbj }}</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Nomor BARPK</td>
                                <td>{{ $main['kontrak']->no_barpk.' / '.$main['kontrak']->tgl_barpk }}</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Nomor SPK</td>
                                <td>{{ $main['kontrak']->no_spk.' / '.$main['kontrak']->tgl_spk }}</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Nomor SPMK</td>
                                <td>{{ $main['kontrak']->no_spmk.' / '.$main['kontrak']->tgl_spmk }}</td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Nomor SPL</td>
                                <td>{{ $main['kontrak']->no_spl.' / '.$main['kontrak']->tgl_spl }}</td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>Nomor SPP</td>
                                <td>{{ $main['kontrak']->no_spp.' / '.$main['kontrak']->tgl_spp }}</td>
                            </tr>
                            @if ($main['datapekerjaan'])
                            <tr>
                                <td>14</td>
                                <td>Kode Kegiatan</td>
                                <td>{{ $main['datapekerjaan']->kode_kegiatan }}</td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>Kode Tender</td>
                                <td>{{ $main['datapekerjaan']->kode_tender }}</td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>Nama Kegiatan</td>
                                <td>{{ $main['datapekerjaan']->nama_kegiatan }}</td>
                            </tr>
                            <tr>
                                <td>17</td>
                                <td>Sub Kegiatan</td>
                                <td>{{ $main['datapekerjaan']->sub_kegiatan }}</td>
                            </tr>
                            <tr>
                                <td>18</td>
                                <td>Nama Paket</td>
                                <td>{{ $main['datapekerjaan']->nama_paket }}</td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td>Alamat Pekerjaan</td>
                                <td>Kecamatan {{ $main['datapekerjaan']->kecamatan }}, Kota Tasikmalaya</td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>Kode Belanja</td>
                                <td>{{ $main['datapekerjaan']->kode_belanja }}</td>
                            </tr>
                            <tr>
                                <td>21</td>
                                <td>Sumber Dana</td>
                                <td>{{ $main['datapekerjaan']->sumber_dana }}</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>Tahun Anggaran</td>
                                <td>{{ $main['datapekerjaan']->tahun_anggaran }}</td>
                            </tr>
                            <tr>
                                <td>23</td>
                                <td>Jenis Pekerjaan</td>
                                <td>{{ $main['datapekerjaan']->jenis_pekerjaan }}</td>
                            </tr>
                            @endif
                            @if ($main['dataperusahaan'])
                            <tr>
                                <td>24</td>
                                <td>Nama Perusahaan</td>
                                <td>{{ $main['dataperusahaan']->nama_perusahaan }}</td>
                            </tr>
                            <tr>
                                <td>25</td>
                                <td>Direktur</td>
                                <td>{{ $main['dataperusahaan']->direktur }}</td>
                            </tr>
                            <tr>
                                <td>26</td>
                                <td>Alamat Perusahaan</td>
                                <td>{{ $main['dataperusahaan']->alamat }}</td>
                            </tr>
                            <tr>
                                <td>27</td>
                                <td>Bank</td>
                                <td>{{ $main['dataperusahaan']->bank }}</td>
                            </tr>
                            <tr>
                                <td>28</td>
                                <td>Kantor Cabang</td>
                                <td>{{ $main['dataperusahaan']->kantor_cabang }}</td>
                            </tr>
                            <tr>
                                <td>29</td>
                                <td>No Rekening Bank</td>
                                <td>{{ $main['dataperusahaan']->no_rek }}</td>
                            </tr>
                            <tr>
                                <td>30</td>
                                <td>No NPWP</td>
                                <td>{{ $main['dataperusahaan']->npwp }}</td>
                            </tr>
                            <tr>
                                <td>31</td>
                                <td>No Akta</td>
                                <td>{{ $main['dataperusahaan']->no_akta }}</td>
                            </tr>
                            <tr>
                                <td>32</td>
                                <td>Tanggal Akta</td>
                                <td>{{ $main['dataperusahaan']->tgl_akta }}</td>
                            </tr>
                            <tr>
                                <td>33</td>
                                <td>Nama Notaris</td>
                                <td>{{ $main['dataperusahaan']->nama_notaris }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
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

