<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('app.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission_ids.*' => 'required|exists:permissions,id'
        ]);

        $role = Role::firstOrCreate([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        $role->permissions()->attach($request->permission_ids);

        return redirect()->route('role.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('app.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }

    public function detatchPermission(Role $role, Permission $permission)
    {

        // Do not allow users who are not admins to detatch permissions
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back()->dangerBanner('You do not have permission to do that.');
        }

        // Prevent modification of the admin role
        if ($role->name == 'admin') {
            return redirect()->back()->dangerBanner('You cannot modify the admin role.');
        }

        $role->revokePermissionTo($permission->name);
        return redirect()->route('role.edit', $role)->banner('Permission detatched.');
    }

    public function attachPermission(Request $request, Role $role)
    {
        // Do not allow users who are not admins to attach roles
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back()->dangerBanner('You do not have permission to do that.');
        }

        // Prevent modification of the admin role
        if ($role->name == 'admin') {
            return redirect()->back()->dangerBanner('You cannot modify the admin role.');
        }

        $permission = Permission::find($request->permission_id);
        // Do not allow attaching the same permission twice
        if ($role->hasPermissionTo($permission->name)) {
            return redirect()->back()->dangerBanner('That permission is already attached to this role.');
        }

        $role->givePermissionTo($permission->name);
        return redirect()->route('role.edit', $role)->banner('Permission attached.');
    }
}
