<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        return view('backend.laporan.index');
    }

    public function showChartHarianTanaman(Request $request)
    {
        // Ambil tanggal dari input flatpickr (format: "2024-06-01 to 2024-06-10")
        $range = $request->rangeTanggal;

        if ($range) {
            if (str_contains($range, ' to ')) {
                [$startRaw, $endRaw] = explode(' to ', $range);
            } else {
                // Hanya 1 tanggal dipilih
                $startRaw = $range;
                $endRaw = $range;
            }

            $start = \Carbon\Carbon::createFromFormat('d-m-Y', trim($startRaw))->format('Y-m-d');
            $end   = \Carbon\Carbon::createFromFormat('d-m-Y', trim($endRaw))->format('Y-m-d');
        } else {
            // Default: 7 hari terakhir
            $end = now()->format('Y-m-d');
            $start = now()->subDays(6)->format('Y-m-d');
        }

        // Query harga_jual dalam rentang tanggal
        $data = DB::table('harga_jual')
            ->leftJoin('tanaman', 'tanaman.id', '=', 'harga_jual.nama_tanaman')
            ->select('harga_jual.tanggal', 'harga_jual.harga_jual', 'tanaman.nama_tanaman as nama_tanaman_t')
            // ->whereBetween('harga_jual.tanggal', [$start, $end])
            ->whereDate('harga_jual.tanggal', '>=', $start)
            ->whereDate('harga_jual.tanggal', '<=', $end)
            ->orderBy('harga_jual.tanggal', 'asc')
            ->get()
            ->groupBy('nama_tanaman_t');

        // Ambil label tanggal unik dari semua data
        $labels = $data->flatten()->pluck('tanggal')->unique()->sort()->values();

        // Siapkan datasets untuk Chart.js
        $datasets = [];
        foreach ($data as $namaTanaman => $records) {
            $hargaPerTanggal = [];

            foreach ($labels as $tgl) {
                $match = $records->firstWhere('tanggal', $tgl);
                $hargaPerTanggal[] = $match ? $match->harga_jual : null;
            }

            $datasets[] = [
                'label' => $namaTanaman,
                'data' => $hargaPerTanggal,
                'borderColor' => '#' . substr(md5($namaTanaman), 0, 6),
                'fill' => false,
                'tension' => 0.3
            ];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets
        ]);
    }

    public function showChartHarianPanen(Request $request)
    {
        // Ambil tanggal dari input flatpickr (format: "2024-06-01 to 2024-06-10")
        $range = $request->rangeTanggal;

        if ($range) {
            if (str_contains($range, ' to ')) {
                [$startRaw, $endRaw] = explode(' to ', $range);
            } else {
                // Hanya 1 tanggal dipilih
                $startRaw = $range;
                $endRaw = $range;
            }

            $start = \Carbon\Carbon::createFromFormat('d-m-Y', trim($startRaw))->format('Y-m-d');
            $end   = \Carbon\Carbon::createFromFormat('d-m-Y', trim($endRaw))->format('Y-m-d');
        } else {
            // Default: 7 hari terakhir
            $end = now()->format('Y-m-d');
            $start = now()->subDays(6)->format('Y-m-d');
        }

        // Query harga_jual dalam rentang tanggal
        $data = DB::table('panen')
            ->leftJoin('tanaman', 'tanaman.id', '=', 'panen.nama_tanaman')
            ->select(
                'panen.tanggal',
                DB::raw('SUM(panen.jumlah_panen) as total_panen'),
                'tanaman.nama_tanaman as nama_tanaman_t'
            )
            ->whereDate('panen.tanggal', '>=', $start)
            ->whereDate('panen.tanggal', '<=', $end)
            ->when(Auth::user()->role_id !== 1, function ($query) {
                return $query->where('panen.pembuat', Auth::user()->id);
            })
            ->groupBy('panen.tanggal', 'tanaman.nama_tanaman')
            ->orderBy('panen.tanggal', 'asc')
            ->get()
            ->groupBy('nama_tanaman_t');


        // Ambil label tanggal unik dari semua data
        $labels = $data->flatten()->pluck('tanggal')->unique()->sort()->values();

        // Siapkan datasets untuk Chart.js
        $datasets = [];
        foreach ($data as $namaTanaman => $records) {
            $hargaPerTanggal = [];

            foreach ($labels as $tgl) {
                $match = $records->firstWhere('tanggal', $tgl);
                $hargaPerTanggal[] = $match ? $match->total_panen : null;
            }

            $datasets[] = [
                'label' => $namaTanaman,
                'data' => $hargaPerTanggal,
                'borderColor' => '#' . substr(md5($namaTanaman), 0, 6),
                'fill' => false,
                'tension' => 0.3
            ];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => $datasets
        ]);
    }
}
