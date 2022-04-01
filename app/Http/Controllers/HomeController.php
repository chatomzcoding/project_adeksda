<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Models\Pekerjaan;
use App\Models\Perusahaan;
use App\Models\Timlokus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $menu   = 'dashboard';
        $statistik  = [
            'kontrak' => Kontrak::count(),
            'timlokus' => Timlokus::count(),
            'pekerjaan' => Pekerjaan::count(),
            'perusahaan' => Perusahaan::count(),
        ];
        return view('admin.dashboard', compact('menu','statistik'));
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
