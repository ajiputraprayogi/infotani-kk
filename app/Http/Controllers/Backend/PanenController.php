<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class PanenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanaman = DB::table('tanaman')->get();
        return view('backend.panen.index', compact('tanaman'));
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

    public function getHarga(Request $request)
    {
        $tanggal = $request->tanggal;
        $nama_tanaman = $request->nama_tanaman;

        $harga = DB::table('harga_jual')
            ->whereDate('tanggal', $tanggal)
            ->where('nama_tanaman', $nama_tanaman)
            ->value('harga_jual');

        return response()->json(['harga' => $harga]);
    }
}
