    @if ($main['kontrak'])
    <form action="{{ url('kontrak') }}" method="post">
        @csrf
        <input type="hidden" name="sesi" value="updateinformasi">
        <input type="hidden" name="id" value="{{ $main['kontrak']->id }}">
        <section>
            <div class="form-group row">
                <label for="" class="col-md-2 p-1">Masa Kontrak {!! ireq() !!}</label>
                <div class="col-md-4">
                    <input type="number" name="masa_kontrak" value="{{ $main['kontrak']->masa_kontrak }}" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-1">Nilai Penawaran {!! ireq() !!}</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="nilai_penawaran" id="rupiah"  value="{{ $main['kontrak']->nilai_penawaran }}" class="form-control" required>
                                </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4  p-1">Nilai Terkoreksi {!! ireq() !!}</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="nilai_terkoreksi" id="rupiah1"  value="{{ $main['kontrak']->nilai_terkoreksi }}" class="form-control" required>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4  p-1">Nilai Negosiasi {!! ireq() !!}</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="nilai_negosiasi" id="rupiah2"  value="{{ $main['kontrak']->nilai_negosiasi }}" class="form-control" required>
                                </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4  p-1">Nilai Pekerjaan {!! ireq() !!}</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="nilai_pekerjaan" id="rupiah3"  value="{{ $main['kontrak']->nilai_pekerjaan }}" class="form-control" required>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    <button type="submit" class="btn btn-success">SIMPAN PERUBAHAN <i class="fas fa-angle-right"></i></button>
                </div>
            </div>
        </section>
    </form>
    @else
    <form action="{{ url($main['link']) }}" method="post">
        @csrf
        <input type="hidden" name="sesi" value="informasi">
        <section>
            <div class="form-group row">
                <label for="" class="col-md-2 p-1">Masa Kontrak {!! ireq() !!}</label>
                <div class="col-md-4">
                    <input type="number" name="masa_kontrak" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="" class="col-md-4 p-1">Nilai Penawaran {!! ireq() !!}</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="nilai_penawaran" id="rupiah" class="form-control" required>
                                </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4  p-1">Nilai Terkoreksi {!! ireq() !!}</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="nilai_terkoreksi" id="rupiah1" class="form-control" required>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-3">
                    <div class="form-group row">
                        <label for="" class="col-md-4  p-1">Nilai Negosiasi {!! ireq() !!}</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="nilai_negosiasi" id="rupiah2" class="form-control" required>
                                </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-4  p-1">Nilai Pekerjaan {!! ireq() !!}</label>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="nilai_pekerjaan" id="rupiah3" class="form-control" required>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary">SELANJUTNYA <i class="fas fa-angle-right"></i></button>
                </div>
            </div>
        </section>
    </form>
    @endif