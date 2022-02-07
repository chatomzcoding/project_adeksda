<div class="bs-stepper">
  <div class="bs-stepper-header" role="tablist">
    <!-- your steps here -->
   
    <div class="step" data-target="#pekerjaan">
      <button type="button" class="step-trigger" role="tab" aria-controls="pekerjaan" id="pekerjaan-trigger">
        <span class="bs-stepper-circle">1</span>
        <span class="bs-stepper-label">PEKERJAAN</span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#perusahaan">
      <button type="button" class="step-trigger" role="tab" aria-controls="perusahaan" id="perusahaan-trigger">
        <span class="bs-stepper-circle">2</span>
        <span class="bs-stepper-label">PERUSAHAAN</span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#pegawai">
      <button type="button" class="step-trigger" role="tab" aria-controls="pegawai" id="pegawai-trigger">
        <span class="bs-stepper-circle">3</span>
        <span class="bs-stepper-label">TIM TEKNIS</span>
      </button>
    </div>
  </div>
  <div class="bs-stepper-content">
    <form action="{{ url('kontrak') }}" method="post">
      @csrf
      <input type="hidden" name="sesi" value="pendukung">
      <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">
    <!-- your steps content here -->
   
    <div id="pekerjaan" class="content" role="tabpanel" aria-labelledby="pekerjaan-trigger">
      <div class="form-group">
        <div class="row">
          <div class="col-md-8">
          <label>Pekerjaan</label>
            <select class="form-control select2bs4" name="pekerjaan_id" id="datapekerjaan" onchange="cek_pekerjaan()" style="width: 100%;" required>
              <option value="" selected="selected">-- pilih pekerjaan --</option>
              @foreach ($main['pekerjaan'] as $item)
                <option value="{{ $item->id }}" @if ($main['kontrak']->pekerjaan_id == $item->id)
                  selected
              @endif>{{ ucwords($item->kode_kegiatan.' || '.$item->nama_kegiatan) }}</option>
              @endforeach
            </select>
            <div class="row">
              <div class="col-md-12">
                <label for="" class="small">Nama Paket</label>
                <input type="text" id="nama_paket" class="form-control" value="{{ $main['datapekerjaan']->nama_paket }}" disabled>
                <label for="" class="small">Sub Kegiatan</label>
                <input type="text" id="sub_kegiatan" class="form-control" value="{{ $main['datapekerjaan']->sub_kegiatan }}" disabled>
              </div>
              <div class="col-md-6">
                <label for="" class="small">Kode Tender</label>
                <input type="text" id="kode_tender" class="form-control" value="{{ $main['datapekerjaan']->kode_tender }}" disabled>
                <label for="" class="small">Kode Belanja</label>
                <input type="text" id="kode_belanja" class="form-control" value="{{ $main['datapekerjaan']->kode_belanja }}" disabled>
                <label for="" class="small">Kecamatan</label>
                <input type="text" id="kecamatan" class="form-control" value="{{ $main['datapekerjaan']->kecamatan }}" disabled>
              </div>
              <div class="col-md-6">
                <label for="" class="small">Sumber Dana</label>
                <input type="text" id="sumber_dana" class="form-control" value="{{ $main['datapekerjaan']->sumber_dana }}" disabled>
                <label for="" class="small">Tahun Anggaran</label>
                <input type="text" id="tahun_anggaran" class="form-control" value="{{ $main['datapekerjaan']->tahun_anggaran }}" disabled>
                <label for="" class="small">Jenis Pekerjaan</label>
                <input type="text" id="jenis_pekerjaan" class="form-control" value="{{ $main['datapekerjaan']->jenis_pekerjaan }}" disabled>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <label>Jika belum ada data!</label><br>
            <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#tambahpekerjaan"><i class="fas fa-plus"></i> Tambah Pekerjaan Baru</a>
            <hr>
            <button class="btn btn-outline-secondary float-right" type="button" onclick="stepper.next()">Selanjutnya <i class="fas fa-angle-double-right"></i></button>
          </div>
        </div>
      </div>
     
   
    </div>
    <div id="perusahaan" class="content" role="tabpanel" aria-labelledby="perusahaan-trigger">
      <div class="form-group">
        <div class="row">
          <div class="col-md-8">
          <label>Perusahaan</label>
            <select class="form-control select2bs4" name="perusahaan_id" id="dataperusahaan" onchange="cek_perusahaan()" style="width: 100%;" required>
              <option value="" selected="selected">-- perusahaan --</option>
              @foreach ($main['perusahaan'] as $item)
                <option value="{{ $item->id }}" @if ($main['kontrak']->perusahaan_id == $item->id)
                  selected
              @endif>{{ ucwords($item->nama_perusahaan) }}</option>
              @endforeach
            </select>
            <div class="row">
              <div class="col-md-12">
                <label for="" class="small">Alamat</label>
                <input type="text" id="alamat" class="form-control" value="{{ $main['dataperusahaan']->alamat }}" disabled>
              </div>
              <div class="col-md-6">
                <label for="" class="small">Nama Direktur</label>
                <input type="text" id="direktur" class="form-control" value="{{ $main['dataperusahaan']->direktur }}" disabled>
                <label for="" class="small">Nama Notaris</label>
                <input type="text" id="notaris" class="form-control" value="{{ $main['dataperusahaan']->nama_notaris }}" disabled>
                <label for="" class="small">NPWP</label>
                <input type="text" id="npwp" class="form-control" value="{{ $main['dataperusahaan']->npwp }}" disabled>
              </div>
              <div class="col-md-6">
                <label for="" class="small">Bank/Cabang</label>
                <input type="text" id="bank" class="form-control" value="{{ $main['dataperusahaan']->bank.' / '.$main['dataperusahaan']->kantor_cabang }}" disabled>
                <label for="" class="small">No Rekening</label>
                <input type="text" id="no_rek" class="form-control" value="{{ $main['dataperusahaan']->no_rek }}" disabled>
                <label for="" class="small">No Akta / Tanggal</label>
                <input type="text" id="akta" class="form-control" value="{{ $main['dataperusahaan']->no_akta.' / '.$main['dataperusahaan']->tanggal_akta }}" disabled>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <label>Jika belum ada data!</label><br>
            <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#tambahperusahaan"><i class="fas fa-plus"></i> Tambah Perusahaan Baru</a>
            <hr>
            <button class="btn btn-outline-secondary" type="button" onclick="stepper.previous()"><i class="fas fa-angle-double-left"></i> Sebelumnya</button>
            <button class="btn btn-outline-secondary float-right" type="button" onclick="stepper.next()">Selanjutnya <i class="fas fa-angle-double-right"></i></button>
          </div>
        </div>
      </div>
  
    </div>
    <div id="pegawai" class="content" role="tabpanel" aria-labelledby="pegawai-trigger">
      <div class="form-group">
        <div class="row">
          <div class="col-md-8">
            <section class="form-group">
              <label>Pilih Ketua Teknis Kegiatan</label>
                <select class="form-control select2bs4" name="id_ketua" style="width: 100%;" required>
                  <option value="" selected="selected">-- cari NIP / Nama --</option>
                  @foreach ($main['timlokus'] as $item)
                    <option value="{{ $item->id }}" @if ($main['kontrak']->id_ketua == $item->id)
                        selected
                    @endif>{{ ucwords($item->nip.' | '.$item->nama) }}</option>
                  @endforeach
                </select>
            </section>
            <section class="form-group">
                <label>Pilih Sekretaris Teknis Kegiatan</label>
                  <select class="form-control select2bs4" name="id_sekretaris" style="width: 100%;" required>
                    <option value="" selected="selected">-- cari NIP / Nama --</option>
                    @foreach ($main['timlokus'] as $item)
                      <option value="{{ $item->id }}" @if ($main['kontrak']->id_sekretaris == $item->id)
                          selected
                      @endif>{{ ucwords($item->nip.' | '.$item->nama) }}</option>
                    @endforeach
                  </select>
            </section>
            <div class="form-group">
              <label>Pilih Anggota Teknis Kegiatan</label>
                <select class="form-control select2bs4" name="id_anggota" style="width: 100%;" required>
                  <option value="" selected="selected">-- cari NIP / Nama --</option>
                  @foreach ($main['timlokus'] as $item)
                    <option value="{{ $item->id }}" @if ($main['kontrak']->id_anggota == $item->id)
                        selected
                    @endif>{{ ucwords($item->nip.' | '.$item->nama) }}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="col-md-4">
            <label>Jika belum ada data!</label><br>
            <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#tambahtimlokus">Tambah Tim Lokus Baru</a>
            <hr>
            <button class="btn btn-outline-secondary" type="button" onclick="stepper.previous()"><i class="fas fa-angle-double-left"></i> Sebelumnya</button>
            <button type="submit" class="btn btn-outline-secondary float-right"> TAHAP SELANJUTNYA <i class="fas fa-angle-double-right"></i></button>
          </div>
        </div>
      </div>
    </div>
    </form>
    <button type="button" class="btn btn-info swalDefaultInfo">
      Launch Info Toast
    </button>
  </div>
