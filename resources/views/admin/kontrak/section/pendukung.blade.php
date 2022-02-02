<div class="bs-stepper">
  <div class="bs-stepper-header" role="tablist">
    <!-- your steps here -->
   
    <div class="step" data-target="#pekerjaan">
      <button type="button" class="step-trigger" role="tab" aria-controls="pekerjaan" id="pekerjaan-trigger">
        <span class="bs-stepper-circle">1</span>
        <span class="bs-stepper-label">Pekerjaan</span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#perusahaan">
      <button type="button" class="step-trigger" role="tab" aria-controls="perusahaan" id="perusahaan-trigger">
        <span class="bs-stepper-circle">2</span>
        <span class="bs-stepper-label">Perusahaan</span>
      </button>
    </div>
    <div class="line"></div>
    <div class="step" data-target="#pegawai">
      <button type="button" class="step-trigger" role="tab" aria-controls="pegawai" id="pegawai-trigger">
        <span class="bs-stepper-circle">3</span>
        <span class="bs-stepper-label">Tim Lokus</span>
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
            <select class="form-control select2bs4" name="pekerjaan_id" style="width: 100%;" required>
              <option value="" selected="selected">-- pekerjaan --</option>
              @foreach ($main['pekerjaan'] as $item)
                <option value="{{ $item->id }}" @if ($main['kontrak']->pekerjaan_id == $item->id)
                  selected
              @endif>{{ ucwords($item->kode_kegiatan.' | '.$item->nama_kegiatan) }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label>Jika belum ada data!</label><br>
            <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#tambahpekerjaan">Tambah Pekerjaan Baru</a>
          </div>
        </div>
      </div>
      <button class="btn btn-primary" type="button" onclick="stepper.next()">Selanjutnya</button>
   
    </div>
    <div id="perusahaan" class="content" role="tabpanel" aria-labelledby="perusahaan-trigger">
      <div class="form-group">
        <div class="row">
          <div class="col-md-8">
          <label>Perusahaan</label>
            <select class="form-control select2bs4" name="perusahaan_id" style="width: 100%;" required>
              <option value="" selected="selected">-- perusahaan --</option>
              @foreach ($main['perusahaan'] as $item)
                <option value="{{ $item->id }}" @if ($main['kontrak']->perusahaan_id == $item->id)
                  selected
              @endif>{{ ucwords($item->nama_perusahaan.' | '.$item->direktur) }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label>Jika belum ada data!</label><br>
            <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#tambahperusahaan">Tambah Perusahaan Baru</a>
          </div>
        </div>
      </div>
      <button class="btn btn-primary" type="button" onclick="stepper.previous()">Sebelumnya</button>
      <button class="btn btn-primary" type="button" onclick="stepper.next()">Selanjutnya</button>
  
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
          </div>
        </div>
      </div>
      <button class="btn btn-primary" type="button" onclick="stepper.previous()">Sebelumnya</button>
      <button type="submit" class="btn btn-primary">SIMPAN DATA PENDUKUNG</button>
    </div>
    </form>
  </div>
</div>
       