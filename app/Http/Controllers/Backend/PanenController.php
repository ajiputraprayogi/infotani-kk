<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;

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

    public function listdata()
    {
        $query = DB::table('panen')
            ->leftJoin('tanaman', 'tanaman.id', '=', 'panen.nama_tanaman')
            ->leftJoin('users', 'users.id', '=', 'panen.pembuat')
            ->select(DB::raw('panen.*, panen.id as id_p, tanaman.nama_tanaman as nama_tanaman_t, users.name, (panen.harga_jual * panen.jumlah_panen) as total_harga'))
            ->orderBy('panen.tanggal', 'desc');

        // Tambahkan where hanya jika bukan admin
        if (Auth::user()->role_id !== 1) {
            $query->where('panen.pembuat', Auth::id());
        }
        
        $query = $query->get();
        return Datatables::of($query)->make(true);
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
        DB::table('panen')->insert([
            'nama_tanaman' => $request->nama_tanaman,
            'tanggal' => $request->tanggal,
            'jumlah_panen' => $request->jumlah_panen,
            'harga_jual' => $request->harga_jual,
            'id_harga_jual' => $request->id_harga_jual,
            'pembuat' => Auth::user()->id,
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
        $panen = DB::table('panen')
            ->leftjoin('tanaman', 'tanaman.id', '=', 'panen.nama_tanaman')
            ->leftjoin('users', 'users.id', '=', 'panen.pembuat')
            ->select(DB::raw('panen.*, tanaman.nama_tanaman as nama_tanaman_t, users.name'))
            ->where('panen.id', $id)->first();
        return response()->json($panen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('panen')
            ->where('id', $id) // pastikan request mengandung ID data yang akan diubah
            ->update([
                'nama_tanaman'  => $request->nama_tanaman,
                'tanggal'       => $request->tanggal,
                'jumlah_panen'  => $request->jumlah_panen,
                'harga_jual'    => $request->harga_jual,
                'id_harga_jual'    => $request->id_harga_jual,
                'pembuat'       => $request->id_pembuat,
                'updated_at'    => now(),
            ]);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $panen = DB::table('panen')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function getHarga(Request $request)
    {
        $tanggal = $request->tanggal;
        $nama_tanaman = $request->nama_tanaman;

        $harga_jual = DB::table('harga_jual')
            ->whereDate('tanggal', $tanggal)
            ->where('nama_tanaman', $nama_tanaman)
            ->select('id as id_harga_jual', 'harga_jual')
            ->first();

        return response()->json([
            'harga_jual' => $harga_jual->harga_jual,
            'id_harga_jual' => $harga_jual->id_harga_jual
        ]);
    }
}
