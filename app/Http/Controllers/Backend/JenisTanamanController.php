<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class JenisTanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    public function listdata()
    {
        return Datatables::of(
            DB::table('jenis_tanaman')->get()
        )->make(true);
    }

    public function getJenisTanaman()
    {
        $jenis_tanaman = DB::table('jenis_tanaman')->get();
        return response()->json($jenis_tanaman);
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
        DB::table('jenis_tanaman')->insert([
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
        $jenis_tanaman = DB::table('jenis_tanaman')->where('id', $id)->first();
        return response()->json($jenis_tanaman);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenis_tanaman = DB::table('jenis_tanaman')->where('id', $id);

        $data = $request->only(['jenis_tanaman']);

        $jenis_tanaman->update($data);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis_tanaman = DB::table('jenis_tanaman')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
