@extends('layouts.admin')
@section('title')
    Datapokok
@endsection
@section('header')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Data Pokok</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
        <li class="breadcrumb-item active">Detail Data Pokok</li>
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
                <h3 class="card-title">PENGATURAN DATA POKOK</h3>
            </div>
            <div class="card-body">
                @include('sistem.notifikasi')
                <form action="{{ url('datapokok/'.$datapokok->id) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nama Instansi</label>
                        <input type="text" name="nama_instansi" value="{{ $datapokok->nama_instansi }}" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Alamat Instansi</label>
                        <input type="text" name="alamat_instansi" value="{{ $datapokok->alamat_instansi }}" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Kode POS</label>
                        <input type="text" name="kode_pos" value="{{ $datapokok->kode_pos }}" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Nomor Keputusan Kepala Dinas</label>
                        <input type="text" name="no_keputusan" value="{{ $datapokok->no_keputusan }}" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Tanggal Keputusan Kepala Dinas</label>
                        <input type="date" name="tgl_keputusan" data-date="" value="{{ $datapokok->tgl_keputusan }}" data-date-format="DD-MM-YYY" class="form-control col-md-8">
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Pejabat Pembuatan Keputusan (PPK)</label>
                        <select name="id_ppk" id="" class="form-control col-md-8">
                            @foreach ($tim as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $datapokok->id_ppk)
                                    selected
                                @endif>{{ $item->nama.' | '.$item->nip }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4">Pejabat Pelaksana Teknis Kegiatan (PPTK)</label>
                        <select name="id_pptk" id="" class="form-control col-md-8">
                            @foreach ($tim as $item)
                                <option value="{{ $item->id }}" @if ($item->id == $datapokok->id_pptk)
                                    selected
                                @endif>{{ $item->nama.' | '.$item->nip }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection

    @section('script')
        
        <script>
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var name = button.data('name')
                var level = button.data('level')
                var email = button.data('email')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #name').val(name);
                modal.find('.modal-body #level').val(level);
                modal.find('.modal-body #email').val(email);
                modal.find('.modal-body #id').val(id);
            })
        </script>
        <script>
            $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
