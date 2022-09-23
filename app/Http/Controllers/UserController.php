<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('app.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function detatchRole(User $user, Role $role)
    {
        // Do not allow users who are not admins to detatch roles
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back()->dangerBanner('You do not have permission to do that.');
        }

        // Do not allow detatching the admin role
        if ($role->name == 'admin') {
            return redirect()->back()->dangerBanner('You cannot detatch the admin role from a user.');
        }
        $user->roles()->detach($role);
        return redirect()->route('user.edit', $user)->banner('Role detached');
    }

    public function attachRole(Request $request, User $user)
    {
        // Do not allow users who are not admins to attach roles
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back()->dangerBanner('You do not have permission to do that.');
        }
        $role = Role::find($request->role_id);
        // Do not allow attaching the admin role
        if ($role->name == 'admin') {
            return redirect()->back()->dangerBanner('You cannot attach the admin role');
        }
        // Do not allow attaching the same role twice
        if ($user->roles->contains($role)) {
            return redirect()->back()->dangerBanner('User already has this role');
        }
        $user->roles()->attach($role);
        return redirect()->route('user.edit', $user)->banner('Role attached');
    }
}
