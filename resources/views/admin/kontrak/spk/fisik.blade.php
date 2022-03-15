
<script  type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button1'); //Add button selector
    var wrapper = $('.field_wrapper1'); //Input field wrapper
    // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
    var fieldHTML = '<div class="row mt-2"><input type="text" name="uraian1[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required><input type="number" min="1" name="kuantitas1[]" placeholder="kuantitas" class="form-control col-md-2"><input type="text"  name="satuan1[]" class="form-control col-md-2" placeholder="satuan"><input type="number"  name="harga1[]" class="form-control col-md-2" placeholder="harga"><a href="javascript:void(0);" class="remove_button1 col-md-1 btn btn-danger" title="Add field"><i class="fas fa-minus"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button1', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script  type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button2'); //Add button selector
    var wrapper = $('.field_wrapper2'); //Input field wrapper
    // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
    var fieldHTML = '<div class="row mt-2"><input type="text" name="uraian2[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required><input type="number" min="1" name="kuantitas2[]" placeholder="kuantitas" class="form-control col-md-2"><input type="text"  name="satuan2[]" class="form-control col-md-2" placeholder="satuan"><input type="number"  name="harga2[]" class="form-control col-md-2" placeholder="harga"><a href="javascript:void(0);" class="remove_button2 col-md-1 btn btn-danger" title="Add field"><i class="fas fa-minus"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button2', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script  type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button3'); //Add button selector
    var wrapper = $('.field_wrapper3'); //Input field wrapper
    // var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
    var fieldHTML = '<div class="row mt-2"><input type="text" name="uraian3[]" id="nama_kota" class="form-control col-md-5" placeholder="uraian" required><input type="number" min="1" name="kuantitas3[]" placeholder="kuantitas" class="form-control col-md-2"><input type="text"  name="satuan3[]" class="form-control col-md-2" placeholder="satuan"><input type="number"  name="harga3[]" class="form-control col-md-2" placeholder="harga"><a href="javascript:void(0);" class="remove_button3 col-md-1 btn btn-danger" title="Add field"><i class="fas fa-minus"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button3', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
{{-- spk --}}
<script>
var data1 = [
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
// [ 'Crayons Crayola only (No Rose Art)', 2, 5.01, '=B1*C1' ],
// [ 'Total', '=SUM(B1:B8)', '=ROUND(SUM(C1:C8), 2)', '' ],
];
var data2 = [
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
];
var data3 = [
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
    ['','','','',''],
];

jspreadsheet(document.getElementById('spreadsheet1'), {
    data:data1,
    columns: [
        { type: 'text', title:'Uraian Pekerjaan', width:'300' },
        { type: 'numeric', title:'Personil', width:'80' },
        { type: 'text', title:'Durasi', width:'80' },
        { type: 'text', title:'MM', width:'120' },
        { type: 'text', title:'Satuan', width:'80' },
        { type: 'text', title:'Harga Satuan', width:'80' },
        { type: 'text', title:'Jumlah Biaya', width:'80' },
    ],
    updateTable:function(instance, cell, col, row, val, label, cellName) {
        if (cell.innerHTML == 'Total') {
            cell.parentNode.style.backgroundColor = '#fffaa3';
        }
        if (col == 1) {
            kuantitas = cell.innerText;
        }
        if (col == 3) {
            nilaiharga = cell.innerText;
            nilaiharga = nilaiharga.replace(".00",'');
            nilaiharga = nilaiharga.replace("Rp",'');
            nilaiharga = nilaiharga.replace(/,/g,'');
            // cell.innerHTML = formatRupiah(nilaiharga);
            cell.innerHTML = nilaiharga;
        }
        if (col == 4) {
            subtotal = kuantitas * nilaiharga;
            cell.innerHTML = subtotal;
        }
    },
    columnSorting:false,
});
jspreadsheet(document.getElementById('spreadsheet2'), {
    data:data2,
    columns: [
        { type: 'text', title:'Uraian', width:'300' },
        { type: 'numeric', title:'kuantitas', width:'80' },
        { type: 'text', title:'Satuan', width:'80' },
        { type: 'text', title:'Harga', width:'120' },
        { type: 'text', title:'Sub Total', width:'200' },
    ],
    updateTable:function(instance, cell, col, row, val, label, cellName) {
        if (cell.innerHTML == 'Total') {
            cell.parentNode.style.backgroundColor = '#fffaa3';
        }
        if (col == 1) {
            kuantitas = cell.innerText;
        }
        if (col == 3) {
            nilaiharga = cell.innerText;
            nilaiharga = nilaiharga.replace(".00",'');
            nilaiharga = nilaiharga.replace("Rp",'');
            nilaiharga = nilaiharga.replace(/,/g,'');
            // cell.innerHTML = formatRupiah(nilaiharga);
            cell.innerHTML = nilaiharga;
        }
        if (col == 4) {
            subtotal = kuantitas * nilaiharga;
            cell.innerHTML = subtotal;
        }
    },
    columnSorting:false,
});
jspreadsheet(document.getElementById('spreadsheet3'), {
    data:data3,
    columns: [
        { type: 'text', title:'Uraian', width:'300' },
        { type: 'numeric', title:'kuantitas', width:'80' },
        { type: 'text', title:'Satuan', width:'80' },
        { type: 'text', title:'Harga', width:'120' },
        { type: 'text', title:'Sub Total', width:'200' },
    ],
    updateTable:function(instance, cell, col, row, val, label, cellName) {
        if (cell.innerHTML == 'Total') {
            cell.parentNode.style.backgroundColor = '#fffaa3';
        }
        if (col == 1) {
            kuantitas = cell.innerText;
        }
        if (col == 3) {
            nilaiharga = cell.innerText;
            nilaiharga = nilaiharga.replace(".00",'');
            nilaiharga = nilaiharga.replace("Rp",'');
            nilaiharga = nilaiharga.replace(/,/g,'');
            // cell.innerHTML = formatRupiah(nilaiharga);
            cell.innerHTML = nilaiharga;
        }
        if (col == 4) {
            subtotal = kuantitas * nilaiharga;
            cell.innerHTML = subtotal;
        }
    },
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