</div>

@if ($main['kontrak'])
<div class="modal fade" id="tambahtimlokus">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <form action="{{ url('timteknis')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Tim Teknis</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body p-3">
          <section class="p-3">
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Tambahkan Untuk {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <select name="posisi" id="" class="form-control">
                          <option value="id_ketua">Ketua Teknis Kegiatan</option>
                          <option value="id_sekretaris">Sekretaris Teknis Kegiatan</option>
                          <option value="id_anggota">Anggota Teknis Kegiatan</option>
                      </select>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">NIP {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="nip" id="nip" maxlength="16" value="{{ old('nip') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Nama {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Jabatan {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">No SK</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="no_sk" id="no_sk" value="{{ old('no_sk') }}" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Tanggal</label>
                  <div class="col-md-8 p-0">
                      <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Perihal</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="perihal" id="perihal" value="{{ old('perihal') }}" class="form-control">
                  </div>
              </div>
          </section>
      </div>
      <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN TIM TEKNIS</button>
      </div>
  </form>
  </div>
  </div>
</div>

<div class="modal fade" id="tambahpekerjaan">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <form action="{{ url('pekerjaan')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">

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
                      <input type="text" name="kode_kegiatan" id="kode_kegiatan" maxlength="16" value="{{ old('kode_kegiatan') }}" class="form-control" placeholder="masukkan kode kegiatan" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Kode Tender {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="kode_tender" id="kode_tender" value="{{ old('kode_tender') }}" placeholder="masukkan kode tender" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                <label for="" class="col-md-4 p-2">Kode Belanja {!! ireq() !!}</label>
                <div class="col-md-8 p-0">
                    <input type="text" name="kode_belanja" id="kode_belanja" value="{{ old('kode_belanja') }}" class="form-control" placeholder="masukkan kode belanja" required>
                </div>
            </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Nama Kegiatan {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <textarea name="nama_kegiatan" id="nama_kegiatan" cols="30" rows="2" class="form-control" placeholder="masukkan nama kegiatan" required>{{ old('nama_kegiatan') }}</textarea>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Sub Kegiatan {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                    <textarea name="sub_kegiatan" id="sub_kegiatan" cols="30" rows="2" class="form-control" placeholder="masukkan sub kegiatan" required>{{ old('sub_kegiatan') }}</textarea>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Nama Paket {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                    <textarea name="nama_paket" id="nama_paket" cols="30" rows="2" class="form-control" placeholder="masukkan nama paket" required>{{ old('nama_paket') }}</textarea>
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
                      <select name="tahun_anggaran" id="tahun_anggaran" class="form-control" required>
                        @for ($i = ambil_tahun(); $i > 2010; $i--)
                          <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                      </select>
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
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN PEKERJAAN</button>
      </div>
  </form>
  </div>
  </div>
</div>

<div class="modal fade" id="tambahperusahaan">
  <div class="modal-dialog modal-lg">
  <div class="modal-content">
      <form action="{{ url('perusahaan')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Perusahaan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body p-3">
          <section class="p-3">
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Nama Perusahaan {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Nama Direktur {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="direktur" id="direktur" value="{{ old('direktur') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Alamat {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Nama Bank {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="bank" id="bank" value="{{ old('bank') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Kantor Cabang {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="kantor_cabang" id="kantor_cabang" value="{{ old('kantor_cabang') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">No Rekening {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="no_rek" id="no_rek" value="{{ old('no_rek') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">NPWP {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="npwp" id="npwp" value="{{ old('npwp') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">No Akta {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="no_akta" id="no_akta" value="{{ old('no_akta') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Tanggal Akta {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="date" name="tanggal_akta" id="tanggal_akta" value="{{ old('tanggal_akta') }}" class="form-control" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="" class="col-md-4 p-2">Nama Notaris {!! ireq() !!}</label>
                  <div class="col-md-8 p-0">
                      <input type="text" name="nama_notaris" id="nama_notaris" value="{{ old('nama_notaris') }}" class="form-control" required>
                  </div>
              </div>
          </section>
      </div>
      <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN PERUSAHAAN</button>
      </div>
  </form>
  </div>
  </div>
</div>
@endif

