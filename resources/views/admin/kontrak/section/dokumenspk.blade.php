<form action="{{ url('dokumenspk') }}" method="post">
    @csrf
    <input type="hidden" name="kontrak_id" value="{{ $main['kontrak']->id }}">
    <div class="card">
        <div class="card-header">
            <strong>PEKERJAAN PERSIAPAN</strong>
        </div>
        <div class="card-body">
            <div class="field_wrapper1 p-2">
                <div class="row">
                    <input type="text" name="uraian1[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required>
                    <input type="number" min="1" name="kuantitas1[]" placeholder="kuantitas" class="form-control col-md-2">
                    <input type="text"  name="satuan1[]" class="form-control col-md-2" placeholder="satuan">
                    <input type="number"  name="harga1[]" class="form-control col-md-2" placeholder="harga">
                    <td> <a href="javascript:void(0);" class="add_button1 col-md-1 btn btn-info" title="Add field"><i class="fas fa-plus"></i></a></td>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <strong>PEKERJAAN PELAKSANA</strong>
        </div>
        <div class="card-body">
            <div class="field_wrapper2 p-2">
                <div class="row">
                    <input type="text" name="uraian2[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required>
                    <input type="number" min="1" name="kuantitas2[]" placeholder="kuantitas" class="form-control col-md-2">
                    <input type="text"  name="satuan2[]" class="form-control col-md-2" placeholder="satuan">
                    <input type="number"  name="harga2[]" class="form-control col-md-2" placeholder="harga">
                    <td> <a href="javascript:void(0);" class="add_button2 col-md-1 btn btn-info" title="Add field"><i class="fas fa-plus"></i></a></td>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <strong>PEKERJAAN PEMBANTU</strong>
        </div>
        <div class="card-body">
            <div class="field_wrapper3 p-2">
                <div class="row">
                    <input type="text" name="uraian3[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required>
                    <input type="number" min="1" name="kuantitas3[]" placeholder="kuantitas" class="form-control col-md-2">
                    <input type="text"  name="satuan3[]" class="form-control col-md-2" placeholder="satuan">
                    <input type="number"  name="harga3[]" class="form-control col-md-2" placeholder="harga">
                    <td> <a href="javascript:void(0);" class="add_button3 col-md-1 btn btn-info" title="Add field"><i class="fas fa-plus"></i></a></td>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right py-2">
        <button type="submit" class="btn btn-primary">SELANJUTNYA</button>
    </div>
    
</form>