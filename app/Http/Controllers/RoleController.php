<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;

class RoleController extends Controller
{
    public function listForEdit()
    {
        // $roles = Role::with('permissions:id')->get();
        $roles = Role::with('permissions:id')->get()->except([1,2]);
        return response()->json($roles);
    }

    public function listForAssignment()
    {
        // $roles = Role::with('permissions:id')->get();
        $roles = Role::with('permissions:id')->get()->except([1]);
        return response()->json($roles);
    }

    public function edit(Role $role)
    {
        return response()->json($role);
    }

    public function update(Request $request, Role $role)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'nullable',
        ]);

        if($validation->fails()) {
            return response()->json($validation->messages());
         } else {
            $role->update($validation->validated());
            if(is_array($request->permissionIds)) {
                $role->syncPermissions($request->permissionIds);
            }
            return response("successfuly updated", 200);
         }

    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
            'description' => 'nullable',
        ]);

        if($validation->fails()) {
            return response()->json($validation->messages());
         } else {
            $role = Role::create($validation->validated());
            if($request->permissionIds) {
                $role->syncPermissions($request->permissionIds);
            }
            return response()->json($role);
         }

    }

    public function changePermission (Request $request , Role $role) {
        $validation = Validator::make($request->all(), [
            'permissions' => 'required|array'
        ]);

        if($validation->fails()) {
            return response()->json($validation->messages());
         } else {
            $permissions = $validation->validated()['permissions'];
            $role->syncPermissions($permissions);
            return response()->json([$role->permissions]);
         }
    }

    public function permissionList()
    {
        $perm = Permission::all();
        return response()->json($perm); 
    }
}
