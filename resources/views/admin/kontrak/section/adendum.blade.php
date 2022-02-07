<form action="{{ url('kontrak') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">
    <input type="hidden" name="sesi" value="adendum">
    <div class="form-group row">
        <label for="" class="col-md-4">Nomor Adendum</label>
        <input type="text" name="no_adendum" value="{{ $main['kontrak']->no_adendum }}" class="form-control col-md-8">
    </div>
    <div class="form-group row">
        <label for="" class="col-md-4">Tanggal Adendum</label>
        <input type="date" name="tgl_adendum" value="{{ $main['kontrak']->tgl_adendum }}" class="form-control col-md-8">
    </div>
    <div class="form-group row">
        <label for="" class="col-md-4">Nilai</label>
        <input type="number" name="nilai" value="{{ $main['kontrak']->nilai }}" class="form-control col-md-8">
    </div>
    <div class="form-group row">
        <label for="" class="col-md-4">Masa Kontrak (Adendum)</label>
        <input type="number" name="masakontrak_adendum" value="{{ $main['kontrak']->masakontrak_adendum }}" class="form-control col-md-8">
    </div>
    <div class="form-group row">
        <label for="" class="col-md-4">Tanggal Akhir Kontrak</label>
        <input type="date" name="tgl_akhir_kontrak" value="{{ $main['kontrak']->tgl_akhir_kontrak }}" class="form-control col-md-8">
    </div>
    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN KONTRAK</button>
    </div>
</form>