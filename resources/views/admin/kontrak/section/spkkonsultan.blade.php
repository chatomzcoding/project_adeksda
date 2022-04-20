<form action="{{  route('dokumenspk.store')}}" method="post" id="spkkonsultan">
    @csrf
    <input type="hidden" name="kontrak_id" value="{{ $main['kontrak']->id }}">
    <input type="hidden" name="data11" id="datatenagaahli">
    <input type="hidden" name="data12" id="datatenagapendukung">
    <input type="hidden" name="data21" id="databiayasewa">
    <input type="hidden" name="data22" id="databiayarapat">
    <input type="hidden" name="data23" id="databiayakendaraan">
    <input type="hidden" name="data24" id="databiayapelaporan">
    <h2 class="ui header">A. BIAYA LANGSUNG PERSONIL</h2>
    <h3 class="ui header">I. Tenaga Ahli</h3>
    <div id="tenagaahli"></div>
    <div class="ui divider hidden"></div>
    <h2 class="ui header">II. Tenaga Pendukung</h2>
    <div id="tenagapendukung"></div>
    <div class="ui divider hidden"></div>
    <h2 class="ui header">B. BIAYA LANGSUNG NON PERSONIL</h2>
    <h2 class="ui header">I. Biaya Sewa Peralatan dan Operasional</h2>
    <div id="biayasewa"></div>
    <div class="ui divider hidden"></div>
    <h2 class="ui header">II. Biaya Rapat</h2>
    <div id="biayarapat"></div>
    <div class="ui divider hidden"></div>
    <h2 class="ui header">III. Biaya Kendaraan Operasional</h2>
    <div id="biayakendaraan"></div>
    <div class="ui divider hidden"></div>
    <h2 class="ui header">IV. Biaya Pelaporan dan Pengadaan</h2>
    <div id="biayapelaporan"></div>
    <div class="text-right">
        <button type="submit" class="btn btn-outline-primary">SELANJUTNYA <i class="fas fa-angle-double-right"></i></button>
    </div>
</form>

{{-- @section('script')
<script>
    // [ 'Crayons Crayola only (No Rose Art)', 2, 5.01, '=B1*C1' ],
    // [ 'Total', '=SUM(B1:B8)', '=ROUND(SUM(C1:C8), 2)', '' ],
    var data11 = @json($main['spkkonsultan'][0]);
    var data12 = @json($main['spkkonsultan'][1]);
    var data21 = @json($main['spkkonsultan'][2]);
    var data22 = @json($main['spkkonsultan'][3]);
    var data23 = @json($main['spkkonsultan'][4]);
    var data24 = @json($main['spkkonsultan'][5]);

    jspreadsheet(document.getElementById('tenagaahli'), {
        data:data11,
        columns: [
            { type: 'text', title:'Uraian Pekerjaan', width:'300' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'Personil', width:'70' },
            { type: 'text', title:'Durasi', width:'70' },
            { type: 'text', title:'MM', width:'70' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga Satuan', width:'120' },
            { type: 'text', title:'Jumlah Biaya', width:'200' },
        ],
        updateTable:function(instance, cell, col, row, val, label, cellName) {
            
        },
        columnSorting:false,
    });
    jspreadsheet(document.getElementById('tenagapendukung'), {
        data:data12,
        columns: [
            { type: 'text', title:'Uraian Pekerjaan', width:'300' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'Personil', width:'70' },
            { type: 'text', title:'Durasi', width:'70' },
            { type: 'text', title:'MM', width:'70' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga Satuan', width:'120' },
            { type: 'text', title:'Jumlah Biaya', width:'200' },
        ],
        updateTable:function(instance, cell, col, row, val, label, cellName) {
            
        },
        columnSorting:false,
    });
    jspreadsheet(document.getElementById('biayasewa'), {
        data:data21,
        columns: [
            { type: 'text', title:'Uraian Pekerjaan', width:'300' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'Personil', width:'70' },
            { type: 'text', title:'Durasi', width:'70' },
            { type: 'text', title:'MM', width:'70' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga Satuan', width:'120' },
            { type: 'text', title:'Jumlah Biaya', width:'200' },
        ],
        updateTable:function(instance, cell, col, row, val, label, cellName) {
            
        },
        columnSorting:false,
    });
    jspreadsheet(document.getElementById('biayarapat'), {
        data:data22,
        columns: [
            { type: 'text', title:'Uraian Pekerjaan', width:'300' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'Personil', width:'70' },
            { type: 'text', title:'Durasi', width:'70' },
            { type: 'text', title:'MM', width:'70' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga Satuan', width:'120' },
            { type: 'text', title:'Jumlah Biaya', width:'200' },
        ],
        updateTable:function(instance, cell, col, row, val, label, cellName) {
            
        },
        columnSorting:false,
    });

    jspreadsheet(document.getElementById('biayakendaraan'), {
        data:data23,
        columns: [
            { type: 'text', title:'Uraian Pekerjaan', width:'300' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'Personil', width:'70' },
            { type: 'text', title:'Durasi', width:'70' },
            { type: 'text', title:'MM', width:'70' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga Satuan', width:'120' },
            { type: 'text', title:'Jumlah Biaya', width:'200' },
        ],
        updateTable:function(instance, cell, col, row, val, label, cellName) {
            
        },
        columnSorting:false,
    });
    jspreadsheet(document.getElementById('biayapelaporan'), {
        data:data24,
        columns: [
            { type: 'text', title:'Uraian Pekerjaan', width:'300' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'', width:'1' },
            { type: 'text', title:'Personil', width:'70' },
            { type: 'text', title:'Durasi', width:'70' },
            { type: 'text', title:'MM', width:'70' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga Satuan', width:'120' },
            { type: 'text', title:'Jumlah Biaya', width:'200' },
        ],
        updateTable:function(instance, cell, col, row, val, label, cellName) {
            
        },
        columnSorting:false,
    });

    $(function () {
      $('#spkkonsultan').submit(function (event) {
        $('#datatenagaahli').val(JSON.stringify(data11));
        $('#datatenagapendukung').val(JSON.stringify(data12));
        $('#databiayasewa').val(JSON.stringify(data21));
        $('#databiayarapat').val(JSON.stringify(data22));
        $('#databiayakendaraan').val(JSON.stringify(data23));
        $('#databiayapelaporan').val(JSON.stringify(data24));
      });
    });
</script>
@endsection --}}