@extends('layouts.admin')

@section('title')
    Data Kontrak Fisik
@endsection

@section('head')
  <!-- BS Stepper -->
  <link rel="stylesheet" href=" {{ asset('template/admin/lte/plugins/bs-stepper/css/bs-stepper.min.css') }}">

<script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>
<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Kontrak | {{  $main['datapekerjaan']->jenis_pekerjaan }}
        @endif</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('halaman/kontrakfisik')}}">Daftar Kontrak</a></li>
            <li class="breadcrumb-item active">Tambah Data SPK</li>
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
                    <a href="{{ url('kontrak/'.Crypt::encryptString($main['kontrak']->id)) }}" class="btn btn-outline-primary btn-sm pop-info" title="Kembali" ><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header bg-info p-1" id="headingfour">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                        <strong class="text-white">#4 - LAMPIRAN DOKUMEN SPK</strong>
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapsefour" class="collapse show" aria-labelledby="headingfour" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @if ($main['datapekerjaan']->jenis_pekerjaan == 'fisik')
                                            @include('admin.kontrak.section.spkexcel')
                                        @else    
                                            @include('admin.kontrak.section.spkkonsultan')
                                        @endif
                                    </div>
                                </div>
                            </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    @section('script')
        <!-- BS-Stepper -->
      <script src=" {{ asset('template/admin/lte/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
      <!-- Select2 -->
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
            $(function () {
              //Initialize Select2 Elements
              $('.select2bs4').select2({
                theme: 'bootstrap4'
              })
            })
          </script>
            <script type="text/javascript">
                function cek_perusahaan(){
                    var id = $("#dataperusahaan").val();
                    $.ajax({
                        url: "{{ url('ajax/perusahaan') }}",
                        data:"id="+id ,
                    }).success(function (data) {
                        var json = data,
                        obj = JSON.parse(json);
                        $('#direktur').val(obj.direktur);
                        $('#alamat').val(obj.alamat);
                        $('#bank').val(obj.bank);
                        $('#notaris').val(obj.notaris);
                        $('#akta').val(obj.akta);
                        $('#npwp').val(obj.npwp);
                        $('#no_rek').val(obj.no_rek);
            
                    });
                }
                function cek_pekerjaan(){
                    var id = $("#datapekerjaan").val();
                    $.ajax({
                        url: "{{ url('ajax/pekerjaan') }}",
                        data:"id="+id ,
                    }).success(function (data) {
                        var json = data,
                        obj = JSON.parse(json);
                        $('#kode_tender').val(obj.kode_tender);
                        $('#sub_kegiatan').val(obj.sub_kegiatan);
                        $('#nama_paket').val(obj.nama_paket);
                        $('#nama_kegiatan').val(obj.nama_kegiatan);
                        $('#kecamatan').val(obj.kecamatan);
                        $('#kode_belanja').val(obj.kode_belanja);
                        $('#sumber_dana').val(obj.sumber_dana);
                        $('#tahun_anggaran').val(obj.tahun_anggaran);
                        $('#jenis_pekerjaan').val(obj.jenis_pekerjaan);
                    });
                }
            </script>
       
    @endsection

    @endsection

