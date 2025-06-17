<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Dflydev\DotAccessData\Data;
use DataTables;

class TanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_tanaman = DB::table('jenis_tanaman')->get();
        return view('backend.tanaman.index', compact('jenis_tanaman'));
    }

    public function listdata()
    {
        return Datatables::of(
            DB::table('tanaman')
            ->leftJoin('jenis_tanaman', 'tanaman.jenis_tanaman', '=', 'jenis_tanaman.id')
            ->select(DB::raw('tanaman.*, jenis_tanaman.id as id_jt, jenis_tanaman.jenis_tanaman as jenis_tanaman_jt'))
            ->get()
        )->make(true);
    }

    public function showChart()
    {
        // $data = DB::table('permissions')->orderBy('created_at')->get();
        $data = DB::table('permissions')
            ->select('permissions_grup', DB::raw('count(*) as total'))
            ->groupBy('permissions_grup')
            ->orderBy('total', 'asc')
            ->get();

        $labels = $data->pluck('permissions_grup'); // y-axis
        $totals = $data->pluck('total');            // x-axis

        return view('backend.laporan.index', [
            'labels' => $labels,
            'totals' => $totals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('tanaman')->insert([
            'nama_tanaman'       => $request->nama_tanaman,
            'jenis_tanaman' => $request->jenis_tanaman
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tanaman = DB::table('tanaman')->where('id', $id)->first();
        return response()->json($tanaman);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tanaman = DB::table('tanaman')->where('id', $id);

        $data = $request->only(['nama_tanaman', 'jenis_tanaman']);

        $tanaman->update($data);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tanaman = DB::table('tanaman')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
