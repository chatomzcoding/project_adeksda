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
                            <strong class="text-white">#1 - INFORMASI KONTRAK</strong>
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
                                    <strong class="text-white">#2 - DATA PENDUKUNG</strong>
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
                        @if ($main['collapse'] > 2)
                            <div class="card">
                                <div class="card-header bg-info p-1" id="headingThree">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <strong class="text-white">#3 - DOKUMEN</strong>
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
                        
                        @if ($main['collapse'] > 3)
                            <div class="card">
                                <div class="card-header bg-info p-1" id="headingfour">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                        <strong class="text-white">#4 - LAMPIRAN DOKUMEN SPK</strong>
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapsefour" class="collapse @if ($main['collapse'] == 4)
                                show
                                @endif" aria-labelledby="headingfour" data-parent="#accordionExample">
                                    <div class="card-body">
                                    @include('admin.kontrak.section.dokumenspk')
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($main['collapse'] > 4)
                            <div class="card">
                                <div class="card-header bg-info p-1" id="headingfive">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsfive" aria-expanded="false" aria-controls="collapsfive">
                                        <strong class="text-white">#5 - DATA ADENDUM</strong>
                                    </button>
                                    </h2>
                                </div>
                                <div id="collapsfive" class="collapse @if ($main['collapse'] == 5)
                                show
                                @endif" aria-labelledby="headingfive" data-parent="#accordionExample">
                                    <div class="card-body">
                                    @include('admin.kontrak.section.adendum')
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
            
                    //     var $jenis_kelamin = $('input:radio[name=jenis_kelamin]');
                    // if(obj.jenis_kelamin == 'laki-laki'){
                    //     $jenis_kelamin.filter('[value=laki-laki]').prop('checked', true);
                    // }else{
                    //     $jenis_kelamin.filter('[value=perempuan]').prop('checked', true);
                    // }
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
                        $('#kecamatan').val(obj.kecamatan);
                        $('#kode_belanja').val(obj.kode_belanja);
                        $('#sumber_dana').val(obj.sumber_dana);
                        $('#tahun_anggaran').val(obj.tahun_anggaran);
                        $('#jenis_pekerjaan').val(obj.jenis_pekerjaan);
            
                    });
                }
        </script>
        <script  type="text/javascript">
          $(document).ready(function(){
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button1'); //Add button selector
                var wrapper = $('.field_wrapper1'); //Input field wrapper
                // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
                var fieldHTML = '<div class="row mt-2"><input type="text" name="uraian1[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required><input type="number" min="1" name="kuantitas1[]" placeholder="kuantitas" class="form-control col-md-2"><input type="text"  name="satuan1[]" class="form-control col-md-2" placeholder="satuan"><input type="number"  name="harga1[]" class="form-control col-md-2" placeholder="harga"><a href="javascript:void(0);" class="remove_button1 col-md-1 btn btn-danger" title="Add field"><i class="fas fa-minus"></i></a></div>'; //New input field html
                var x = 1; //Initial field counter is 1
                $(addButton).click(function(){ //Once add button is clicked
                    if(x < maxField){ //Check maximum number of input fields
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); // Add field html
                    }
                });
                $(wrapper).on('click', '.remove_button1', function(e){ //Once remove button is clicked
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        </script>
        <script  type="text/javascript">
          $(document).ready(function(){
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button2'); //Add button selector
                var wrapper = $('.field_wrapper2'); //Input field wrapper
                // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
                var fieldHTML = '<div class="row mt-2"><input type="text" name="uraian2[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required><input type="number" min="1" name="kuantitas2[]" placeholder="kuantitas" class="form-control col-md-2"><input type="text"  name="satuan2[]" class="form-control col-md-2" placeholder="satuan"><input type="number"  name="harga2[]" class="form-control col-md-2" placeholder="harga"><a href="javascript:void(0);" class="remove_button2 col-md-1 btn btn-danger" title="Add field"><i class="fas fa-minus"></i></a></div>'; //New input field html
                var x = 1; //Initial field counter is 1
                $(addButton).click(function(){ //Once add button is clicked
                    if(x < maxField){ //Check maximum number of input fields
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); // Add field html
                    }
                });
                $(wrapper).on('click', '.remove_button2', function(e){ //Once remove button is clicked
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        </script>
        <script  type="text/javascript">
          $(document).ready(function(){
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button3'); //Add button selector
                var wrapper = $('.field_wrapper3'); //Input field wrapper
                // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
                var fieldHTML = '<div class="row mt-2"><input type="text" name="uraian3[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required><input type="number" min="1" name="kuantitas3[]" placeholder="kuantitas" class="form-control col-md-2"><input type="text"  name="satuan3[]" class="form-control col-md-2" placeholder="satuan"><input type="number"  name="harga3[]" class="form-control col-md-2" placeholder="harga"><a href="javascript:void(0);" class="remove_button3 col-md-1 btn btn-danger" title="Add field"><i class="fas fa-minus"></i></a></div>'; //New input field html
                var x = 1; //Initial field counter is 1
                $(addButton).click(function(){ //Once add button is clicked
                    if(x < maxField){ //Check maximum number of input fields
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML); // Add field html
                    }
                });
                $(wrapper).on('click', '.remove_button3', function(e){ //Once remove button is clicked
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        </script>
    @endsection

    @endsection

