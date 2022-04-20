<form action="{{  route('dokumenspk.store')}}" method="post" id="formMobil">
    @csrf
    <input type="hidden" name="kontrak_id" value="{{ $main['kontrak']->id }}">
    <input type="hidden" name="data1" id="datapersiapan">
    <input type="hidden" name="data2" id="datapelaksanaan">
    <input type="hidden" name="data3" id="datapembantu">
    <h2 class="ui header">Pekerjaan Persiapan</h2>
    <div id="spreadsheet1"></div>
    <div class="ui divider hidden"></div>
    <h2 class="ui header">Pekerjaan Pelaksanaan</h2>
    <div id="spreadsheet2"></div>
    <div class="ui divider hidden"></div>
    <h2 class="ui header">Pekerjaan Pembantu</h2>
    <div id="spreadsheet3"></div>
    <div class="ui divider hidden"></div>
    <div class="text-right">
        <button type="submit" class="btn btn-outline-primary">SELANJUTNYA <i class="fas fa-angle-double-right"></i></button>
    </div>
</form>

{{-- @section('script')
<script>
    // [ 'Crayons Crayola only (No Rose Art)', 2, 5.01, '=B1*C1' ],
    // [ 'Total', '=SUM(B1:B8)', '=ROUND(SUM(C1:C8), 2)', '' ],
    var data1 = @json($main['spkfisik']['persiapan']);
    var data2 = @json($main['spkfisik']['pelaksanaan']);
    var data3 = @json($main['spkfisik']['pembantu']);

    jspreadsheet(document.getElementById('spreadsheet1'), {
        data:data1,
        columns: [
            { type: 'text', title:'Uraian', width:'500' },
            { type: 'numeric', title:'kuantitas', width:'80' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga', width:'120' },
            { type: 'text', title:'Sub Total', width:'200' },
        ],
        // updateTable:function(instance, cell, col, row, val, label, cellName) {
        //     if (cell.innerHTML == 'Total') {
        //         cell.parentNode.style.backgroundColor = '#fffaa3';
        //     }
        //     if (col == 1) {
        //         kuantitas = cell.innerText;
        //     }
        //     if (col == 3) {
        //         nilaiharga = cell.innerText;
        //         nilaiharga = nilaiharga.replace(".00",'');
        //         nilaiharga = nilaiharga.replace("Rp",'');
        //         nilaiharga = nilaiharga.replace(/,/g,'');
        //         // cell.innerHTML = formatRupiah(nilaiharga);
        //         cell.innerHTML = nilaiharga;
        //     }
        //     if (col == 4) {
        //         subtotal = kuantitas * nilaiharga;
        //         cell.innerHTML = subtotal;
        //     }
        // },
        columnSorting:false,
    });
    jspreadsheet(document.getElementById('spreadsheet2'), {
        data:data2,
        columns: [
            { type: 'text', title:'Uraian', width:'500' },
            { type: 'numeric', title:'kuantitas', width:'80' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga', width:'120' },
            { type: 'text', title:'Sub Total', width:'200' },
        ],
        // updateTable:function(instance, cell, col, row, val, label, cellName) {
        //     if (cell.innerHTML == 'Total') {
        //         cell.parentNode.style.backgroundColor = '#fffaa3';
        //     }
        //     if (col == 1) {
        //         kuantitas = cell.innerText;
        //     }
        //     if (col == 3) {
        //         nilaiharga = cell.innerText;
        //         nilaiharga = nilaiharga.replace(".00",'');
        //         nilaiharga = nilaiharga.replace("Rp",'');
        //         nilaiharga = nilaiharga.replace(/,/g,'');
        //         // cell.innerHTML = formatRupiah(nilaiharga);
        //         cell.innerHTML = nilaiharga;
        //     }
        //     if (col == 4) {
        //         subtotal = kuantitas * nilaiharga;
        //         cell.innerHTML = subtotal;
        //     }
        // },
        columnSorting:false,
    });
    jspreadsheet(document.getElementById('spreadsheet3'), {
        data:data3,
        columns: [
            { type: 'text', title:'Uraian', width:'500' },
            { type: 'numeric', title:'kuantitas', width:'80' },
            { type: 'text', title:'Satuan', width:'80' },
            { type: 'text', title:'Harga', width:'120' },
            { type: 'text', title:'Sub Total', width:'200' },
        ],
        // updateTable:function(instance, cell, col, row, val, label, cellName) {
        //     if (cell.innerHTML == 'Total') {
        //         cell.parentNode.style.backgroundColor = '#fffaa3';
        //     }
        //     if (col == 1) {
        //         kuantitas = cell.innerText;
        //     }
        //     if (col == 3) {
        //         nilaiharga = cell.innerText;
        //         nilaiharga = nilaiharga.replace(".00",'');
        //         nilaiharga = nilaiharga.replace("Rp",'');
        //         nilaiharga = nilaiharga.replace(/,/g,'');
        //         // cell.innerHTML = formatRupiah(nilaiharga);
        //         cell.innerHTML = nilaiharga;
        //     }
        //     if (col == 4) {
        //         subtotal = kuantitas * nilaiharga;
        //         cell.innerHTML = subtotal;
        //     }
        // },
        columnSorting:false,
    });

    $(function () {
      $('#formMobil').submit(function (event) {
        $('#datapersiapan').val(JSON.stringify(data1));
        $('#datapelaksanaan').val(JSON.stringify(data2));
        $('#datapembantu').val(JSON.stringify(data3));
      });
    });
</script>
@endsection --}}