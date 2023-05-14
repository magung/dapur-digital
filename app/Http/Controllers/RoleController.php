<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();
        return view('role.index', compact('roles'));
    }
    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required',
            'status' => 'required'
        ]);

        $role = Role::create([
            'role_name' => $request->role_name,
            'status' => $request->status
        ]);

        if ($role) {
            return redirect()
                ->route('role.index')
                ->with([
                    'success' => 'New role has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role_name' => 'required',
            'status' => 'required'
        ]);

        $role = Role::findOrFail($id);

        $role->update([
            'role_name' => $request->role_name,
            'status' => $request->status
        ]);

        if ($role) {
            return redirect()
                ->route('role.index')
                ->with([
                    'success' => 'role has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        if ($role) {
            return redirect()
                ->route('role.index')
                ->with([
                    'success' => 'role has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('role.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
