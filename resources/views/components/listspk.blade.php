<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Uraian Pekerjaan</th>
            <th>Kuantitas</th>
            <th>Satuan Ukuran</th>
            <th>Harga Satuan (Rp)</th>
            <th>Subtotal (Rp)</th>
            <th>Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr class="table-info">
                <th></th>
                <th>{{ $item['judul'] }}</th>
                <th colspan="5" class="text-right">{{ $item['total'] }}</th>
            </tr>
            @foreach ($item['data'] as $key)
                <tr>
                    <td>{{ $key[0] }}</td>
                    <td>{{ $key[1] }}</td>
                    <td class="text-rught">{{ $key[2] }}</td>
                    <td class="text-center">{{ $key[3] }}</td>
                    <td class="text-right">{{ $key[4] }}</td>
                    <td class="text-right">{{ $key[5] }}</td>
                    <td></td>
                </tr>
            @endforeach
        @endforeach
        <tr>
            <th colspan="6" class="text-right">Jumlah</th>
            <td>{{ $result['jumlah'] }}</td>
        </tr>
        <tr>
            <th colspan="6" class="text-right">PPN 10%</th>
            <td>{{ $result['ppn'] }}</td>
        </tr>
        <tr>
            <th colspan="6" class="text-right">NILAI</th>
            <td>{{ $result['nilai'] }}</td>
        </tr>
        <tr>
            <th colspan="6" class="text-right">DIBULATKAN</th>
            <td>{{ $result['bulat'] }}</td>
        </tr>
    </tbody>
</table>