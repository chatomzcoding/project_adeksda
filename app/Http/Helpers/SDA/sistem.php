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