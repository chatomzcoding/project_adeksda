<form action="{{ url('kontrak') }}" method="post">
    @csrf
    <input type="hidden" name="sesi" value="dokumen">
    <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">
    <div class="row">
        <div class="col-md-4">
            <strong>1. PENGADAAN {!! ireq() !!}</strong>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor Pengadaan</label>
                        <input type="text" name="no_pengadaan" value="{{ $main['kontrak']->no_pengadaan }}" class="form-control" required>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Nomor Pengadaan</label>
                        <input type="date" name="tgl_pengadaan" value="{{ $main['kontrak']->tgl_pengadaan }}" class="form-control" required>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <strong>2. BAHP {!! ireq() !!}</strong>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor BAHP</label>
                        <input type="text" name="no_bahp" value="{{ $main['kontrak']->no_bahp }}" class="form-control" required>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Nomor BAHP</label>
                        <input type="date" name="tgl_bahp" value="{{ $main['kontrak']->tgl_bahp }}" class="form-control" required>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <strong>3. SPPBJ {!! ireq() !!}</strong>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor SPPBJ</label>
                        <input type="text" name="no_sppbj" value="{{ $main['kontrak']->no_sppbj }}" class="form-control" required>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Nomor SPPBJ</label>
                        <input type="date" name="tgl_sppbj" value="{{ $main['kontrak']->tgl_sppbj }}" class="form-control" required>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <strong>4. BARPK {!! ireq() !!}</strong>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor BARPK</label>
                        <input type="text" name="no_barpk" value="{{ $main['kontrak']->no_barpk }}" class="form-control" required>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Nomor BARPK</label>
                        <input type="date" name="tgl_barpk" value="{{ $main['kontrak']->tgl_barpk }}" class="form-control" required>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <strong>5. SPK {!! ireq() !!}</strong>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor SPK</label>
                        <input type="text" name="no_spk" value="{{ $main['kontrak']->no_spk }}" class="form-control" required>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Nomor SPK</label>
                        <input type="date" name="tgl_spk" value="{{ $main['kontrak']->tgl_spk }}" class="form-control" required>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <strong>6. SPMK {!! ireq() !!}</strong>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor SPMK</label>
                        <input type="text" name="no_spmk" value="{{ $main['kontrak']->no_spmk }}" class="form-control" required>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Nomor SPMK</label>
                        <input type="date" name="tgl_spmk" value="{{ $main['kontrak']->tgl_spmk }}" class="form-control" required>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <strong>7. SPL {!! ireq() !!}</strong>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor SPL</label>
                        <input type="text" name="no_spl" value="{{ $main['kontrak']->no_spl }}" class="form-control" required>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Nomor SPL</label>
                        <input type="date" name="tgl_spl" value="{{ $main['kontrak']->tgl_spl }}" class="form-control" required>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <strong>8. SPP {!! ireq() !!}</strong>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nomor SPP</label>
                        <input type="text" name="no_spp"  value="{{ $main['kontrak']->no_spp }}" class="form-control" required>
                    </div>
                </div>      
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Nomor SPP</label>
                        <input type="date" name="tgl_spp" value="{{ $main['kontrak']->tgl_spp }}" class="form-control" required>
                    </div>
                </div>      
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-right">
            <button type="submit" class="btn btn-primary"> TAHAP SELANJUTNYA <i class="fas fa-angle-double-right"></i></button>
        </div>
    </div>
</form>