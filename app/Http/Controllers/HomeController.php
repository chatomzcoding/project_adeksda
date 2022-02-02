<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $menu   = 'dashboard';
        return view('admin.dashboard', compact('menu'));
    }

    public function halaman($sesi)
    {
        $menu  = $sesi;
        $main   = [
            'statistik' => [
                'total1' => 5,
                'total2' => 5,
                'total3' => 5,
                'total4' => 5,
            ],
            'link' => 'siswa',
        ];
        switch ($sesi) {
            case 'timlokus':
                $data   = list_timlokus();
                return view('halaman.timlokus', compact('menu','main','data'));
                break;
            case 'pekerjaan':
                $data   = list_pekerjaan();
                return view('halaman.pekerjaan', compact('menu','main','data'));
                break;
            case 'perusahaan':
                $data   = list_perusahaan();
                return view('halaman.perusahaan', compact('menu','main','data'));
                break;
            case 'kontrakfisik':
                $data   = list_kontrakfisik();
                return view('halaman.kontrakfisik', compact('menu','main','data'));
                break;
            case 'buatkontrak':
                return view('halaman.buatkontrak', compact('menu','main'));
                break;
            
            default:
                # code...
                break;
        }
    }
}
