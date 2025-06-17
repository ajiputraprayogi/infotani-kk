<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class HargaJualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanaman = DB::table('tanaman')->get();
        return view('backend.harga_jual.index', compact('tanaman'));
    }

    public function listdata()
    {
        return Datatables::of(
            DB::table('harga_jual')
            ->leftjoin('tanaman', 'harga_jual.nama_tanaman', '=', 'tanaman.id')
            ->select(DB::raw('harga_jual.*, tanaman.id as id_t, tanaman.nama_tanaman as nama_tanaman_t'))
            ->get()
        )->make(true);
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
        DB::table('harga_jual')->insert([
            'tanggal'       => $request->tanggal,
            'nama_tanaman' => $request->nama_tanaman,
            'harga_jual' => $request->harga_jual,
            'created_at' => now(),
            'updated_at' => now(),
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
        $harga_jual = DB::table('harga_jual')
        ->leftjoin('tanaman', 'harga_jual.nama_tanaman', '=', 'tanaman.id')
        ->select(DB::raw('harga_jual.*, tanaman.id as id_t, tanaman.nama_tanaman as nama_tanaman_t'))
        ->where('harga_jual.id', $id)->first();
        return response()->json($harga_jual);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $harga_jual = DB::table('harga_jual')->where('id', $id);

        $data = $request->only(['tanggal', 'nama_tanaman', 'harga_jual']);

        $harga_jual->update($data);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $harga_jual = DB::table('harga_jual')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
