@extends('layouts.admin')

@section('title')
    Data Pekerjaan
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Pekerjaan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Pekerjaan</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
   
@section('content')
    
    <div class="container-fluid">
        <div class="row">
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Pekerjaan</span>
                  <span class="info-box-number">
                        {{ $main['statistik']['total']}}
                  </span>
                </div>
              </div>
            </div>
            {{-- end col --}}
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-6">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Kecamatan</span>
                  <span class="info-box-number">
                        {{ $main['statistik']['kecamatan']}}
                  </span>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                    <a href="#" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah</a>
                    <a href="{{ url('pekerjaan') }}" class="btn btn-outline-secondary btn-sm pop-info" title="bersihkan" ><i class="fas fa-sync"></i> Bersihkan Filter</a>
                    <div class="float-right">
                        {{-- <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a> --}}
                        {{-- <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a> --}}
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  <section class="mb-3">
                      <form action="{{ url($main['link']) }}" method="get">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <select name="jenis_pekerjaan" id="jenis_pekerjaan" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- Jenis Pekerjaan --</option>
                                    @foreach ($jenispekerjaan as $item)
                                        <option value="{{ $item->nama }}" @if ($main['f']['jenis_pekerjaan'] == $item->nama)
                                            selected
                                        @endif>{{ strtoupper($item->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="kecamatan" id="kecamatan" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- Kecamatan --</option>
                                    @foreach ($kecamatan as $item)
                                        <option value="{{ $item->nama }}" @if ($main['f']['kecamatan'] == $item->nama)
                                            selected
                                        @endif>{{ strtoupper($item->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="sumber_dana" id="sumber_dana" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- Sumber Dana --</option>
                                    @foreach ($sumberdana as $item)
                                        <option value="{{ $item->nama }}" @if ($main['f']['sumber_dana'] == $item->nama)
                                            selected
                                        @endif>{{ strtoupper($item->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="tahun_anggaran" id="tahun_anggaran" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- Tahun Anggaran --</option>
                                    @for ($i = ambil_tahun(); $i > 2010; $i--)
                                        <option value="{{ $i }}" @if ($main['f']['tahun_anggaran'] == $i)
                                            selected
                                        @endif>{{ $i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                  </section>
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Aksi</th>
                                <th>Nama Kegiatan</th>
                                <th>Nama Paket Pekerjaan</th>
                                <th>Alamat</th>
                                <th>Sumber Dana</th>
                                <th>Jenis</th>
                                <th>Tahun Anggaran</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($pekerjaan as $item)
                            <tr>
                                    <td class="text-center">{{ $loop->iteration}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item->id }}" action="{{url($main['link'].'/'.$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm btn-flat">Aksi</button>
                                                <button type="button" class="btn btn-info btn-sm btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                  <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <button type="button" data-toggle="modal" data-kode_kegiatan="{{ $item->kode_kegiatan }}" data-kode_tender="{{ $item->kode_tender }}"  data-nama_kegiatan="{{ $item->nama_kegiatan }}"  data-sub_kegiatan="{{ $item->sub_kegiatan }}"  data-nama_paket="{{ $item->nama_paket }}"  data-kecamatan="{{ $item->kecamatan }}"  data-kode_belanja="{{ $item->kode_belanja }}" data-sumber_dana="{{ $item->sumber_dana }}" data-tahun_anggaran="{{ $item->tahun_anggaran }}" data-jenis_pekerjaan="{{ $item->jenis_pekerjaan }}" data-id="{{ $item->id }}" data-target="#ubah" title="" class="dropdown-item" data-original-title="Edit Data"><i class="fa fa-edit text-success" style="width: 25px"> </i> EDIT
                                                    </button>
                                                  <div class="dropdown-divider"></div>
                                                  <button onclick="deleteRow( {{ $item->id }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button>
                                                </div>
                                            </div>
                                    </td>
                                    <td>{{ $item->nama_kegiatan}}</td>
                                    <td>{{ $item->nama_paket}}</td>
                                    <td>{{ $item->kecamatan}}</td>
                                    <td>{{ $item->sumber_dana}}</td>
                                    <td>{{ $item->jenis_pekerjaan}}</td>
                                    <td>{{ $item->tahun_anggaran}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="8" class="font-italic">-- belum ada data --</td>
                                </tr>
                            @endforelse
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="tambah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ url($main['link'])}}" method="post" enctype="multipart/form-data">
                @csrf
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
    <!-- /.modal -->

    {{-- modal edit --}}
    <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route($main['link'].'.update','test')}}" method="post">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Data Pekerjaan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
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
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> SIMPAN PERUBAHAN</button>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- /.modal -->

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
            $('#ubah').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var kode_kegiatan = button.data('kode_kegiatan')
                var kode_tender = button.data('kode_tender')
                var nama_kegiatan = button.data('nama_kegiatan')
                var sub_kegiatan = button.data('sub_kegiatan')
                var nama_paket = button.data('nama_paket')
                var kecamatan = button.data('kecamatan')
                var kode_belanja = button.data('kode_belanja')
                var sumber_dana = button.data('sumber_dana')
                var tahun_anggaran = button.data('tahun_anggaran')
                var jenis_pekerjaan = button.data('jenis_pekerjaan')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #kode_kegiatan').val(kode_kegiatan);
                modal.find('.modal-body #kode_tender').val(kode_tender);
                modal.find('.modal-body #nama_kegiatan').val(nama_kegiatan);
                modal.find('.modal-body #sub_kegiatan').val(sub_kegiatan);
                modal.find('.modal-body #nama_paket').val(nama_paket);
                modal.find('.modal-body #kecamatan').val(kecamatan);
                modal.find('.modal-body #kode_belanja').val(kode_belanja);
                modal.find('.modal-body #sumber_dana').val(sumber_dana);
                modal.find('.modal-body #tahun_anggaran').val(tahun_anggaran);
                modal.find('.modal-body #jenis_pekerjaan').val(jenis_pekerjaan);
                modal.find('.modal-body #id').val(id);
            })
        </script>
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

