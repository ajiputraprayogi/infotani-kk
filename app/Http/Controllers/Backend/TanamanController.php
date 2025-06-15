<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
