<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function show() 
    {
        return view('BackEnd.role.add');
    }
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required',
        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        return redirect()->back()->with('success', 'Role added successfully.');
    }
    public function manage() 
    {
        $roles = Role::all();
        return view('BackEnd.role.manage', compact('roles'));
    }
    // public function edit($id) 
    // {
    //     $role = Role::find($id);
    //     if (!$role) {
    //         return redirect()->route('role.manage')->with('error', 'Role not found.');
    //     }
    //     return view('roles.edit', compact('role'));
    // }
    public function update(Request $request, $id) 
    {
        $request->validate([
            'name' => 'required',
        ]);
        $role = Role::find($id);
        $role->update($request->all());
        return redirect()->route('role_manage')->with('success', 'Role updated successfully.');
    }
    public function delete($id) 
    {
        $role = Role::find($id);
        if ($role) {
            $role->delete();
            return redirect()->route('role_manage')->with('success', 'Role deleted successfully.');
        } else {
            return redirect()->route('role_manage')->with('error', 'Role not found.');
        }
    }
}
