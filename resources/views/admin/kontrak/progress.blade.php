@extends('layouts.admin')

@section('title')
    Data Progress
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Progress</h1><p>{{ $kontrak->pekerjaan->nama_paket }}</p>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Progress</li>
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
                  <a href="{{ url('kontrak?sesi=rekap') }}" class="btn btn-secondary btn-sm"><i class="fas fa-angle-double-left"></i> Kembali</a>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Tanggal Input</th>
                                <th>Tanggal Progress</th>
                                <th>Nilai Fisik</th>
                                <th>Nilai Panjang</th>
                                <th>Dokumentasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kontrak->progress as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td>{{ $item->created_at }}</td>                                        
                                    <td>{{ date_indo($item->tanggal) }}</td>                                        
                                    <td class="text-center">{{ $item->nilai }} %</td>          
                                    <td class="text-center">{{ $item->nilai_panjang }} m</td>
                                    <td>
                                        @if (!is_null($item->photo))
                                            <img src="{{ asset('img/konsultan/'.$item->photo) }}" alt="dokumentasi" width="100px">
                                        @endif
                                    </td>
                            </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5" class="font-italic">-- belum ada data --</td>
                                </tr>
                            @endforelse
                    </table>
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

    @endsection

