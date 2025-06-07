<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:list-users', ['only' => ['index','listdata']]);
        $this->middleware('permission:tambah-users', ['only' => ['store']]);
        $this->middleware('permission:edit-users', ['only' => ['edit','update']]);
        $this->middleware('permission:hapus-users', ['only' => ['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = DB::table('roles')->get();
        return view('backend.users.index', compact('roles'));
    }

    public function listdata()
    {
        return Datatables::of(
            DB::table('users')->get()
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
        $newrole = explode('-', $request->role);
        $id = DB::table('users')->insertGetId([
            'name'       => $request->name,
            'email'      => $request->email,
            'role_id'       => $newrole[0],
            'password'   => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = User::find($id);
        $user->assignRole($newrole[1]);

        return response()->json(['success' => true]);
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
        $user = DB::table('users')
        ->leftjoin('roles', 'users.role_id', '=', 'roles.id')
        ->select(DB::raw('users.*, roles.id as role_id, roles.name as role_name'))
        ->where('users.id', $id)->first();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $newrole = explode('-', $request->role); // ['1', 'admin'] misal

        // Update user dengan Query Builder (jika kamu tetap ingin pakai DB::table)
        DB::table('users')->where('id', $id)->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'role_id'  => $newrole[0], // simpan role_id
            'updated_at' => now(),
        ]);

        // Ambil user model untuk assign role (Spatie)
        $user = User::find($id);

        // Jika ingin update password jika diisi
        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Sync atau assign role berdasarkan nama
        $user->syncRoles($newrole[1]); // syncRoles menggantikan semua role yg lama dengan yg baru

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = DB::table('users')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
