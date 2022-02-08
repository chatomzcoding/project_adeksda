<?php
// fungsi untuk menampilkan notifikasi bahwa input wajib di isi 
if (! function_exists('cekvalue')) {
    function cekvalue($data,$field)
    {
        $result = NULL;
        if (isset($data->$field)) {
            $result     = $data->$field;
        }
        return $result;
    }
}

// fungsi untuk menampilkan notifikasi bahwa input wajib di isi 
if (! function_exists('datafilter')) {
    function datafilter($datalist,$datafilter)
    {
        $filter     = [];        
        $list       = $datalist;
        for ($i=0; $i < count($datafilter); $i++) { 
            // filter
            $f  = $datafilter[$i];
            $dfilter    = (isset($_GET[$f])) ? $_GET[$f] : 'semua' ;
            $filter[$f] = $dfilter;
            
            if ($dfilter <> 'semua') {
                $listbaru   = [];
                foreach ($list as $item) {
                    if ($item->$f == $dfilter) {
                        $listbaru[] = $item;
                    }
                }
                $list   = $listbaru;
            }
        }

        $result     = [
            'list' => $list,
            'filter' => $filter,
        ];
        return $result;
    }
}