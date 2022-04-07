<table class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th rowspan="2">No</th>
            <th rowspan="2">Uraian Pekerjaan</th>
            <th colspan="3">Valume</th>
            <th rowspan="2">Satuan</th>
            <th rowspan="2">Harga Satuan (Rp)</th>
            <th rowspan="2">Jumlah Biaya (Rp)</th>
        </tr>
        <tr>
            <th>Personil</th>
            <th>Durasi</th>
            <th>MM</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr class="table-info">
                <th>{{ $row['label'] }}</th>
                <th colspan="7" class="text-uppercase">{{ $row['judul'] }}</th>
            </tr>
            @foreach ($row['data'] as $item)
                <tr>
                    <th>{{ $item['no'] }}</th>
                    <th colspan="7">{{ $item['judul'] }}</th>
                </tr>
                @foreach ($item['data'] as $key)
                    <tr>
                        <td></td>
                        <td>{{ $key[0] }}</td>
                        <td>{{ $key[1] }}</td>
                        <td class="text-center">{{ $key[2] }}</td>
                        <td class="text-center">{{ $key[3] }}</td>
                        <td class="text-center">{{ $key[4] }}</td>
                        <td class="text-right">{{ $key[5] }}</td>
                        <td class="text-right">{{ norupiah($key[6]) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="7" class="text-center">Jumlah</th>
                    <th class="text-right">{{ norupiah($item['jumlah']) }}</th>
                </tr>
            @endforeach
        @endforeach
        <tr>
            <th colspan="7" class="text-right">Jumlah</th>
            <th class="text-right">{{ $result['jumlah'] }}</th>
        </tr>
        <tr>
            <td colspan="7" class="text-right">PPN 10%</td>
            <td class="text-right">{{ $result['ppn'] }}</td>
        </tr>
        <tr>
            <th colspan="7" class="text-right">NILAI</th>
            <th class="text-right">{{ $result['nilai'] }}</th>
        </tr>
        <tr>
            <th colspan="7" class="text-right">DIBULATKAN</th>
            <th class="text-right">{{ $result['bulat'] }}</th>
        </tr>
    </tbody>
</table>