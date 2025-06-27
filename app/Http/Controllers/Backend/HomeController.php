<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $tanaman = DB::table('tanaman')->count();
        $user = DB::table('users')->where('role_id', '2')->count();
        $jumlah_panen = DB::table('panen')
            ->whereDate('tanggal', Carbon::today())
            ->sum('jumlah_panen');
        $hasil_panen = DB::table('panen')
            ->join('harga_jual', 'panen.id_harga_jual', '=', 'harga_jual.id')
            ->whereDate('panen.tanggal', Carbon::today())
            ->select(DB::raw('SUM(panen.jumlah_panen * harga_jual.harga_jual) as total_harga'))
            ->value('total_harga');
        $harga_jual = DB::table('harga_jual')
        ->leftjoin('tanaman', 'harga_jual.nama_tanaman', '=', 'tanaman.id')
        ->leftjoin('jenis_tanaman', 'tanaman.jenis_tanaman', '=', 'jenis_tanaman.id')
        ->select(DB::raw('harga_jual.*, tanaman.id as id_t, tanaman.nama_tanaman as nama_tanaman_t, jenis_tanaman.jenis_tanaman as jenis_tanaman_jt'))
        ->whereDate('tanggal', Carbon::today())
        ->get();
        return view('backend.index', compact('tanaman', 'user', 'jumlah_panen', 'hasil_panen', 'harga_jual'));
    }
    public function welcome()
    {
        return view('welcome');
    }
}
