<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission = DB::table('permissions')->get()->groupBy('permissions_grup');

        return view('backend.roles.index', compact('permission'));
    }

    public function listdata()
    {
        return Datatables::of(
            DB::table('roles')->get()
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
        $roleId = DB::table('roles')->insertGetId([
            'name'       => $request->name,
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Simpan permission ke pivot table role_has_permissions
        $permissions = $request->permission ?? [];

        $insertData = [];
        foreach ($permissions as $permissionId) {
            $insertData[] = [
                'role_id' => $roleId,
                'permission_id' => $permissionId,
            ];
        }

        if (!empty($insertData)) {
            DB::table('role_has_permissions')->insert($insertData);
        }

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
        $role = DB::table('roles')->where('id', $id)->first();

        $permissionIds = DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->pluck('permission_id')
            ->toArray();

        return response()->json([
            'role' => $role,
            'permissions' => $permissionIds,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permissionIds = $request->permission ?? [];

        // Ambil nama permission berdasarkan ID
        $permissionNames = Permission::whereIn('id', $permissionIds)->pluck('name')->toArray();

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($permissionNames);

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = DB::table('roles')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}
