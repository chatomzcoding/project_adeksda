@extends('layouts.admin')

@section('title')
    Data Tim Lokus
@endsection

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Data Tim Lokus</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Tim Lokus</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection
   
@section('content')
    
    <div class="container-fluid">
        <div class="row">
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-user-tie"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Tim Lokus</span>
                  <span class="info-box-number">
                        {{ $main['statistik']['total1']}}
                  </span>
                </div>
              </div>
            </div>
            {{-- end col --}}
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-tie"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Laki laki</span>
                  <span class="info-box-number">
                        {{ $main['statistik']['total2']}}
                  </span>
                </div>
              </div>
            </div>
            {{-- end col --}}
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-tie"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Perempuan</span>
                  <span class="info-box-number">
                        {{ $main['statistik']['total3']}}
                  </span>
                </div>
              </div>
            </div>
            {{-- end col --}}
            {{-- start col --}}
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-user-tie"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Siswa Aktif</span>
                  <span class="info-box-number">
                        {{ $main['statistik']['total4']}}
                  </span>
                </div>
              </div>
            </div>
            {{-- end col --}}
        </div>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">Daftar Unit</h3> --}}
                    <a href="#" class="btn btn-outline-primary btn-sm pop-info" title="Tambah Data List Baru" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Tambah</a>
                    <div class="float-right">
                        <a href="{{ url('cetakdata?s=satuanbarang') }}" target="_blank" class="btn btn-outline-info btn-sm  pop-info" title="Cetak Data Satuan Barang"><i class="fas fa-print"></i> CETAK</a>
                        <a href="#" data-toggle="modal" data-target="#info" class="btn btn-outline-info btn-sm  pop-info" title="Informasi"><i class="fas fa-info"></i> INFO</a>
                    </div>
              </div>
              <div class="card-body">
                  @include('sistem.notifikasi')
                  {{-- <section class="mb-3">
                      <form action="{{ url($main['link']) }}" method="get">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="bg-primary p-1 text-center rounded">
                                    <strong><i class="fas fa-filter"></i> FILTER</strong>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <select name="jk" id="" class="form-control" onchange="this.form.submit();">
                                    <option value="semua">-- semua jenis kelamin --</option>
                                </select>
                            </div>
                        </div>
                    </form>
                  </section> --}}
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Aksi</th>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            @forelse ($data as $item)
                            <tr>
                                    <td class="text-center">{{ $item['no']}}</td>
                                    <td class="text-center">
                                        <form id="data-{{ $item['id'] }}" action="{{url($main['link'].'/'.$item['id'])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            </form>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-sm btn-flat">Aksi</button>
                                                <button type="button" class="btn btn-info btn-sm btn-flat dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                  <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <button type="button" data-toggle="modal"  data-id="{{ $item['id'] }}" data-target="#ubah" title="" class="dropdown-item" data-original-title="Edit Data"><i class="fa fa-edit text-success" style="width: 25px"> </i> EDIT
                                                    </button>
                                                  <div class="dropdown-divider"></div>
                                                  <button onclick="deleteRow( {{ $item['id'] }} )" class="dropdown-item"><i class="fas fa-trash-alt text-danger"style="width: 25px"></i> HAPUS</button>
                                                </div>
                                            </div>
                                    </td>
                                    <td>{{ $item['nip']}}</td>
                                    <td>{{ $item['nama']}}</td>
                                    <td>{{ $item['jabatan']}}</td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7" class="font-italic">-- belum ada data --</td>
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
    <!-- /.modal -->

    {{-- modal edit --}}
    <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form action="{{ route($main['link'].'.update','test')}}" method="post">
                @csrf
                @method('patch')
            <div class="modal-header">
            <h4 class="modal-title">Edit Data Satuan Barang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-3">
                <input type="hidden" name="id" id="id">
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
                var nama = button.data('nama')
                var nis = button.data('nis')
                var tgl_lahir = button.data('tgl_lahir')
                var alamat = button.data('alamat')
                var no_telp = button.data('no_telp')
                var jk = button.data('jk')
                var status = button.data('status')
                var id = button.data('id')
        
                var modal = $(this)
        
                modal.find('.modal-body #nama').val(nama);
                modal.find('.modal-body #nis').val(nis);
                modal.find('.modal-body #tgl_lahir').val(tgl_lahir);
                modal.find('.modal-body #alamat').val(alamat);
                modal.find('.modal-body #no_telp').val(no_telp);
                modal.find('.modal-body #jk').val(jk);
                modal.find('.modal-body #status').val(status);
                modal.find('.modal-body #id').val(id);
            })
        </script>
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
        </script>
    @endsection

    @endsection

